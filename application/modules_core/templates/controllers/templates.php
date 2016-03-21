<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Templates extends MY_Controller {
    
    public $data = array();
    function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');        
        $this->load->model('template_model');       
        $this->data['title'] = ucfirst($this->router->fetch_class());
        $this->data['pageMetaDescription'] = $this->router->fetch_class().'|'.$this->router->fetch_method();
    }
   
    public function index()
    {
        if(!$this->ion_auth->is_admin()){
            redirect('/', 'location');
        }
        $this->data['pageHeading'] = 'Templates';
        $this->data['message'] = '';
        $this->data['css'] = array(
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.responsive.css" type="text/css" rel="stylesheet">',
            '<style>td.child{text-align:left !important}</style>'
        );
        $this->data['js'] = array(
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/jquery.dataTables.min.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.bootstrap.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.responsive.js"></script>'           
            
        );
        $this->data['templates'] = $this->template_model->get_templates();

        $this->template->load('main', 'templates', 'template_view', $this->data);
    }
    
    public function change_visibility(){
        $template_id= $this->uri->segment(3);
        $visibility= $this->uri->segment(4);      
       
        $res=$this->template_model->update_visibility($template_id,$visibility);        
        redirect(site_url('/templates'), 'refresh');
       
    }   
    public function preview($profile, $template_id)
    {
        $template_id = $this->encrypt->decode($template_id);
        $siteDetails = $this->template_model->getTemplate($template_id);        
        $remote_url = '';
        
        if ($siteDetails == false) {
            die("No details found");
        }
        $pageContent = '';
        if(!empty($siteDetails['elements'])){
           
            foreach ($siteDetails['elements'] as $value) {
                $pageContent .=$value. "\r\n";
            }
        }
        
        if($profile=='student'){
            $base_url = base_url('studentelements');
        }else{
            $base_url = base_url('elements');
        }
        
       $this->data['base_url'] = $base_url;

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

        $this->data['pageContent'] = $pageContent;
        if($profile=='student'){
            $this->template->load('template_preview_student', 'sites', 'sites/preview_resume', $this->data);
        }else{
            $this->template->load('template_preview_business', 'sites', 'sites/preview_resume', $this->data);
        }
    }
   
    
}