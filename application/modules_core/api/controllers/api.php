<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
 
class Api extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('login/ion_auth_model');
    }
    
    function user_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
        
        $users = $this->ion_auth_model->user( $this->get('id') )->row();
        
        $user = array();
        if($users){
            foreach ($users as $key => $value) {
                $user[$key] = $value;
            }
        }
        
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
     
    function user_post()
    {
        $result = $this->user_model->update( $this->post('id'), array(
            'name' => $this->post('name'),
            'email' => $this->post('email')
        ));
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }
         
    }
     
    function users_get()
    {
        $users = $this->user_model->get_all();
         
        if($users)
        {
            $this->response($users, 200);
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
    
}
?>