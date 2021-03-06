<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Getelements extends MY_Controller {

    public $data = array();
    
	function __construct()
	{
		parent::__construct();
			
		$this->data['pageTitle'] = $this->lang->line('sites_page_title');
	
		if(!$this->ion_auth->logged_in()) {
			
			redirect('/login');
		
		}
		
	}

	public function index()
	{
	
        if($this->ion_auth->in_group('business')){
            $string = file_get_contents("elements.json");
        }else{
            $string = file_get_contents("resumeelements.json");
        }
		
		echo $string;
		
	}
	
}

/* End of file getelements.php */
/* Location: ./application/controllers/getelements.php */