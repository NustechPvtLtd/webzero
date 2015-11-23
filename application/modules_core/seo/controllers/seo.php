<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends MY_Controller {

    public $data = array();
    public $pages = array();
    
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('sites/sitemodel');
		$this->load->model('sites/pagemodel');
        
        $this->load->library('facebook');
        $this->load->library('twitteroauth');
        
        $this->data['title'] =  ucfirst($this->router->fetch_class());
		$this->data['pageTitle'] = ucfirst($this->router->fetch_class());
		
		if(!$this->ion_auth->logged_in()) {
			redirect('/login');
		}
			
	}
	

	public function index()
	{
        $this->data['pageHeading'] = ucfirst($this->router->fetch_class());
        $this->data['pageMetaDescription'] = ucfirst($this->router->fetch_class());
        $sites_id = $this->sitemodel->getSiteId($this->ion_auth->get_user_id());
        $this->data['message'] = '';
        if( !empty( $_POST )){
            $this->pagemodel->updatePageData( $_POST );
            $this->data['message'] = '<div class="alert alert-success">Page seo information successfuly updated.</br>Please re-publish your page to see the changes!</div>';
        }
        
        if(!$sites_id){
            redirect(site_url('sites/create'),'location');
        }  else {
            userdata('redirect_url', 'seo');
            $this->data['siteData'] = $this->sitemodel->getSite($sites_id);
            $this->data['pagesData'] = $this->pagemodel->getPageData($sites_id);

            $this->data['css'] = array(
                '<link href="'.base_url().'assets/sites/css/style.css" rel="stylesheet">',
                '<link href="'.base_url().'assets/home/css/style.css" rel="stylesheet">',
                '<style>header{padding:0;}</style>'
            );
            $this->data['js'] = array(
                '<script type="text/javascript" src="'.base_url().'assets/js/jquery.blockUI.js"></script>'
            );
            $this->template->load('main', 'seo', 'index', $this->data);
        }				
	}
	
}

/* End of file seo.php */