<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sitemodel extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('file');
    }

    /*

      returns all available sites

     */

    public function all($forUserID = '')
    {

        //if $forUserID is set, this means we're looking for the sites belonging to a specific user

        if ($forUserID == '') {

            $user = $this->ion_auth->user()->row();
            $userID = $user->id;

            if (!$this->ion_auth->is_admin()) {
                $this->db->where('users_id', $userID);
            }
        } else {

            $this->db->where('users_id', $forUserID);
        }

        $this->db->from('sites');
        $this->db->where('sites_trashed', 0);
        $this->db->join('users', 'sites.users_id = users.id');

        $query = $this->db->get();

        $res = $query->result();

        $allSites = []; //array holding all sites and associated data

        foreach ($res as $site) {

            $temp = [];

            $temp['siteData'] = $site;

            //get the number of pages
            $this->db->from('pages');
            $this->db->where('sites_id', $site->sites_id);
            $this->db->where('pages_trashed', 0);
            $query = $this->db->get();

            $res = $query->result();

            $temp['nrOfPages'] = $query->num_rows();

            $this->db->flush_cache();

            //grab the first frame for each site, if any

            $q = $this->db->from('pages')->where('pages_name', 'index')->where('sites_id', $site->sites_id)->where('pages_trashed', 0)->get();

            if ($q->num_rows() > 0) {

                $res = $q->result();

                $indexPage = $res[0];

                $q = $this->db->from('frames')->where('pages_id', $indexPage->pages_id)->order_by('frames_id', 'asc')->limit(1)->get();

                if ($q->num_rows() > 0) {

                    $res = $q->result();

                    $temp['lastFrame'] = $res[0];
                } else {

                    $temp['lastFrame'] = '';
                }
            } else {

                $temp['lastFrame'] = '';
            }


            $allSites[] = $temp;
        }

        return $allSites;
    }

    /*


      checks to see if a site belongs to this user

     */

    public function isMine($siteID)
    {

        $user = $this->ion_auth->user()->row();

        $userID = $user->id;


        $q = $this->db->from('sites')->where('sites_id', $siteID)->get();

        if ($q->num_rows() > 0) {

            $res = $q->result();

            if ($res[0]->users_id != $userID) {

                return false;
            } else {

                return true;
            }
        } else {

            return false;
        }
    }

    /*

      creates a new, empty shell site

     */

    public function createNew()
    {

        $user = $this->ion_auth->user()->row();

        $userID = $user->id;

        //create site
        $data = [
            'sites_name' => 'My New Site',
            'users_id' => $userID,
            'sites_created_on' => time()
        ];

        $this->db->insert('sites', $data);

        $newSiteID = $this->db->insert_id();

        $Pagedata = [
            'sites_id' => $newSiteID,
            'pages_name' => 'index',
            'pages_timestamp' => time()
        ];
        //create empty index page
        $this->db->insert('pages', $Pagedata);

        return $newSiteID;
    }

    /*

      creates a new site item, including pages and frames

     */

    public function create($siteName, $siteData)
    {

        $user = $this->ion_auth->user()->row();

        $userID = $user->id;

        //create the site item first

        $data = [
            'users_id' => $userID,
            'sites_name' => $siteName,
            'sites_created_on' => time()
        ];

        $this->db->insert('sites', $data);

        $siteID = $this->db->insert_id();

        //die( "ID: ".$this->db->insert_id() );
        //next we create the pages and frames
        $this->createPages($siteID, $siteData);
        return $siteID;
    }

    public function update_pdf($siteID, $pdf_path)
    {
        $data = [
            'pdf_path' => $pdf_path
        ];

        $this->db->where('sites_id', $siteID);
        $this->db->update('sites', $data);
    }

    /*

      updates an existing site item, including pages and frames

     */

    public function update($siteID, $siteData, $pagesData = '')
    {

        //update the site details first

        $data = [
            'sites_lastupdate_on' => time()
        ];

        $this->db->where('sites_id', $siteID);
        $this->db->update('sites', $data);

        //delete all pages and frames and re-save

        $query = $this->db->from('pages')->where('sites_id', $siteID)->get();

        $pages = $query->result();
        if (!empty($pages)) {
            $this->updatePages($siteID, $pages, $siteData, $pagesData);
        } else {
            $this->createPages($siteID, $siteData);
        }
    }

    /*

      takes a site ID and returns all the site data, or false is the site doesn't exist

     */

    public function getSite($siteID)
    {
        $query_string = "SELECT * FROM sites
LEFT JOIN users_domains ON sites.sites_id = users_domains.site_id
WHERE sites.sites_id = {$siteID} AND (users_domains.active=1 OR ISNULL(users_domains.active));";
//        $this->db->from('sites');
//        $this->db->where('sites_id', $siteID);
//        $this->db->or_where('users_domains.active', 1);
//        $this->db->join('users_domains', 'sites.sites_id = users_domains.site_id');
        $query = $this->db->query($query_string);

        if ($query->num_rows() == 0) {

            return false;
        }

        $res = $query->result();

        $site = $res[0];

        $siteArray = [];
        $siteArray['site'] = $site;

        //get the pages + frames

        $query = $this->db->from('pages')->where('sites_id', $site->sites_id)->where('pages_trashed', 0)->get();

        $res = $query->result();


        $pageFrames = [];

        foreach ($res as $page) {

            //get the frames for each page

            $query = $this->db->from('frames')->where('pages_id', $page->pages_id)->get();

            $pageFrames[$page->pages_name] = $query->result();
        }

        $siteArray['pages'] = $pageFrames;
        /*

          //grab the assets folders as well
          $this->load->helper('directory');

          $folderContent = directory_map($this->config->item('elements_dir'), 2);

          $assetFolders = [];

          foreach ($folderContent as $key => $item) {

          if (is_array($item)) {

          array_push($assetFolders, $key);
          }
          }


          $siteArray['assetFolders'] = $assetFolders;
         */
        return $siteArray;
    }

    public function getSiteData($siteID)
    {

        $this->db->from('sites');
        $this->db->where('sites_id', $siteID);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {

            return false;
        }

        $res = $query->result();

        $site = $res[0];

        $siteArray = [];
        $siteArray['site'] = $site;

        $query1 = $this->db->from('users_domains')->where('site_id', $siteID)->get();
        $res1 = $query1->result();
        $domains = [];
        foreach ($res1 as $value) {
            $domains[$value->url_option]['domain'] = $value->domain;
            $domains[$value->url_option]['domain_publish'] = $value->domain_publish;
            $domains[$value->url_option]['active'] = $value->active;
        }
        $siteArray['domains'] = $domains;

        return $siteArray;
    }

    public function getSiteId($user_id)
    {
        $this->db->select('sites_id');
        $this->db->from('sites');
        $this->db->where('sites_trashed', 0);
        $this->db->where('users_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {

            return false;
        }

        $res = $query->result();

        $site = $res[0];
        return $site->sites_id;
    }

    /*

      grabs a single frame and returns it

     */

    public function getSingleFrame($frameID)
    {

        $query = $this->db->from('frames')->where('frames_id', $frameID)->get();
        if ($query->num_rows() == 0) {
            return false;
        }
        $res = $query->result();

        return $res[0];
    }

    /*

      gets the assets and pages of a site

     */

    public function getAssetsAndPages($siteID)
    {

        //get the asset folders first, we only grab the first level folders inside $this->config->item('elements_dir')

        $this->load->helper('directory');

        $folderContent = directory_map($this->config->item('elements_dir'), 2);

        $assetFolders = [];

        foreach ($folderContent as $key => $item) {

            if (is_array($item)) {

                array_push($assetFolders, $key);
            }
        }



        //now we get the pages

        $query = $this->db->from('pages')->where('sites_id', $siteID)->get();

        $pages = $query->result();

        $return = [];

        $return['assetFolders'] = $assetFolders;
        $return['pages'] = $pages;

        return $return;
    }

    /*

      moves a site to the trash

     */

    public function trash($siteID)
    {

        $data = [
            'sites_trashed' => 1
        ];

        $this->db->where('sites_id', $siteID);
        if ($this->db->update('sites', $data)) {
            $this->db->where('sites_id', $siteID);
            $this->db->update('pages', ['pages_trashed' => 1]);
        }
    }

    /*

      publish a site

     */

    public function publish($siteID, $remote_url)
    {

        $data = [
            'published' => 1
        ];

        $this->db->where('sites_id', $siteID);
        $this->db->update('sites', $data);
    }

    /*

      returns all admin images

     */

    public function adminImages()
    {
        if ($this->ion_auth->in_group('students')) {
            $folderContent = directory_map('studentelements/images', 2);
        } else {
            $folderContent = directory_map('elements/images', 2);
        }

        if ($folderContent) {

            //print_r( $folderContent );

            $adminImages = [];

            foreach ($folderContent as $key => $item) {

                if (!is_array($item)) {

                    //check the file extension

                    $tmp = explode(".", $item);


                    //prep allowed extensions array

                    $temp = explode("|", $this->config->item('images_allowedExtensions'));


                    if (in_array(strtolower($tmp[1]), $temp)) {

                        array_push($adminImages, $item);
                    }
                }
            }

            return $adminImages;
        } else {

            return false;
        }
    }

    private function createPages($siteID, $siteData)
    {
        foreach ($siteData as $pageName => $frames) {

            $data = [
                'sites_id' => $siteID,
                'pages_name' => $pageName,
                'pages_timestamp' => time()
            ];

            $this->db->insert('pages', $data);

            $pageID = $this->db->insert_id();

            //page is done, now all the frames for this page

            foreach ($frames as $frameData) {

                $frameContent = $frameData['frameContent'];
                if (stristr($frameContent, '<link href="' . base_url('elements'))) {
                    $frameContent = str_replace('<link href="' . base_url('elements') . '/', '<link href="', $frameContent);
                }
                if (stristr($frameContent, '<script src="' . base_url('elements'))) {
                    $frameContent = str_replace('<script src="' . base_url('elements') . '/', '<script src="', $frameContent);
                }
                if (stristr($frameContent, 'src="' . base_url('elements') . '/images')) {
                    $frameContent = str_replace('src="' . base_url('elements') . '/images', 'src="images', $frameContent);
                }
                $data = [
                    'pages_id' => $pageID,
                    'sites_id' => $siteID,
                    'frames_content' => $frameContent,
                    'frames_height' => $frameData['frameHeight'],
                    'frames_original_url' => $frameData['originalUrl'],
                    'frames_timestamp' => time()
                ];

                $this->db->insert('frames', $data);
            }
        }
    }

    private function updatePages($siteID, $pages, $siteData, $pagesData)
    {
        foreach ($pages as $page) {
            //delete all frames 
            $this->db->where('pages_id', $page->pages_id);
            $this->db->delete('frames');
            $pagesData[$page->pages_name]['pages_id'] = $page->pages_id;
        }

        //all gone, re-save

        foreach ($siteData as $pageName => $frames) {

            $data = [
                'sites_id' => $siteID,
                'pages_name' => $pageName,
                'pages_timestamp' => time()
            ];

            if (isset($pagesData[$pageName]['pages_title'])) {

                $data['pages_title'] = $pagesData[$pageName]['pages_title'];
                $data['pages_meta_keywords'] = $pagesData[$pageName]['pages_meta_keywords'];
                $data['pages_meta_description'] = $pagesData[$pageName]['pages_meta_description'];
                $data['pages_header_includes'] = $pagesData[$pageName]['pages_header_includes'];
            }

            if (empty($pagesData[$pageName]['pages_id'])) {
                $this->db->insert('pages', $data);
                $pageID = $this->db->insert_id();
                $pagesData[$pageName]['pages_id'] = $pageID;
            } else {
                $this->db->where('pages_id', $pagesData[$pageName]['pages_id']);
                $this->db->update('pages', $data);
            }

            //page is done, now all the frames for this page

            if (is_array($frames)) {

                foreach ($frames as $frameData) {
                    $frameContent = $frameData['frameContent'];
                    if (stristr($frameContent, '<link href="' . base_url('elements'))) {
                        $frameContent = str_replace('<link href="' . base_url('elements') . '/', '<link href="', $frameContent);
                    }
                    if (stristr($frameContent, '<script src="' . base_url('elements'))) {
                        $frameContent = str_replace('<script src="' . base_url('elements') . '/', '<script src="', $frameContent);
                    }
                    if (stristr($frameContent, 'src="' . base_url('elements') . '/images')) {
                        $frameContent = str_replace('src="' . base_url('elements') . '/images', 'src="/elements/images', $frameContent);
                    }
                    $data = [
                        'pages_id' => $pagesData[$pageName]['pages_id'],
                        'sites_id' => $siteID,
                        'frames_content' => $frameContent,
                        'frames_height' => $frameData['frameHeight'],
                        'frames_original_url' => $frameData['originalUrl'],
                        'frames_timestamp' => time()
                    ];

                    $this->db->insert('frames', $data);
                }
            }
        }
    }

    /*
      trashes a users' sites
     */

    public function deleteAllFor($userID)
    {

        $data = [
            'sites_trashed' => 1
        ];

        $this->db->where('users_id', $userID);
        $this->db->update('sites', $data);
    }

    public function checkDomainAvailability($domain)
    {
        $query = $this->db->from('users_domains')->where('domain', $domain)->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete_pages($site_id, $page_name)
    {
        $this->db->where('sites_id', $site_id);
        $this->db->where('pages_name', $page_name);
        if ($this->db->update('pages', ['pages_trashed' => 1])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //function to create users products......shubhangee

    public function createuserproducts($site_id, $productid, $pname, $pprice, $pdescription, $img1)
    {
        $uid = $this->ion_auth->get_user_id();

        $fullui = "";
        if (strpos($img1, "/images/") == true) {
            $fullui = $img1;
        } else {
            $url = site_url();
            $newsite = explode('index.php', $url);

            $fullui = $newsite[0] . "elements/" . $img1;
        }

        $query = $this->db->query("select * from users_products where product_id='" . $productid . "' ") or die(mysql_error());
        $res = $query->result();
        if (!empty($res)) {
            $query = $this->db->query("update users_products set name='" . $pname . "',description='" . $pdescription . "',price='" . $pprice . "',site_id='" . $site_id . "',image1='" . $fullui . "' where product_id='" . $productid . "' ");
        } else {
            $query = $this->db->query("insert into users_products(user_id,product_id,name,description,price,site_id,image1)values('" . $uid . "','" . $productid . "','" . $pname . "','" . $pdescription . "','" . $pprice . "','" . $site_id . "','" . $fullui . "')");
        }
    }

    /*
      get site settings for resume

     */

    public function getResumeData($_site_id, $_user_id, $_page_id)
    {
        // Resume basic details.
        $this->db->from('jobseeker_profile');
        $this->db->where(array('site_id' => $_site_id, 'user_id' => $_user_id, 'page_id' => $_page_id));
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }
        $res = $query->result();
        $resume['basic'] = $res[0];

        // Resume Education For User
        $this->db->from('jobseeker_education');
        $this->db->where(array('site_id' => $_site_id, 'user_id' => $_user_id, 'page_id' => $_page_id));
        $query = $this->db->get();
        $res = $query->result();
        $resume['education'] = $res;

        // Resume skills for user
        $this->db->from('jobseeker_prof_skills');
        $this->db->where(array('site_id' => $_site_id, 'user_id' => $_user_id, 'page_id' => $_page_id));
        $query = $this->db->get();
        $res = $query->result();
        $resume['skills'] = $res;

        // Resume languages for user 
        $this->db->from('jobseeker_lang_skills');
        $this->db->where(array('site_id' => $_site_id, 'user_id' => $_user_id, 'page_id' => $_page_id));
        $query = $this->db->get();
        $res = $query->result();
        $resume['lang'] = $res;

        return $resume;
    }

    /*
      Get User details by user id
     */

    public function getUserDetailsUserId($user_id)
    {
        $this->db->select('username,email,first_name,last_name,phone');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {

            return false;
        }

        $res = $query->result();

        $site = $res[0];
        return $site;
    }

    /*

      updates site password

     */

    public function updateSitePassword($pageData)
    {

        //do we have a siteID?

        if ($pageData['siteID'] != '') {
            $status = ((isset($pageData['my-checkbox']) && $pageData['my-checkbox'] == '1') ? $pageData['my-checkbox'] : '0');
            $data = array();
            $data['has_password'] = $status;
            if (isset($pageData['pagePassword'])) {
                $data['site_password'] = $pageData['pagePassword'];
            }

            $this->db->where('sites_id', $pageData['siteID']);
            $this->db->update('sites', $data);
        }
    }

    /*
      get site user password.
     */

    public function getUserPasswordById($site_id, $password)
    {
        $this->db->select('*');
        $this->db->from('sites');
        $this->db->where(array('sites_id' => $site_id, 'site_password' => $password, 'sites_trashed' => 0));
        $query = $this->db->get();
        if ($query->num_rows() == 0) {

            return false;
        }

        $res = $query->result();

        $site = (array) $res[0];
        return array_slice($site, 0, 8);
    }

    /*

      updates an existing site item, including pages and frames

     */

    /*
      Check profile available in database
     */

    public function checkProfile($_user_id, $_site_id, $_page_id)
    {

        $query = $this->db->from('jobseeker_profile')->where(array('site_id' => $_site_id, 'page_id' => $_page_id, 'user_id' => $_user_id))->get();

        $datares = $query->result();
        if (!empty($datares) && is_object($datares[0])) {
            return 1;
        } else {
            return 0;
        }
    }

    /*
      Delete the Education Details
     */

    public function deleteEducation($_edu_id)
    {
        $where_cls = array('id' => $_edu_id);
        $this->db->where($where_cls);
        $this->db->delete('jobseeker_education');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /*
      Delete the old skills
     */

    public function deleteSkills($_skill_id)
    {
        $where_cls = array('id' => $_skill_id);
        $this->db->where($where_cls);
        $this->db->delete('jobseeker_prof_skills');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /*
      Delete the old languages
     */

    public function deleteLanguages($_lang_id)
    {
        $where_cls = array('id' => $_lang_id);
        $this->db->where($where_cls);
        $this->db->delete('jobseeker_lang_skills');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /*
      Insert batch Skills into the database
     */

    public function insertSkills($insSkill)
    {
        $this->db->insert('jobseeker_prof_skills', $insSkill);
        $basicData = $this->db->insert_id();
        if ($basicData != 0) {
            return $basicData;
        } else {
            return 0;
        }
    }

    /*
      Insert batch Languagse into the database
     */

    public function insertLang($insLang)
    {
        $this->db->insert('jobseeker_lang_skills', $insLang);
        $basicData = $this->db->insert_id();
        if ($basicData != 0) {
            return $basicData;
        } else {
            return 0;
        }
    }

    /*
      Update the profile details.
     */

    public function updateBasicDetails($_user_id, $_site_id, $_page_id, $data)
    {

        $data['last_updated'] = time();
        $where_cls = array('site_id' => $_site_id, 'page_id' => $_page_id, 'user_id' => $_user_id);
        $this->db->where($where_cls);
        $this->db->update('jobseeker_profile', $data);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /*
      Insert the Education Details for the Student.
     */

    public function createEducationDetails($data)
    {
        $this->db->insert('jobseeker_education', $data);
        $basicData = $this->db->insert_id();
        if ($basicData != 0) {
            return $basicData;
        } else {
            return 0;
        }
    }

    /*
      Create the basic deails profile for the new student
     */

    public function createBasicDetails($data)
    {
        $this->db->insert('jobseeker_profile', $data);
        $basicData = $this->db->insert_id();
        if ($basicData != 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /*
      User name by user id
     */

    public function getUserByUserId($user_id)
    {
        $this->db->select('username,email,first_name,last_name,phone');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {

            return false;
        }

        $res = $query->result();

        $site = $res[0];
        $userName = (empty($site->first_name)) ? $site->email : ucfirst($site->first_name) . ' ' . ucfirst($site->last_name);
        return $userName;
    }

    /*
      Send mail for sharing your profile
     */

    public function shareProfileEmail($ids = "", $cnt = "", $sub = "")
    {
        $allids = isset($ids) ? $ids : $_POST['allids'];
        $emailcnt = isset($cnt) ? $cnt : $_POST['emailcnt'];
        $emailsub = isset($sub) ? $sub : $_POST['emailsub'];

        $pids = explode(',', $allids);
        $sender_email = userdata('email');
        $username = $this->getUserByUserId(userdata('user_id'));
        $allemail = array();
        foreach ($pids as $pid) {
            array_push($allemail, $pid);
        }
        if (!empty($allemail)) {
            $newarr = array_unique($allemail);

            $subject = $emailsub;

            $mail_body = $emailcnt;

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= "From: {$username}<{$sender_email}>\r\n";
            $headers .= "Reply-To: {$sender_email}\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $headers .= "X-Priority: 1" . "\r\n";

            $sendResult = array();
            foreach ($newarr as $res) {
                $temp = array();
                $to = $res;
                $send = mail($to, $subject, $mail_body, $headers, "-f " . $sender_email);
                //$receiver_id=$this->getidusingemail($to);
                if ($send) {
                    //$this->db->query("insert into jobseeker_email(sender_id,receiver_id,email_contents,email_subject)values('".$sender_id."','".$receiver_id."',".$this->db->escape($mail_body).",".$this->db->escape($emailsub).")");
                    $temp['status'] = "True";
                    $temp['address'] = $to;
                } else {
                    $temp['status'] = "False";
                    $temp['address'] = $to;
                }
                $sendResult[] = $temp;
            }
            return json_encode($sendResult);
        }
    }

    public function inserblockcontent($_user_id, $_site_id, $content)
    {
        $data = array(
            'site_id' => $_site_id,
            'user_id' => $_user_id,
            'content' => $content
        );
        $inserted = $this->db->insert('site_content', $data);
        return $inserted;
    }

    public function get_block_content($_site_id, $_user_id)
    {
        $this->db->where('site_id', $_site_id);
        $this->db->where('user_id', $_user_id);
        $this->db->order_by("timestamp", "desc");
        $query = $this->db->get('site_content');
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function deleteblockcontent($content_id)
    {
        $this->db->where('content_id', $content_id);
        $this->db->delete('site_content');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

}
