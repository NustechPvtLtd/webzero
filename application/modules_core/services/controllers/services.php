<?php  (defined('BASEPATH')) OR exit('No direct script access allowed');
class Services extends MY_Controller {
    
    function __construct()
    {
        parent::__construct();

        $group = $this->ion_auth->get_groups(array('neglectgroup'=>array('admin')));
        if (!$this->ion_auth->in_group($group)){
            $this->session->set_flashdata('message', 'You must be a Company Admin OR a End User to view this page');
            redirect('/');
        }
    }
    
    function index()
    {
        $data['title'] = 'Home';
        $data['pageMetaDescription'] = 'webzero.in';
        $data['pageHeading'] = 'Services';
        $group = $this->ion_auth->get_groups(array('neglectgroup'=>array('admin','nogroup','business'),'visibility'=>TRUE));
        $data['group'] = $group;
        $user_id = userdata('user_id');
        if(isset($_POST['group']) && $this->ion_auth->update_user_group($user_id, $_POST['group'])){
            $this->session->set_flashdata('message', 'Your user group is update to '.$data['group'][$_POST['group']]);
            redirect('/');
        }
        $data['css'] = array(
            '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/customer/css/style.css"/>'
        );
        if($this->ion_auth->in_group(array('employer'))){
            $this->template->load('main', 'services', 'services/recruiter', $data);
        }  else {
            $this->template->load('main', 'services', 'services/index', $data);
        }
    }
}