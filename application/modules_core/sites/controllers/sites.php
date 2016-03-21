<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sites extends MY_Controller {

    public $data = array();
    public $pages = array();
    private $_hostName = 'www.jadooweb.com';
    private $_userName = 'jadoowe';
    private $_password = '124essdfd';

    function __construct()
    {
        parent::__construct();

        $this->load->model('sites/sitemodel');
        $this->load->model('sites/usermodel');
        $this->load->model('sites/pagemodel');
        $this->load->model('sites/templatemodel');
        $this->load->model('domain/domainmodel');
        $this->load->model('domain/users_domains_model');
        $this->load->model('sites/media_storage_model');
        $this->load->library('s3');

        $this->data['pageTitle'] = "Jadooweb";
        $this->data['title'] = ucfirst($this->router->fetch_method());
        $this->data['pageMetaDescription'] = $this->router->fetch_class() . '|' . $this->router->fetch_method();
        $this->load->library('image_lib');
        if (!$this->ion_auth->logged_in()) {

            redirect('/login');
        }
        if ($this->ion_auth->in_group('nogroup')) {

            redirect(site_url('services'));
        }
    }

    function _remap($method, $args)
    {
//        var_dump($args);
//        die();
        switch ($method) {
            case 'site': {
                    if ($this->ion_auth->in_group(array('business', 'employer', 'ecommerce', 'designer'))) {
                        $this->site_individual($args[0]);
                    } elseif ($this->ion_auth->in_group('students')) {
                        $this->site_student($args[0]);
                    }
                }
                break;

            default:
                if (empty($args)) {
                    $this->$method();
                } else {
                    $this->$method($args[0]);
                }
                break;
        }
    }

    /*
      lists all sites
     */

    public function index()
    {

        //grab us some sites
        $this->data['sites'] = $this->sitemodel->all();

//        $sites_id = $this->sitemodel->getSiteId($this->ion_auth->get_user_id());
        //get all users
        $this->data['users'] = $this->usermodel->getAll();
        if (!$this->ion_auth->is_admin()) {
            if (count($this->data['sites']) <= 0) {
                redirect(site_url('sites/create'), 'location');
            } else {
                $this->template->load('main', 'sites', 'sites/show_sites', $this->data);
            }
        } else {
            $this->data['page'] = "sites";
            $this->data['pageHeading'] = $this->lang->line('sites_header');
            $this->data['css'] = array(
                '<link href="' . base_url() . 'assets/sites/less/flat-ui.css" rel="stylesheet">'
            );
            $this->data['js'] = array(
                '<script type="text/javascript" src="' . base_url() . 'assets/sites/js/sites.js"></script>',
                '<script type="text/javascript" src="' . base_url() . '/assets/js/jquery.blockUI.js"></script>',
            );
            $this->template->load('main', 'sites', 'sites/sites', $this->data);
        }
    }

    /*

      load page builder

     */

    public function create()
    {

        //create a  new, empty site

        $newSiteID = $this->sitemodel->createNew();

        redirect('sites/' . $newSiteID);
    }

    /*

      Used to create new sites AND save existing ones

     */

    public function save($forPublish = 0)
    {
        //do we have some frames to save?

        if (!isset($_POST['pageData']) || $_POST['pageData'] == '') {

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_save_error2_heading');
            $temp['content'] = $this->lang->line('sites_save_error2_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }


        //should we save an existing site or create a new one?

        if ($_POST['siteID'] == 0) {//no siteID provided, creste a new site
            //create the new site
            $siteID = $this->sitemodel->create($_POST['siteName'], $_POST['pageData']);


            //all went well
            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_save_success1_heading');
            $temp['content'] = $this->lang->line('sites_save_success1_message');

            $return['responseCode'] = 1;
            $return['siteID'] = $siteID;
            $return['responseHTML'] = $this->load->view('partials/success', array('data' => $temp), true);

            die(json_encode($return));
        } else {//we have a site ID, update existing site
            $siteID = $_POST['siteID'];

            if (isset($_POST['pagesData'])) {

                $this->sitemodel->update($siteID, $_POST['pageData'], $_POST['pagesData']);
            } else {

                $this->sitemodel->update($siteID, $_POST['pageData']);
            }

            $return = array();

            if ($forPublish == 0) {//regular site save
                $temp = array();
                $temp['header'] = $this->lang->line('sites_save_success2_heading');
                $temp['content'] = $this->lang->line('sites_save_success2_message');
            } elseif ($forPublish == 1) {//saving before publishing, requires different message
                $temp = array();
                $temp['header'] = $this->lang->line('sites_save_success3_heading');
                $temp['content'] = $this->lang->line('sites_save_success3_message');
            }

            $return['responseCode'] = 1;
            $return['siteID'] = $siteID;
            $return['responseHTML'] = $this->load->view('partials/success', array('data' => $temp), true);

            die(json_encode($return));
        }
    }

    public function check_template_name()
    {
        if ((isset($_POST['template_name']) || $_POST['template_name'] != '') && isset($_POST['category_id'])) {
            $res = $this->templatemodel->check_category_template_name($_POST['template_name'], $_POST['category_id']);

            $return = array();
            if ($res) {
                $return['responseCode'] = 0;
                $return['responseMSG'] = "Please enter unique template name.";
            } else {
                $return['responseCode'] = 1;
            }
            die(json_encode($return));
        }
    }

    public function get_all_template_elements()
    {
        $all_template = $this->template_model->get_all_template();
        $this->data['all_templates_data'] = $all_template;
    }

    public function templates()
    {
        if (!$this->ion_auth->in_group('designer')) {//access for designer only
            redirect('/sites');
        }
        $userID = userdata('user_id');
        $this->data['user_template'] = $this->templatemodel->show_all_template($userID);
        $this->template->load('main', 'sites', 'sites/show_templates', $this->data);
    }

    public function save_template()
    {
        if (!isset($_POST['template_element']) || $_POST['template_element'] == '') {

            $return = array();

            $temp = array();
            $temp['header'] = "Template saving Error";
            $temp['content'] = "Site giving error for Template saving.";

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }
        $uploadPath = "";
        if (!empty($_POST['img_url']) && preg_match('#data\:image\/png\;base64\,(.*)#', $_POST['img_url'], $match)) {
            $image = $match[1];

            $image = base64_decode($image);
            $fileName = preg_replace('/\s+/', '_', $_POST['template_name']);
            $profile = userdata('temp_profile');
            if ($profile == 'student') {
                $uploadPath = 'studentelements/template_preview/' . $fileName . '_cat' . $_POST['category_id'] . '.png';
            } elseif ($profile == 'ecommerce') {
                $uploadPath = 'elements/template_preview/' . $fileName . '_cat' . $_POST['category_id'] . '.png';
            } else {
                $uploadPath = 'elements/template_preview/' . $fileName . '_cat' . $_POST['category_id'] . '.png';
            }

            imagepng(imagecreatefromstring($image), $uploadPath, 8);
            $img_url = base_url() . $uploadPath;

//            list($width, $height) = getimagesize($img_url);            
            $size = getimagesize($img_url);
            $ratio = $size[0] / $size[1]; // width/height
            if ($ratio > 1) {
                $new_width = 400;
                $new_height = 400 / $ratio;
            } else {
                $new_width = 400 * $ratio;
                $new_height = 400;
            }
            $image = imagecreatefrompng($img_url);
            $image_p = imagecreatetruecolor($new_width, $new_height);
            imagesavealpha($image_p, true);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);
            $image = imagepng($image_p, $uploadPath, 8);
        }
        $templateID = $this->templatemodel->create($_POST['template_name'], $_POST['category_id'], $uploadPath, $profile);
        if ($templateID) {
            $this->templatemodel->delete_template_element($templateID);
            $this->templatemodel->create_template_element($templateID, $_POST['template_element']);
        }
        //clear browser cache
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        //all went well
        $return = array();

        $temp = array();
        $temp['header'] = "Template Saved";
        $temp['content'] = "Site has saved template successfully";

        $return['responseCode'] = 1;
        $return['responseHTML'] = $this->load->view('partials/success', array('data' => $temp), true);

        die(json_encode($return));
        //}
    }

    public function create_new_template($profile)
    {
        if (!$this->ion_auth->in_group('designer')) {//access for designer only
            redirect('/sites');
        }
        $userID = userdata('user_id');
        $bucket = $this->media_storage_model->getBucket($userID);
        if (!$bucket) {
            $bucket = 'mumbaistreet';
        } else {
            $bucket = $bucket->bucket_name;
        }
        $uri = $this->media_storage_model->getUri($userID);
        $userVideos = FALSE;

        if ($uri) {
            $uri = $uri->uri . '/' . 'Videos';
            $connected = @fsockopen("www.jadooweb.com", 80);
            $userVideos = ($connected) ? $this->s3->getBucket($bucket, $uri) : FALSE;
        }

        $this->data['userVideos'] = $userVideos;
        $this->data['bucket'] = $bucket;
        $this->data['js'] = array(
            '<script type="text/javascript" src="' . base_url() . 'assets/js/html2canvas.min.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/js/html2canvas.svg.min.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.plugin.html2canvas.js"></script>');
        $this->data['builder'] = true;
        $this->data['page'] = "site";
        $this->data['template_category'] = $this->templatemodel->get_all_category();
        $this->data['all_templates_data'] = $this->templatemodel->get_all_template($profile);
        switch ($profile) {
            case 'student':
                userdata('temp_profile', 'student');
                $this->template->load('template_student', 'sites', 'sites/create_template_view', $this->data);
                break;

            case 'ecommerce':
                userdata('temp_profile', 'ecommerce');
                $this->template->load('template_ecom', 'sites', 'sites/create_template_view', $this->data);
                break;

            default:
                userdata('temp_profile', 'business');
                $this->template->load('template_business', 'sites', 'sites/create_template_view', $this->data);
                break;
        }
    }

    /*

      get and retrieve single site data

     */

    public function site_individual($siteID)
    {
        //if user is not an admin, we'll need to check of this site belongs to this user

        if (!$this->ion_auth->is_admin()) {

            if (!$this->sitemodel->isMine($siteID)) {

                redirect('/sites');
            }
        }


        $siteData = $this->sitemodel->getSite($siteID);

        if ($siteData == false) {

            //site could not be loaded, redirect to /sites, with error message

            $this->session->set_flashdata('error', $this->lang->line('sites_site_error1'));

            redirect('/sites/', 'refresh');
        } else {

            $this->data['siteData'] = $siteData;

            //get page data
            $pagesData = $this->pagemodel->getPageData($siteID);

            if ($pagesData) {

                $this->data['pagesData'] = $pagesData;
            }

            //collect data for the image library

            $userID = userdata('user_id');

            $bucket = $this->media_storage_model->getBucket($userID);
            if (!$bucket) {
                $bucket = 'mumbaistreet';
            } else {
                $bucket = $bucket->bucket_name;
            }
            $uri = $this->media_storage_model->getUri($userID);
            $userVideos = FALSE;

            if ($uri) {
                $uri = $uri->uri . '/' . 'Videos';
                $connected = @fsockopen("www.jadooweb.com", 80);
                $userVideos = ($connected) ? $this->s3->getBucket($bucket, $uri) : FALSE;
            }
            $block_content = $this->sitemodel->get_block_content($siteID, $userID);
            if ($block_content) {
                $this->data['block_content'] = $block_content;
            } else {
                $this->data['block_content'] = false;
            }
            $this->data['userVideos'] = $userVideos;
            $this->data['bucket'] = $bucket;

            $this->data['builder'] = true;
            $this->data['page'] = "site";
            if ($this->ion_auth->in_group(array('business', 'employer', 'designer'))) {
                $profile = 'business';
            } else {
                $profile = 'ecommerce';
            }
            $this->data['all_templates_data'] = $this->templatemodel->get_all_template($profile);

            $this->template->load('builder', 'sites', 'sites/create', $this->data);
            //$this->load->view('', $this->data);
        }
    }

    public function site_student($siteID)
    {
        $userID = userdata('user_id');
        //if user is not an admin, we'll need to check of this site belongs to this user

        if (!$this->ion_auth->is_admin()) {

            if (!$this->sitemodel->isMine($siteID)) {

                redirect('/sites');
            }
        }


        $siteData = $this->sitemodel->getSite($siteID);

        if ($siteData == false) {

            //site could not be loaded, redirect to /sites, with error message

            $this->session->set_flashdata('error', $this->lang->line('sites_site_error1'));

            redirect('/sites/', 'refresh');
        } else {

            $this->data['siteData'] = $siteData;

            //get page data
            $pagesData = $this->pagemodel->getPageData($siteID);

            if ($pagesData) {

                $this->data['pagesData'] = $pagesData;
            }

            // Get the resume Setting Data 
            $page_id = 0;
            if (isset($pagesData['index'])) {
                $page_id = $pagesData['index']->pages_id;
            }
            $resumeData = $this->sitemodel->getResumeData($siteID, $userID, $page_id);

            if ($resumeData) {
                $this->data['resumeData'] = $resumeData;
            } else {
                $this->data['resumeData'] = array();
            }

            $bucket = $this->media_storage_model->getBucket($userID);
            if (!$bucket) {
                $bucket = 'mumbaistreet';
            } else {
                $bucket = $bucket->bucket_name;
            }
            $uri = $this->media_storage_model->getUri($userID);
            $userVideos = FALSE;

            if ($uri) {
                $uri = $uri->uri . '/' . 'Videos';
                $connected = @fsockopen("www.jadooweb.com", 80);
                $userVideos = ($connected) ? $this->s3->getBucket($bucket, $uri) : FALSE;
            }

            $block_content = $this->sitemodel->get_block_content($siteID, $userID);
            if ($block_content) {
                $this->data['block_content'] = $block_content;
            } else {
                $this->data['block_content'] = false;
            }

            $this->data['userVideos'] = $userVideos;

            $this->data['bucket'] = $bucket;
            $this->data['builder'] = true;
            $this->data['page'] = "site";
            $this->data['js'] = array(
            );

            $this->data['all_templates_data'] = $this->templatemodel->get_all_template('student');
            $this->template->load('resumebuilder', 'sites', 'sites/create', $this->data);
            //$this->load->view('', $this->data);
        }
    }

    /*

      get and retrieve single site data with ajax

     */

    public function siteAjax($siteID = '')
    {

        if ($siteID == '' || $siteID == 'undefined') {

            //siteID is missing

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_siteAjax_error1_heading');
            $temp['content'] = $this->lang->line('sites_siteAjax_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }

        $siteData = $this->sitemodel->getSiteData($siteID);
//        echo '<pre>';
//        print_r($siteData);
//        echo '</pre>';
//        die();
        if ($siteData == false) {

            //all did not go well
            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_siteAjax_error2_heading');
            $temp['content'] = $this->lang->line('sites_siteAjax_error2_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            echo json_encode($return);
        } else {

            //all went well
            $return = array();

            $return['responseCode'] = 1;
            $return['responseHTML'] = $this->load->view('partials/sitedata', $siteData, true);

            echo json_encode($return);
        }
    }

    /*

      updates site details, submitting through ajax

     */

    public function siteAjaxUpdate()
    {

        $this->form_validation->set_rules('siteID', 'Site ID', 'required');
//		$this->form_validation->set_rules('siteSettings_siteName', 'Site name', 'required');
        $this->form_validation->set_rules('siteSettings_domain', 'Domain', 'required');

        if ($this->form_validation->run() == FALSE) {

            //all did not go well
            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_siteAjaxUpdate_error1_heading');
            $temp['content'] = $this->lang->line('sites_siteAjaxUpdate_error1_message1') . validation_errors();

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            echo json_encode($return);
        } else {//all good with the data, let's update
            $user_id = userdata('user_id');
            $domainOk = $this->users_domains_model->create($_POST['siteID'], $user_id, $_POST['siteSettings_domain'], 'freeUrl');

            //all did went well
            $return = array();

            $temp = array();

            if ($domainOk) {
                $temp['header'] = $this->lang->line('sites_siteAjaxUpdate_success_heading');
                $temp['content'] = $this->lang->line('sites_siteAjaxUpdate_success_message');
                $return['responseCode'] = 1;
                $return['responseHTML'] = $this->load->view('partials/success', array('data' => $temp), true);
            } else {
                $temp['header'] = $this->lang->line('sites_siteAjaxUpdate_error1_heading');
                $temp['content'] = $this->lang->line('sites_siteAjaxUpdate_error1_message2');
                $return['responseCode'] = 0;
                $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);
            }

            if ($domainOk) {
                $return['domainOk'] = 1;
            } else {
                $return['domainOk'] = 0;
            }


            //we'll send back the updated site data as well
            $siteData = $this->sitemodel->getSiteData($_POST['siteID']);

            $return['responseHTML2'] = $this->load->view('partials/sitedata', $siteData, true);

//			$return['siteName'] = $siteData['site']->sites_name;
            $return['siteID'] = $siteData['site']->sites_id;

            echo json_encode($return);
        }
    }

    /*

      gets the content of a saved frame and sends it back to the browser

     */

    public function getframe($frameID)
    {

        $frame = $this->sitemodel->getSingleFrame($frameID);
        if (!$frame) {
            return FALSE;
        }
        $frameContent = $frame->frames_content;
        if (!stristr($frameContent, '<link href="' . base_url('elements'))) {
            $frameContent = str_replace('<link href="', '<link href="' . base_url('elements') . '/', $frameContent);
        }
        if (stristr($frameContent, '<link href="' . base_url('elements') . '/https://')) {
            $frameContent = str_replace('<link href="' . base_url('elements') . '/https://', '<link href="https://', $frameContent);
        }
        if (!stristr($frameContent, '<script src="js' . base_url('elements'))) {
            $frameContent = str_replace('<script src="js', '<script src="' . base_url('elements') . '/js', $frameContent);
        }
        if (!stristr($frameContent, 'src="' . base_url('elements') . '/images')) {
            $frameContent = str_replace('src="images', 'src="' . base_url('elements') . '/images', $frameContent);
        }
        if (stristr($frameContent, 'url(images')) {
            $frameContent = str_replace('url(images', 'url(' . base_url('elements') . '/images', $frameContent);
        }
        if (stristr($frameContent, 'src="./images')) {
            $frameContent = str_replace('src="./images', 'src="' . base_url('elements') . '/images', $frameContent);
        }
        if (stristr($frameContent, 'src="images')) {
            $frameContent = str_replace('src="images', 'src="' . base_url('elements') . '/images', $frameContent);
        }
        if (stristr($frameContent, 'href="./images')) {
            $frameContent = str_replace('href="./images', 'href="' . base_url('elements') . '/images', $frameContent);
        }
        echo $frameContent;
    }

    public function get_elements($elementsId)
    {
        $template = '<div class="">';
        
        $template .= $this->templatemodel->getSingleElement($elementsId) . "\r\n";
        
        $template .='</div>';
        $DOM = new DOMDocument();
        libxml_use_internal_errors(TRUE);
        $DOM->loadHTML($template, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_use_internal_errors(FALSE);
        echo $DOM->saveHTML();
        unset($DOM);
    }

    /*
      publishes a site
     */

    public function publish()
    {

        $this->load->helper('file');
        $this->load->helper('directory');
        $params = array('hostname' => $this->_hostName, 'username' => $this->_userName, 'password' => $this->_password);
        $this->load->library('CPanelAddons', $params, 'CPanelAddons');
        $remote_url = '';
//        $this->load->library('CPanelAddons');
        if (!isset($_POST['siteID'])) {

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_publish_error1_heading');
            $temp['content'] = $this->lang->line('sites_publish_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }

        //some error prevention first
        //siteID ok?
        $siteDetails = $this->sitemodel->getSite($_POST['siteID']);

        if ($siteDetails == false) {

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_publish_error1_heading');
            $temp['content'] = $this->lang->line('sites_publish_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }
        $userID = $siteDetails['site']->users_id;

        if ($siteDetails['site']->domain_ok != 1 || !isset($siteDetails['site']->domain)) {
            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_publish_error3_heading');
            $temp['content'] = $this->lang->line('sites_publish_error3_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }
        $path = 'public_html/' . $siteDetails['site']->domain;
        $absPath = './' . $siteDetails['site']->domain;
        if (!is_dir($absPath) && $siteDetails['site']->domain != '') {
            mkdir($absPath, 0777);
        }
        //do we have anythin to publish at all?
//		if( !isset( $_POST['xpages'] ) || $_POST['xpages'] == '' ) {
        if (!isset($_POST['item']) || $_POST['item'] == '') {
            //nothing to upload

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_publish_error2_heading');
            $temp['content'] = $this->lang->line('sites_publish_error2_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }

        if (isset($siteDetails['site']->url_option) && $siteDetails['site']->url_option != 'freeUrl' && $siteDetails['site']->domain_publish == 0) {
            $result = $this->CPanelAddons->add($siteDetails['site']->domain, $path);
            if (isset($result['cpanelresult']['data'][0]['result']) && trim($result['cpanelresult']['data'][0]['result']) == '0'
            ) {
                $return = array();

                $temp = array();
                $temp['header'] = $this->lang->line('sites_publish_error2_heading');
                $temp['content'] = "cPanel: " . $result['cpanelresult']['data'][0]['reason'];

                $return['responseCode'] = 0;
                $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);
                die(json_encode($return));
            } else {
                $this->users_domains_model->domain_publish($_POST['siteID']);
            }
        }
        if ($siteDetails['site']->url_option == 'freeUrl') {
            $remote_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $siteDetails['site']->domain;
        } else {
            $remote_url = 'http://' . $siteDetails['site']->domain;
        }
//		foreach( $_POST['xpages'] as $page=>$content ) {
        $page = $_POST['item'];
        $content = $_POST['pageContent'];
        //get page meta
        $pageMeta = $this->pagemodel->getSinglePage($_POST['siteID'], $page);

        if (!empty($pageMeta->pages_title)) {
            //insert title, meta keywords and meta description
            $title = '<title>' . $siteDetails['site']->sites_name . '</title>';
            $meta_description = '<meta name="description" content="' . $pageMeta->pages_meta_description . '">';
            $meta_keyword = '<meta name="keywords" content="' . $pageMeta->pages_meta_keywords . '">';
            $header_includes = $pageMeta->pages_header_includes;

            $pageContent = str_replace('<!--pageTitle-->', $title, $content);
            $pageContent = str_replace('<!--META-DESCRIPTION-->', $meta_description, $pageContent);
            $pageContent = str_replace('<!--META-KEYWORDS-->', $meta_keyword, $pageContent);

            //insert header includes;
            $pageContent = str_replace("<!--headerIncludes-->", $header_includes, $pageContent);
        } else {
            //insert title
            $title = '<title>' . $siteDetails['site']->sites_name . '</title>';

            $pageContent = str_replace('<!--pageTitle-->', $title, $content);
        }

        //remove video cover
        $pageContent = str_replace('<div style="" data-selector=".frameCover" class="frameCover" data-type="video"></div>', "", $pageContent);
        $pageContent = str_replace('<div style="margin: 0px;" data-selector=".frameCover" class="frameCover" data-type="video"></div>', "", $pageContent);
        $pageContent = str_replace('<div data-selector=".frameCover" class="frameCover" data-type="video"></div>', "", $pageContent);
        $pageContent = str_replace('<div data-type="video" class="frameCover" data-selector=".frameCover"></div>', "", $pageContent);
        $pageContent = str_replace('class="frameCover"', "", $pageContent);

        $pageContent = str_replace("<!-- site contact url div -->", '<div id="contact-url" data-content="' . site_url('login/site_contact/' . $this->encrypt->encode($_POST['siteID'])) . '"></div>', $pageContent);

        $pageContent = str_replace("<!-- site counter url div -->", '<div id="counter-url" data-content="' . site_url('login/visitor_counter/' . $this->encrypt->encode($_POST['siteID'])) . '"></div>', $pageContent);

        $pageContent = str_replace("<!-- site subscribe url div -->", '<div id="subscribe-url" data-content="' . site_url('login/subscribe/' . $this->encrypt->encode($_POST['siteID'])) . '"></div>', $pageContent);

        $pageContent = str_replace("<!-- site url div -->", '<div id="site-url" data-content="' . base_url('elements') . '"></div>', $pageContent);

        $pageContent = str_replace("<!-- page id div -->", '<div id="page-id" data-content="' . $pageMeta->pages_id . '"></div>', $pageContent);

        $pageContent = str_replace("<!-- page url div -->", '<div id="page-url" data-content="' . $remote_url . '/' . $page . '.html"></div>', $pageContent);

        if (!stristr($pageContent, '<link href="' . base_url('elements'))) {
            $pageContent = str_replace('<link href="', '<link href="' . base_url('elements') . '/', $pageContent);
        }
        if (stristr($pageContent, '<link href="' . base_url('elements') . '/https://')) {
            $pageContent = str_replace('<link href="' . base_url('elements') . '/https://', '<link href="https://', $pageContent);
        }
        if (!stristr($pageContent, '<script src="' . base_url('elements') . '/js')) {
            $pageContent = str_replace('<script src="js', '<script src="' . base_url('elements') . '/js', $pageContent);
        }
        if (stristr($pageContent, 'src="' . base_url('elements') . '/https://')) {
            $pageContent = str_replace('src="' . base_url('elements') . '/https://', 'src="https://', $pageContent);
        }
        if (stristr($pageContent, '<script src="' . base_url('elements') . '/http://')) {
            $pageContent = str_replace('<script src="' . base_url('elements') . '/http://', '<script src="http://', $pageContent);
        }
        if (strstr($pageContent, 'src="/elements/images')) {
            $pageContent = str_replace('src="/elements/images', 'src="' . base_url('elements') . '/images', $pageContent);
        }
        if (strstr($pageContent, 'url(&quot;/elements/images')) {
            $pageContent = str_replace('url(&quot;/elements/images', 'url(&quot;' . site_url('elements/images'), $pageContent);
        }
        if (stristr($pageContent, 'href="scripts')) {
            $pageContent = str_replace('href="scripts', 'href="' . base_url('elements') . '/scripts', $pageContent);
        }
        if (stristr($pageContent, '<script src="scripts')) {
            $pageContent = str_replace('<script src="scripts', '<script src="' . base_url('elements') . '/scripts', $pageContent);
        }
        if (stristr($pageContent, 'href="images')) {
            $pageContent = str_replace('href="images', 'href="' . base_url('elements') . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="./images')) {
            $pageContent = str_replace('src="./images', 'src="' . base_url('elements') . '/images', $pageContent);
        }
        if (stristr($pageContent, 'href="./images')) {
            $pageContent = str_replace('href="./images', 'href="' . base_url('elements') . '/images', $pageContent);
        }
        write_file($absPath . '/' . $page . ".html", $pageContent);
//		}
        (isset($userID) && $userID != '') ? remove_directory('./temp/' . $userID) : '';

        $this->sitemodel->publish($_POST['siteID'], base_url() . $siteDetails['site']->domain);

        if ($siteDetails['site']->url_option == 'freeUrl') {
            $this->users_domains_model->domain_publish($_POST['siteID']);
        }

        //delete directory subdomain and addons as if user change his domain except freeurl option
        $inactive_domains = $this->users_domains_model->inative_domain($_POST['siteID']);
        if (isset($inactive_domains) && is_array($inactive_domains)) {
            foreach ($inactive_domains as $inact_dom) {
                //delete sub domain 
                if (userdata('plan_id') != 1) {
                    $delAddon_result = $this->CPanelAddons->deladdondomain($inact_dom->domain, "jadooweb.com");
                    $delSub_result = $this->CPanelAddons->delSub($inact_dom->domain, "jadooweb.com");
                }
                $delDir_result = $this->CPanelAddons->delDirectory($inact_dom->domain);
            }
        }

        //all went well
        $return = array();

        $return['responseCode'] = 1;

        die(json_encode($return));
    }

    /*
      preview a site
     */

    public function preview()
    {

        //do we have anythin to preview at all?
        if (!isset($_POST['page']) || $_POST['page'] == '') {
            die("No page found");
        }

        if (!is_writable('./temp/')) {
            chmod('./temp/', 0777);
        }

        $filename = "temp/preview_" . $this->generateRandomString(20) . ".html";
        $previewFile = fopen($filename, "w");

        if (isset($_POST['siteID']) && !empty($_POST['siteID'])) {
            $siteDetails = $this->sitemodel->getSite($_POST['siteID']);

            if ($siteDetails == false) {
                die("No details found");
            }

            $pageMeta = $this->pagemodel->getSinglePage($_POST['siteID'], 'index');

            if (!empty($pageMeta->pages_title)) {
                //insert title, meta keywords and meta description
                $title = '<title>' . $siteDetails['site']->sites_name . '</title>';
                $meta_description = '<meta name="description" content="' . $pageMeta->pages_meta_description . '">';
                $meta_keyword = '<meta name="keywords" content="' . $pageMeta->pages_meta_keywords . '">';
                $header_includes = $pageMeta->pages_header_includes;

                $pageContent = str_replace('<!--pageTitle-->', $title, $_POST['page']);
                $pageContent = str_replace('<!--META-DESCRIPTION-->', $meta_description, $pageContent);
                $pageContent = str_replace('<!--META-KEYWORDS-->', $meta_keyword, $pageContent);

                //insert header includes;
                $pageContent = str_replace("<!--headerIncludes-->", $header_includes, $pageContent);
            } else {
                //insert title
                $title = '<title>' . $siteDetails['site']->sites_name . '</title>';

                $pageContent = str_replace('<!--pageTitle-->', $title, $_POST['page']);
            }
        } else {
            $title = '<title>Template Preview</title>';

            $pageContent = str_replace('<!--pageTitle-->', $title, $_POST['page']);
        }

        if (stristr($pageContent, 'href="css')) {
            $pageContent = str_replace('href="css', 'href="' . base_url('elements') . '/css', $pageContent);
        }
        if (stristr($pageContent, 'href="scripts')) {
            $pageContent = str_replace('href="scripts', 'href="' . base_url('elements') . '/scripts', $pageContent);
        }
        if (stristr($pageContent, 'href="images')) {
            $pageContent = str_replace('href="images', 'href="' . base_url('elements') . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="scripts')) {
            $pageContent = str_replace('src="scripts', 'src="' . base_url('elements') . '/scripts', $pageContent);
        }
        if (stristr($pageContent, 'url(images')) {
            $pageContent = str_replace('url(images', 'url(' . base_url('elements') . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="./images')) {
            $pageContent = str_replace('src="./images', 'src="' . base_url('elements') . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="images')) {
            $pageContent = str_replace('src="images', 'src="' . base_url('elements') . '/images', $pageContent);
        }
        if (stristr($pageContent, 'href="./images')) {
            $pageContent = str_replace('href="./images', 'href="' . base_url('elements') . '/images', $pageContent);
        }

        fwrite($previewFile, stripcslashes($pageContent));

        fclose($previewFile);
        header('Location: ' . base_url($filename));
    }

    /*

      moves a single site to the trash bin

     */

    public function trash($siteID = '')
    {

        $this->load->helper('file');
        if ($siteID == '' || $siteID == 'undefined') {

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_trash_error1_heading');
            $temp['content'] = $this->lang->line('sites_trash_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }

        $params = array('hostname' => $this->_hostName, 'username' => $this->_userName, 'password' => $this->_password);
        $this->load->library('CPanelAddons', $params, 'CPanelAddons');

        $siteData = $this->sitemodel->getSite($siteID);

        if (isset($siteData['site']->domain) && $siteData['site']->published) {
            $result = $this->CPanelAddons->delSub($siteData['site']->domain, "jadooweb.com");
            if (isset($result['cpanelresult']['data'][0]['result']) && trim($result['cpanelresult']['data'][0]['result']) == '0') {
                $return = array();

                $temp = array();
                $temp['header'] = $this->lang->line('sites_trash_error1_heading');
                $temp['content'] = "cPanel: " . $result['cpanelresult']['data'][0]['reason'];

                $return['responseCode'] = 0;
                $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);
                die(json_encode($return));
            }
            $absPath = './' . $siteData['site']->domain;
            remove_directory($absPath);
        }
        //all good, move to trash

        $this->sitemodel->trash($siteID);

        $return = array();

        $temp = array();
        $temp['header'] = $this->lang->line('sites_trash_success_heading');
        $temp['content'] = $this->lang->line('sites_trash_success_message');

        $return['responseCode'] = 1;
        $return['responseHTML'] = $this->load->view('partials/success', array('data' => $temp), true);

        die(json_encode($return));
    }

    /*

      updates page meta data via ajax

     */

    public function updatePageData()
    {

        if ($_POST['siteID'] == '' || $_POST['siteID'] == 'undefined' || !isset($_POST)) {

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_updatePageData_error1_heading');
            $temp['content'] = $this->lang->line('sites_updatePageData_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }

        //update page data
        $this->pagemodel->updatePageData($_POST);

        $return = array();

        //return page data as well
        $pagesData = $this->pagemodel->getPageData($_POST['siteID']);

        if ($pagesData) {
            $return['pagesData'] = $pagesData;
        }

        $temp = array();
        $temp['header'] = $this->lang->line('sites_updatePageData_success_heading');
        $temp['content'] = $this->lang->line('sites_updatePageData_success_message');

        $return['responseCode'] = 1;
        $return['responseHTML'] = $this->load->view('partials/success', array('data' => $temp), true);
        $siteData = $this->sitemodel->getSite($_POST['siteID']);
        $return['siteName'] = $siteData['site']->sites_name;
        $return['siteID'] = $siteData['site']->sites_id;
        die(json_encode($return));
    }

    public function checkDomain()
    {
        if (isset($_POST['domain']) && $_POST['domain'] != '') {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $_POST['domain'];
            if ($this->sitemodel->checkDomainAvailability($_POST['domain'])) {
                $return['error'] = 0;
                $return['errorMessage'] = $url . ' is available.';
                echo json_encode($return);
            } else {
                $return['error'] = 1;
                $return['errorMessage'] = $url . ' is not available.';
                die(json_encode($return));
            }
        }
    }

    /*
     * Page Delete function to delete sites pages
     * 
     */

    public function page_delete()
    {
        if (isset($_POST['site_id']) && $_POST['page_name'] != '') {
            if ($this->sitemodel->delete_pages($_POST['site_id'], $_POST['page_name'])) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    //function to create users products......shubhangee
    public function createuserproducts()
    {
        $site_id = $_POST['site_id'];
        $productid = $_POST['productid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pdescription = $_POST['pdescription'];
        $img1 = $_POST['img1'];

        $this->sitemodel->createuserproducts($site_id, $productid, $pname, $pprice, $pdescription, $img1);
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getUserImage()
    {
        $userID = userdata('user_id');
        $type = 'image';
        $bucket = $this->media_storage_model->getBucket($userID);
        if (!$bucket) {
            $bucket = 'mumbaistreet';
        } else {
            $bucket = $bucket->bucket_name;
        }
        $uri = $this->media_storage_model->getUri($userID);
        if ($uri) {
            $uri = $uri->uri;
        } else {
            $uri = $this->media_storage_model->genrate_unique_name();
        }

        $userImages = $this->s3->getBucket($bucket, $uri . '/Images');

        $return['responseHTML'] = $this->load->view('partials/myimagetab', array('userImages' => $userImages, 'bucket' => $bucket), true);
        echo json_encode($return);
    }

    public function getAdminImage()
    {
        $adminImages = $this->sitemodel->adminImages();

        $return['responseHTML'] = $this->load->view('partials/adminimagetab', array('adminImages' => $adminImages), true);
        echo json_encode($return);
    }

    /*
      get and retrieve the user and his details
     */

    public function shareprofile($siteID = "")
    {

        if ($siteID == '' || $siteID == 'undefined') {

            //siteID is missing

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_siteAjax_error1_heading');
            $temp['content'] = $this->lang->line('sites_siteAjax_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }

        $siteData = $this->sitemodel->getSite($siteID);

        // Get user Details 
        $userID = userdata('user_id');
        $userData = $this->sitemodel->getUserDetailsUserId($userID);

        if ($siteData == false && $userData == false) {

            //all did not go well
            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_siteAjax_error2_heading');
            $temp['content'] = $this->lang->line('sites_siteAjax_error2_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            echo json_encode($return);
        } else {

            //all went well
            $return = array();

            $return['responseCode'] = 1;
            $return['responseHTML'] = $this->load->view('partials/shareprofile', array('userdata' => $userData, 'siteData' => $siteData['site']), true);

            echo json_encode($return);
        }
    }

    /*
      Updates resume of Student
     */

    public function updateMyResume()
    {
        $this->form_validation->set_rules('siteID', 'Site ID', 'required');
        $this->form_validation->set_rules('pageID', 'Page Id', 'required');
        $this->form_validation->set_rules('resume', 'Resume Sections', 'required');

        if ($this->form_validation->run() == FALSE) {

            //all did not go well
            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_siteAjaxUpdate_error1_heading');
            $temp['content'] = $this->lang->line('sites_siteAjaxUpdate_error1_message1') . validation_errors();

            $return['responseCode'] = 0;
            $return['responseALERT'] = '<div class="alert alert-danger fade in">
					<strong>Error! </strong> Error while processing your request...
			</div>';

            echo json_encode($return);
        } else {
            $return = array();
            $user_id = $this->session->userdata('user_id');

            // check the data available in the database if yes update it else create new. 
            $hasData = $this->sitemodel->checkProfile($user_id, $_POST['siteID'], $_POST['pageID']);
            if (count($_POST) > 0 && $_POST['resume'] === 'basic') {

                $temp = array();
                $temp['resume_headline'] = isset($_POST['r_title']) ? $_POST['r_title'] : "";
                $temp['summery'] = isset($_POST['r_desc']) ? $_POST['r_desc'] : "";
                $temp['company'] = isset($_POST['r_company']) ? $_POST['r_company'] : "";
                $temp['role'] = isset($_POST['r_role']) ? $_POST['r_role'] : "";
                $temp['notice_period'] = $_POST['r_notice_p'];
                $temp['location'] = isset($_POST['r_clocaltion']) ? $_POST['r_clocaltion'] : "";
                $temp['preff_location'] = isset($_POST['r_plocation']) ? $_POST['r_plocation'] : "";
                $temp['salary'] = $_POST['cctc'];
                $temp['expected_salary'] = $_POST['ectc'];
                $temp['total_exp'] = isset($_POST['r_tot_exp']) ? $_POST['r_tot_exp'] : 0;

                if ($hasData == 1) {
                    // Update the data 

                    $dataUpdated = $this->sitemodel->updateBasicDetails($user_id, $_POST['siteID'], $_POST['pageID'], $temp);
                    if ($dataUpdated == 1) {
                        $return['responseCode'] = 1;
                        $return['responseALERT'] = '<div class="alert alert-success fade in">
							<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
							<strong>Success!</strong> Basic Details Updated.
						</div>';
                    } else {
                        $return['responseALERT'] = '<div class="alert alert-danger fade in">
							<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
							<strong>Error! </strong> Error with basic profile updates.
						</div>';
                    }
                } else {
                    // Create New Entry

                    $temp['site_id'] = isset($_POST['siteID']) ? $_POST['siteID'] : 0;
                    $temp['page_id'] = isset($_POST['pageID']) ? $_POST['pageID'] : 0;
                    $temp['user_id'] = isset($user_id) ? $user_id : 0;
                    $temp['created_date'] = time();

                    $dataUpdated = $this->sitemodel->createBasicDetails($temp);
                    if ($dataUpdated == 1) {
                        $return['responseALERT'] = '<div class="alert alert-success fade in">
							<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
							<strong>Success!</strong> Basic Details Created...!
						</div>';
                    } else {
                        $return['responseALERT'] = '<div class="alert alert-danger fade in">
							<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
							<strong>Error! </strong> Basic Details Not Created...!
						</div>';
                    }
                }
            } else if ($_POST['resume'] === 'education') {
                if (count($_POST) > 0 && isset($_POST['institute']) && $_POST['institute'] != "" && isset($_POST['institute']) && $_POST['institute'] != "" && isset($_POST['per']) && $_POST['per'] != "") {
                    $temp = array();
                    $temp['site_id'] = isset($_POST['siteID']) ? $_POST['siteID'] : 0;
                    $temp['page_id'] = isset($_POST['pageID']) ? $_POST['pageID'] : 0;
                    $temp['user_id'] = isset($user_id) ? $user_id : 0;
                    $temp['school'] = isset($_POST['institute']) ? $_POST['institute'] : "";
                    $temp['from_date'] = isset($_POST['syear']) ? $_POST['syear'] : "";
                    $temp['to_date'] = isset($_POST['eyear']) ? $_POST['eyear'] : "";
                    $temp['degree'] = isset($_POST['degree']) ? $_POST['degree'] : "";
                    $temp['percentage'] = isset($_POST['per']) ? $_POST['per'] : 0.00;

                    $insData = $this->sitemodel->createEducationDetails($temp);
                    if ($insData != 0) {
                        $payLoad = '<div class="col-sm-12">
							<div class="col-sm-2">' . $temp['degree'] . '</div>
							<div class="col-sm-4">' . $temp['school'] . '</div>
							<div class="col-sm-2">' . $temp['from_date'] . '-' . $temp['to_date'] . '</div>
							<div class="col-sm-2">' . $temp['percentage'] . '</div>
							<div class="col-sm-2"><button type="button" id="' . $insData . '" class="btn btn-info btn-embossed deleteEducation">X</button></div>
						</div>';


                        $return['responseCode'] = 1;
                        $return['responseALERT'] = '<div class="alert alert-success fade in">
							<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
							<strong>Success!</strong> Education Details Added.
						</div>';
                        $return['payload'] = $payLoad;
                    } else {
                        $return['responseCode'] = 0;
                        $return['responseALERT'] = '<div class="alert alert-danger fade in">
							<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
							<strong>Error! </strong> Please Re-try to Insert Education...!
						</div>';
                    }
                } else {
                    $return['responseCode'] = 0;
                    $return['responseALERT'] = '<div class="alert alert-info fade in">
						<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
						<strong>Error! </strong> Please Enter Details to Update Education...!
					</div>';
                }
            } else if ($_POST['resume'] === 'skills') {
                $return = array();
                // Process the data to insert into database.
                if (count($_POST) > 0 && isset($_POST['skillname']) && $_POST['skillname'] != "" && isset($_POST['experience']) && $_POST['experience'] != "" && isset($_POST['rating']) && $_POST['rating'] != "") {
                    $temp = array();
                    $temp['site_id'] = isset($_POST['siteID']) ? $_POST['siteID'] : 0;
                    $temp['page_id'] = isset($_POST['pageID']) ? $_POST['pageID'] : 0;
                    $temp['user_id'] = isset($user_id) ? $user_id : 0;
                    $temp['name'] = isset($_POST['skillname']) ? $_POST['skillname'] : "";
                    $temp['experience'] = isset($_POST['experience']) ? $_POST['experience'] : "";
                    $temp['rating'] = isset($_POST['rating']) ? $_POST['rating'] : "";

                    $insData = $this->sitemodel->insertSkills($temp);

                    if ($insData != 0) {
                        $payload = '
								<div class="col-sm-12">
									<div class="col-sm-3">' . $temp['name'] . '</div>
									<div class="col-sm-3">' . $temp['experience'] . '</div>
									<div class="col-sm-3">' . $temp['rating'] . '</div>
									<div class="col-sm-3"><button type="button" id="' . $insData . '" class="btn btn-info btn-embossed deleteSkill">X</button></div>
								</div>							
							';
                        $return['responseCode'] = 1;
                        $return['responseALERT'] = '<div class="alert alert-success fade in">
								<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
								<strong>Success!</strong> Skills Added For Your Profile.
							</div>';
                        $return['payload'] = $payload;
                    } else {
                        $return['responseCode'] = 0;
                        $return['responseALERT'] = '<div class="alert alert-danger fade in">
								<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
								<strong>Error! </strong> Please Re-try to Update Skills...!
							</div>';
                    }
                } else {
                    $return['responseCode'] = 0;
                    $return['responseALERT'] = '<div class="alert alert-danger fade in">
						<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
						<strong>Error! </strong> Enter All Details To Update Skills...!
					</div>';
                }
            } else if ($_POST['resume'] === 'language') {
                $return = array();
                // Process the data to insert into database.
                if (count($_POST) > 0 && isset($_POST['languagenm']) && $_POST['languagenm'] != "" && isset($_POST['rating']) && $_POST['rating'] != "") {

                    $temp = array();
                    $temp['site_id'] = isset($_POST['siteID']) ? $_POST['siteID'] : 0;
                    $temp['page_id'] = isset($_POST['pageID']) ? $_POST['pageID'] : 0;
                    $temp['user_id'] = isset($user_id) ? $user_id : 0;
                    $temp['language'] = isset($_POST['languagenm']) ? $_POST['languagenm'] : "";
                    $temp['rating'] = isset($_POST['rating']) ? $_POST['rating'] : "";

                    $insData = $this->sitemodel->insertLang($temp);
                    if ($insData != "") {
                        $payload = '
							<div class="col-sm-12">
								<div class="col-sm-4">' . $temp['language'] . '</div>
								<div class="col-sm-4">' . $temp['rating'] . '</div>
								<div class="col-sm-4"><button type="button" id="' . $insData . '" class="btn btn-info btn-embossed deleteLang">X</button></div>
							</div>						
						';
                        $return['responseCode'] = 1;
                        $return['responseALERT'] = '<div class="alert alert-success fade in">
							<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
							<strong>Success!</strong> Languages Skill Added For Your Profile.
						</div>';
                        $return['payload'] = $payload;
                    } else {
                        $return['responseCode'] = 0;
                        $return['responseALERT'] = '<div class="alert alert-danger fade in">
							<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
							<strong>Error! </strong> Please Re-try to Add Languages...!
						</div>';
                    }
                } else {
                    $return['responseCode'] = 0;
                    $return['responseALERT'] = '<div class="alert alert-danger fade in">
						<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
						<strong>Error! </strong> Insert All Details To Update Language Skills...!
					</div>';
                }
            } else {
                
            }
            echo json_encode($return);
            //Now check for the 
        }
    }

    /*
      Delete the resume details
     */

    public function deleteCVDetails()
    {
        if (count($_POST) > 0 && isset($_POST['delete']) && isset($_POST['id'])) {
            $return = array();
            if ($_POST['delete'] === "education") {
                $delData = $this->sitemodel->deleteEducation($_POST['id']);
                if ($delData == 1) {
                    $return['responseCode'] = 1;
                    $return['responseALERT'] = '<div class="alert alert-success fade in">
						<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
						<strong>Success!</strong> Education Details Deleted.
					</div>';
                } else {
                    $return['responseCode'] = 0;
                    $return['responseALERT'] = '<div class="alert alert-danger fade in">
						<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
						<strong>Error! </strong> No Education details selected...!
					</div>';
                }
            } else if ($_POST['delete'] === "skills") {
                $delData = $this->sitemodel->deleteSkills($_POST['id']);
                if ($delData == 1) {
                    $return['responseCode'] = 1;
                    $return['responseALERT'] = '<div class="alert alert-success fade in">
						<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
						<strong>Success!</strong> Skills Deleted.
					</div>';
                } else {
                    $return['responseCode'] = 0;
                    $return['responseALERT'] = '<div class="alert alert-danger fade in">
						<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
						<strong>Error! </strong> No skill selected to delete...!
					</div>';
                }
            } else if ($_POST['delete'] === "lang") {
                $delData = $this->sitemodel->deleteLanguages($_POST['id']);
                if ($delData == 1) {
                    $return['responseCode'] = 1;
                    $return['responseALERT'] = '<div class="alert alert-success fade in">
						<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
						<strong>Success!</strong> Language Deleted.
					</div>';
                } else {
                    $return['responseCode'] = 0;
                    $return['responseALERT'] = '<div class="alert alert-danger fade in">
						<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
						<strong>Error! </strong> No language selected to delete...!
					</div>';
                }
            }
        } else {
            $return['responseCode'] = 0;
            $return['responseALERT'] = '<div class="alert alert-danger fade in">
				<a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
				<strong>Error! </strong> Something went wrong please refresh page and try again...!
			</div>';
        }

        echo json_encode($return);
    }

    /*
      publishes a site
     */

    public function publish_student()
    {
        $base_url_all = base_url('studentelements');

        $this->load->helper('file');
        $this->load->helper('directory');
        $params = array('hostname' => $this->_hostName, 'username' => $this->_userName, 'password' => $this->_password);
        $this->load->library('CPanelAddons', $params, 'CPanelAddons');
        $remote_url = '';
//        $this->load->library('CPanelAddons');
        if (!isset($_POST['siteID'])) {

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_publish_error1_heading');
            $temp['content'] = $this->lang->line('sites_publish_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }

        //some error prevention first
        //siteID ok?
        $siteDetails = $this->sitemodel->getSite($_POST['siteID']);

        if ($siteDetails == false) {

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_publish_error1_heading');
            $temp['content'] = $this->lang->line('sites_publish_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }
        $userID = $siteDetails['site']->users_id;

        if ($siteDetails['site']->domain_ok != 1 || !isset($siteDetails['site']->domain)) {
            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_publish_error3_heading');
            $temp['content'] = $this->lang->line('sites_publish_error3_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }
        $path = 'public_html/' . $siteDetails['site']->domain;
        $absPath = './' . $siteDetails['site']->domain;
        if (!is_dir($absPath) && $siteDetails['site']->domain != '') {
            mkdir($absPath, 0777);
        }
        //do we have anythin to publish at all?
//		if( !isset( $_POST['xpages'] ) || $_POST['xpages'] == '' ) {
        if (!isset($_POST['item']) || $_POST['item'] == '') {
            //nothing to upload

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_publish_error2_heading');
            $temp['content'] = $this->lang->line('sites_publish_error2_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }

        if (isset($siteDetails['site']->url_option) && $siteDetails['site']->url_option != 'freeUrl' && $siteDetails['site']->domain_publish == 0) {
            $result = $this->CPanelAddons->add($siteDetails['site']->domain, $path);
            if (isset($result['cpanelresult']['data'][0]['result']) && trim($result['cpanelresult']['data'][0]['result']) == '0'
            ) {
                $return = array();

                $temp = array();
                $temp['header'] = $this->lang->line('sites_publish_error2_heading');
                $temp['content'] = "cPanel: " . $result['cpanelresult']['data'][0]['reason'];

                $return['responseCode'] = 0;
                $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);
                die(json_encode($return));
            } else {
                $this->users_domains_model->domain_publish($_POST['siteID']);
            }
        }
        if ($siteDetails['site']->url_option == 'freeUrl') {
            $remote_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $siteDetails['site']->domain;
        } else {
            $remote_url = 'http://' . $siteDetails['site']->domain;
        }
//		foreach( $_POST['xpages'] as $page=>$content ) {
        $page = $_POST['item'];
        $content = $_POST['pageContent'];

        //get page meta
        $pageMeta = $this->pagemodel->getSinglePage($_POST['siteID'], $page);

        $meta = '<title>' . $siteDetails['site']->sites_name . '</title>' . "\r\n";
        $header_includes = "";
        if (!empty($pageMeta->pages_title)) {
            //insert title, meta keywords and meta description

            $meta .= '<meta name="description" content="' . $pageMeta->pages_meta_description . '">' . "\r\n";
            $meta .= '<meta name="keywords" content="' . $pageMeta->pages_meta_keywords . '">';

            $header_includes .= $pageMeta->pages_header_includes;

            $pageContent = str_replace('<!--pageMeta-->', $meta, $content);

            //insert header includes;
            $pageContent = str_replace("<!--headerIncludes-->", $header_includes, $pageContent);
        } else {

            $pageContent = str_replace('<!--pageMeta-->', $meta, $content);
            $pageContent = str_replace("<!--headerIncludes-->", $header_includes, $pageContent);
        }

        //remove video cover
        $pageContent = str_replace('<div style="" data-selector=".frameCover" class="frameCover" data-type="video"></div>', "", $pageContent);
        $pageContent = str_replace('<div style="margin: 0px;" data-selector=".frameCover" class="frameCover" data-type="video"></div>', "", $pageContent);
        $pageContent = str_replace('<div data-selector=".frameCover" class="frameCover" data-type="video"></div>', "", $pageContent);
        $pageContent = str_replace('<div data-type="video" class="frameCover" data-selector=".frameCover"></div>', "", $pageContent);
        $pageContent = str_replace('class="frameCover"', "", $pageContent);

        /* STUDENT SECTION NEEDED */

        $valUrl = base_url();
        $accUrl = site_url('login/checkProfileLogin/' . $this->encrypt->encode($_POST['siteID']));
        $script = <<<'EOS'
				<?PHP 
                session_start();
                if(!isset($_SESSION) || session_id() == "") { 
					if(isset($_REQUEST['sessid']) && $_REQUEST['sessid']!="" ) {
						list($sid, $ext) = explode('-', $_REQUEST['sessid']);
						session_id($sid);
					}
				} 
			?>
EOS;

        $sessionSet = <<<'EOD'
		<?PHP
EOD;
        $sessionSet .= '  $sess = isset($_SESSION["extids"]["' . base64_encode($siteDetails['site']->site_id) . '"])?$_SESSION["extids"]["' . base64_encode($siteDetails['site']->site_id) . '"]:"";';
        $sessionSet .= <<<'EOD'

			if(is_array($_SESSION) && count($_SESSION)>0 && isset($sess)) {
				?>
				<input type="hidden" class="myid" name="myid" value="<?PHP echo base64_encode($sess); ?>">
				<?PHP
			}
			else {
				?>
				<input type="hidden" class="myid" name="myid" value="">
				<?PHP
				
			}
		?>
EOD;

        $pageContent = str_replace("<!-- password check url -->", '<input type="hidden" class="siteurl" name="siteurl" value="' . $valUrl . '">', $pageContent);
        $pageContent = str_replace("<!-- site url -->", '<input type="hidden" class="siteaccess" name="siteaccess" value="' . $accUrl . '">', $pageContent);
        $pageContent = str_replace("<!-- session -->", $script, $pageContent);
        $pageContent = str_replace("<!-- password protection on-->", '<input type="hidden" class="hiddenpassword" name="haspassword" value="' . $siteDetails['site']->has_password . '">', $pageContent);
        $pageContent = str_replace("<!-- session variable -->", $sessionSet, $pageContent);

        $pageContent = str_replace("<!-- site id -->", '<input type="hidden" class="siteId" name="siteId" value="' . base64_encode($siteDetails['site']->site_id) . '">', $pageContent);


        /* STUDENT SECTION NEEDED ENDS */

        $pageContent = str_replace("<!-- site contact url div -->", '<div id="contact-url" data-content="' . site_url('login/site_contact/' . $this->encrypt->encode($_POST['siteID'])) . '"></div>', $pageContent);

        $pageContent = str_replace("<!-- site counter url div -->", '<div id="counter-url" data-content="' . site_url('login/visitor_counter/' . $this->encrypt->encode($_POST['siteID'])) . '"></div>', $pageContent);

        $pageContent = str_replace("<!-- site url div -->", '<div id="site-url" data-content="' . $base_url_all . '"></div>', $pageContent);

        $pageContent = str_replace("<!-- page id div -->", '<div id="page-id" data-content="' . $pageMeta->pages_id . '"></div>', $pageContent);

        $pageContent = str_replace("<!-- page url div -->", '<div id="page-url" data-content="' . $remote_url . '/' . $page . '.php"></div>', $pageContent);


        if (!stristr($pageContent, '<link href="' . base_url('elements'))) {
            $pageContent = str_replace('<link href="', '<link href="' . $base_url_all . '/', $pageContent);
        }
        if (stristr($pageContent, '<link href="' . $base_url_all . '/https://')) {
            $pageContent = str_replace('<link href="' . $base_url_all . '/https://', '<link href="https://', $pageContent);
        }
        if (!stristr($pageContent, '<script src="' . $base_url_all . '/js')) {
            $pageContent = str_replace('<script src="js', '<script src="' . $base_url_all . '/js', $pageContent);
        }
        if (stristr($pageContent, 'src="' . $base_url_all . '/https://')) {
            $pageContent = str_replace('src="' . $base_url_all . '/https://', 'src="https://', $pageContent);
        }
        if (stristr($pageContent, '<script src="' . $base_url_all . '/http://')) {
            $pageContent = str_replace('<script src="' . $base_url_all . '/http://', '<script src="http://', $pageContent);
        }
        if (strstr($pageContent, 'src="/elements/images')) {
            $pageContent = str_replace('src="/elements/images', 'src="' . $base_url_all . '/images', $pageContent);
        }
        if (strstr($pageContent, 'url(&quot;/elements/images')) {
            $pageContent = str_replace('url(&quot;/elements/images', 'url(&quot;' . site_url('elements/images'), $pageContent);
        }
        if (strstr($pageContent, 'url(&quot;/studentelements/images')) {
            $pageContent = str_replace('url(&quot;/studentelements/images', 'url(&quot;' . site_url('studentelements/images'), $pageContent);
        }
        if (strstr($pageContent, 'src="/studentelements/images')) {
            $pageContent = str_replace('src="/studentelements/images', 'src="' . $base_url_all . '/images', $pageContent);
        }
        if (stristr($pageContent, 'href="scripts')) {
            $pageContent = str_replace('href="scripts', 'href="' . $base_url_all . '/scripts', $pageContent);
        }
        if (stristr($pageContent, '<script src="scripts')) {
            $pageContent = str_replace('<script src="scripts', '<script src="' . $base_url_all . '/scripts', $pageContent);
        }
        if (stristr($pageContent, 'href="images')) {
            $pageContent = str_replace('href="images', 'href="' . $base_url_all . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="./images')) {
            $pageContent = str_replace('src="./images', 'src="' . $base_url_all . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="../elements/scripts')) {
            $pageContent = str_replace('src="../elements/scripts', 'src="' . site_url('/elements/scripts'), $pageContent);
        }
        if (stristr($pageContent, 'href="./images')) {
            $pageContent = str_replace('href="./images', 'href="' . $base_url_all . '/images', $pageContent);
        }
        write_file($absPath . '/' . $page . ".php", trim($pageContent));
//		}
        (isset($userID) && $userID != '') ? remove_directory('./temp/' . $userID) : '';

        $this->sitemodel->publish($_POST['siteID'], base_url() . $siteDetails['site']->domain);

        if ($siteDetails['site']->url_option == 'freeUrl') {
            $this->users_domains_model->domain_publish($_POST['siteID']);
        }

        //all went well
        $return = array();

        $return['responseCode'] = 1;

        die(json_encode($return));
    }

    /*
      Send the mail to the users.
     */

    public function shareMyResume()
    {
        if ($_POST['siteID'] == '' || $_POST['siteID'] == 'undefined' || !isset($_POST)) {

            $return = array();
            $temp = array();
            $temp['header'] = $this->lang->line('sites_shareProfile_error1_heading');
            $temp['content'] = $this->lang->line('sites_shareprofile_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error_inline', array('data' => $temp), true);

            die(json_encode($return));
        }
        // Return site data as well
        $siteDetails = $this->sitemodel->getSite($_POST['siteID']);
        if (count($siteDetails) > 0) {
            $URL = $siteDetails["site"]->remote_url;
            $userName = $this->sitemodel->getUserByUserId($siteDetails["site"]->users_id);
            $toAddres = isset($_POST['shareEmail']) ? $_POST['shareEmail'] : "";

            $contents = isset($_POST['emailcontents']) ? $_POST['emailcontents'] : "";
            //$contents = str_replace('{{NAME}}',$userName,$contents);
            //$contents = str_replace('{{PROFILEURL}}',$URL,$contents);
            $subLine = $userName . " Profile";

            if (isset($toAddres) && !empty($toAddres)) {
                $temp['header'] = "";
                $temp['content'] = $contents;
                //$this->load->view('partials/error', array('data' => $temp));
                $res = $this->sitemodel->shareProfileEmail($toAddres, $contents, $subLine);
                if (count($res) > 0) {
                    $return = array();
                    $temp = array();
                    $temp['header'] = $this->lang->line('sites_shareProfile_success_heading');
                    $temp['content'] = $this->lang->line('sites_shareprofile_success_message');

                    $return['responseCode'] = 1;
                    $return['responseHTML'] = $this->load->view('partials/success_inline', array('data' => $temp), true);

                    die(json_encode($return));
                } else {
                    
                }
            } else {
                $return = array();
                $temp = array();
                $temp['header'] = $this->lang->line('sites_shareProfile_error1_heading');
                $temp['content'] = $this->lang->line('sites_shareprofile_error2_message');

                $return['responseCode'] = 0;
                $return['responseHTML'] = $this->load->view('partials/error_inline', array('data' => $temp), true);

                die(json_encode($return));
            }
        } else {

            $return = array();
            $temp = array();
            $temp['header'] = $this->lang->line('sites_shareProfile_error1_heading');
            $temp['content'] = $this->lang->line('sites_shareprofile_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error_inline', array('data' => $temp), true);

            die(json_encode($return));
        }
        //var_dump($siteDetails);
    }

    /*

      Update the password for the site for studen profile

     */

    public function updatePasswordData()
    {

        if ($_POST['siteID'] == '' || $_POST['siteID'] == 'undefined' || !isset($_POST)) {

            $return = array();

            $temp = array();
            $temp['header'] = $this->lang->line('sites_updatePageData_error1_heading');
            $temp['content'] = $this->lang->line('sites_updatePageData_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data' => $temp), true);

            die(json_encode($return));
        }

        //update site password.
        $this->sitemodel->updateSitePassword($_POST);

        $return = array();

        //return site data as well
        $pagesData = $this->pagemodel->getPageData($_POST['siteID']);

        if ($pagesData) {
            $return['pagesData'] = $pagesData;
        }

        $temp = array();
        $temp['header'] = $this->lang->line('sites_updatePageData_success_heading');
        $temp['content'] = $this->lang->line('sites_updatePageData_success_message');

        $return['responseCode'] = 1;
        $return['responseHTML'] = $this->load->view('partials/success', array('data' => $temp), true);
        $siteData = $this->sitemodel->getSite($_POST['siteID']);
        $return['siteName'] = $siteData['site']->sites_name;
        $return['siteID'] = $siteData['site']->sites_id;
        die(json_encode($return));
    }

    /*
      preview a site student
     */

    public function preview_student()
    {
        //some error prevention first
        $siteDetails = $this->sitemodel->getSite($_POST['siteID']);

        if ($siteDetails == false) {
            die("No details found");
        }
        //do we have anythin to preview at all?
        if (!isset($_POST['page']) || $_POST['page'] == '') {
            die("No page found");
        }

        if (!is_writable('./temp/')) {
            chmod('./temp/', 0777);
        }

        $filename = "temp/preview_" . $this->generateRandomString(20) . ".html";
        $previewFile = fopen($filename, "w");

        $title = '<title>' . $siteDetails['site']->sites_name . '</title>';
        $pageContent = str_replace('<!--pageTitle-->', $title, $_POST['page']);

        $base_url = base_url('studentelements');

        if (stristr($pageContent, 'href="css')) {
            $pageContent = str_replace('href="css', 'href="' . $base_url . '/css', $pageContent);
        }
        if (stristr($pageContent, 'href="scripts')) {
            $pageContent = str_replace('href="scripts', 'href="' . $base_url . '/scripts', $pageContent);
        }
        if (stristr($pageContent, 'href="images')) {
            $pageContent = str_replace('href="images', 'href="' . $base_url . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="scripts')) {
            $pageContent = str_replace('src="scripts', 'src="' . $base_url . '/scripts', $pageContent);
        }
        if (stristr($pageContent, 'url(images')) {
            $pageContent = str_replace('url(images', 'url(' . $base_url . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="./images')) {
            $pageContent = str_replace('src="./images', 'src="' . $base_url . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="images')) {
            $pageContent = str_replace('src="images', 'src="' . $base_url . '/images', $pageContent);
        }
        if (stristr($pageContent, 'href="./images')) {
            $pageContent = str_replace('href="./images', 'href="' . $base_url . '/images', $pageContent);
        }

        fwrite($previewFile, stripcslashes($pageContent));

        fclose($previewFile);
        header('Location: ' . base_url($filename));
    }

    // Get pre build templates using ajax request
    public function getPrebuildTemplates()
    {
        if (isset($_POST) && !empty($_POST) && count($_POST) > 0) {
            $posts = json_decode(stripslashes($_POST['posts']));
            if (count($posts) > 0) {
                foreach ($posts as $a) {
                    echo file_get_contents($_POST['url'] . $a->url);
                }
            }
        }
    }

    public function getTempElements()
    {
        if (isset($_POST) && !empty($_POST) && count($_POST) > 0) {
            $posts = json_decode(stripslashes($_POST['posts']));
            if (count($posts) > 0) {
                $template = '<div class="">';
                foreach ($posts as $a) {
                    $template .= $this->templatemodel->getSingleElement($a->id) . "\r\n";
                }
                $template .='</div>';
                $DOM = new DOMDocument();
                libxml_use_internal_errors(TRUE);
                $DOM->loadHTML($template, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                libxml_use_internal_errors(FALSE);
                echo $DOM->saveHTML();
                unset($DOM);
            }
        }
    }

    public function preview_profile($id)
    {
        $site_id = $this->encrypt->decode($id);
        $siteDetails = $this->sitemodel->getSite($site_id);
        $remote_url = '';

        if ($siteDetails == false) {
            die("No details found");
        }

        if ($siteDetails['site']->url_option == 'freeUrl') {
            $remote_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $siteDetails['site']->domain;
        } else {
            $remote_url = 'http://' . $siteDetails['site']->domain;
        }

        $pageContent = '';
        if (!empty($siteDetails['pages']['index'])) {
            foreach ($siteDetails['pages']['index'] as $value) {
                $pageContent .=$value->frames_content . "\r\n";
            }
        }
        $pageMeta = $this->pagemodel->getSinglePage($site_id, 'index');
        $base_url = base_url('elements');

        if ($this->ion_auth->in_group('business')) {
            $profile = 'business';
        } elseif ($this->ion_auth->in_group('students')) {
            $profile = 'student';
            $base_url = base_url('studentelements');
        } else {
            $profile = 'ecommerce';
        }
        $this->data['base_url'] = $base_url;
        $this->data['pageTitle'] = $siteDetails['site']->sites_name;

        if (stristr($pageContent, 'href="css')) {
            $pageContent = str_replace('href="css', 'href="' . $base_url . '/css', $pageContent);
        }
        if (stristr($pageContent, 'href="scripts')) {
            $pageContent = str_replace('href="scripts', 'href="' . $base_url . '/scripts', $pageContent);
        }
        if (stristr($pageContent, 'href="images')) {
            $pageContent = str_replace('href="images', 'href="' . $base_url . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="scripts')) {
            $pageContent = str_replace('src="scripts', 'src="' . $base_url . '/scripts', $pageContent);
        }
        if (stristr($pageContent, 'url(images')) {
            $pageContent = str_replace('url(images', 'url(' . $base_url . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="./images')) {
            $pageContent = str_replace('src="./images', 'src="' . $base_url . '/images', $pageContent);
        }
        if (stristr($pageContent, 'src="images')) {
            $pageContent = str_replace('src="images', 'src="' . $base_url . '/images', $pageContent);
        }
        if (stristr($pageContent, 'href="./images')) {
            $pageContent = str_replace('href="./images', 'href="' . $base_url . '/images', $pageContent);
        }
        /*
          $this->data['site_url'] = '<div id="site-url" data-content="' . $base_url . '"></div>';
          $this->data['contact_url'] = '<div id="contact-url" data-content="' . site_url('login/site_contact/' . $this->encrypt->encode($site_id)) . '"></div>';
          $this->data['counter_url'] = '<div id="counter-url" data-content="' . site_url('login/visitor_counter/' . $this->encrypt->encode($site_id)) . '"></div>';
          $this->data['page_id'] = '<div id="page-id" data-content="' . $pageMeta->pages_id . '"></div>';
          $this->data['page_url'] = '<div id="page-url" data-content="' . $remote_url . '/index.php"></div>';
          $this->data['siteurl'] = '<input type="hidden" class="siteurl" name="siteurl" value="' . site_url() . '">';
          $this->data['siteId'] = '<input type="hidden" class="siteId" name="siteId" value="' . base64_encode($site_id) . '">'; */
        $this->data['pageContent'] = $pageContent;

        if ($profile == 'student') {
            $this->template->load('template_preview_student', 'sites', 'sites/preview_resume', $this->data);
        } else {
            $this->template->load('template_preview_business', 'sites', 'sites/preview_resume', $this->data);
        }
//        $this->template->load('resume_preview', 'sites', 'sites/preview_resume', $this->data);
    }

    public function resumeSearchSettings()
    {
        if (!$this->ion_auth->in_group('students')) {
            redirect('/services');
        }
        $userID = userdata('user_id');
        $siteID = $this->sitemodel->getSiteId($userID);

        if (!$siteID) {
            redirect(site_url('sites/create'), 'location');
        }

        $siteData = $this->sitemodel->getSite($siteID);

        if ($siteData == false) {

            //site could not be loaded, redirect to /sites, with error message

            $this->session->set_flashdata('error', $this->lang->line('sites_site_error1'));

            redirect('/sites/', 'refresh');
        } else {

            $this->data['siteData'] = $siteData['site'];

            //get page data
            $pagesData = $this->pagemodel->getPageData($siteID);

            if ($pagesData) {

                $this->data['pagesData'] = $pagesData;
            }

            // Get the resume Setting Data 
            $page_id = 0;
            if (isset($pagesData['index'])) {
                $page_id = $pagesData['index']->pages_id;
            }
            $resumeData = $this->sitemodel->getResumeData($siteID, $userID, $page_id);

            if ($resumeData) {
                $this->data['resumeData'] = $resumeData;
            } else {
                $this->data['resumeData'] = array();
            }

            $this->data['css'] = array(
                '<style> #saveSkills, #saveLanguages, #addEducation {
    height: 33px;
    width: 100%;
}
 #nextSkills, #endSettings, #nextEducation, #saveBasicDetails {
    margin: 0;
    width: 140px;
}
 .title {
    border-bottom: 2px solid #e5e5e5;
    border-top: 2px solid #e5e5e5;
    margin-top: 10px;
    text-align: center;
}
 .col-sm-12, .col-sm-12.inputpanel {
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 0;
}
 .control-label, .title {
    padding-bottom: 0;
    padding-left: 0;
    padding-right: 0;
    padding-top: 0 !important;
}
.tab-content {
    ackground-color: #fff;
    padding: 35px 25px;
    padding-bottom: 0 !important;
    padding-top: 25px !important;
    margin: 0;
    background-color: #fff;
    border: 2px solid #ddd;
    border-radius: 6px;
    position: relative;
    z-index: 1;
}

.modal-footer-btn {
    background-color: white;
    border-top: 1px solid #e5e5e5;
    margin-top: 10px;
    padding: 10px 0;
}
.optionPane {
    padding: 20px;
}
.optionPane {
    background: #eee none repeat scroll 0 0;
    border: 2px dashed #ddd;
    margin-bottom: 15px;
}</style>'
            );

            $this->template->load('main', 'sites', 'partials/searchsettings', $this->data);
        }
    }

    /*
     * Insert block contet which is get updated
     * 
     */

    public function insert_block_content()
    {
        $userID = userdata('user_id');
        if (isset($_POST['site_id']) && $_POST['content'] != '') {
            if ($this->sitemodel->inserblockcontent($userID, $_POST['site_id'], $_POST['content'])) {
                $block_data = $this->sitemodel->get_block_content($_POST['site_id'], $userID);
                $return = array();
                $return['responseCode'] = 1;
                $return['responseHTML'] = $this->load->view('partials/loadcontent', array('block_content' => $block_data), true);
                die(json_encode($return));
            } else {
                return FALSE;
            }
        }
    }

    public function delete_block_content()
    {
        $userID = userdata('user_id');
        if (isset($_POST['content_id'])) {
            if ($this->sitemodel->deleteblockcontent($_POST['content_id'])) {
                $block_data = $this->sitemodel->get_block_content($_POST['site_id'], $userID);
                $return = array();
                $return['responseCode'] = 1;
                $return['responseHTML'] = $this->load->view('partials/loadcontent', array('block_content' => $block_data), true);
                die(json_encode($return));
            } else {
                return FALSE;
            }
        }
    }

    private function qr_code_generator($param)
    {
        $this->load->library('ci_qr_code');
        $this->config->load('qr_code');
        $qr_code_config = array();
        $qr_code_config['cacheable'] = $this->config->item('cacheable');
        $qr_code_config['cachedir'] = $this->config->item('cachedir');
        $qr_code_config['imagedir'] = $this->config->item('imagedir');
        $qr_code_config['errorlog'] = $this->config->item('errorlog');
        $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');
        $qr_code_config['quality'] = $this->config->item('quality');
        $qr_code_config['size'] = $this->config->item('size');
        $qr_code_config['black'] = $this->config->item('black');
        $qr_code_config['white'] = $this->config->item('white');

        $this->ci_qr_code->initialize($qr_code_config);

        $image_name = 'qr_code_test.png';

        $params['data'] = 'This QR Code was generated at ' . site_url() . $this->_method_url;
        $params['level'] = 'H';
        $params['size'] = 10;

        if ($this->input->post('display_format') == 'image') {
            $params['savename'] = BASEPATH . $qr_code_config['imagedir'] . $image_name;
            $this->ci_qr_code->generate($params);
            $this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;
            // Display the QR Code here on browser uncomment the below line
            //echo '<img src="'.base_url().$qr_code_config['imagedir'].$image_name.'" />'; 
            $this->load->view('qr_code', $this->data);
        } else {
            header("Content-Type: image/png");
            $this->ci_qr_code->generate($params);
        }
    }

}

/* End of file sites.php */
/* Location: ./application/controllers/sites.php */