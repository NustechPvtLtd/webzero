<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
 
class Api extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('login/ion_auth_model');
        $this->load->model('sites/media_storage_model');
        $this->load->library('s3');	
    }
    
    function bucket_get(){
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
        
        $bucket = $this->media_storage_model->getBucket($this->get('id'));
        if(!$bucket){
            $bucket = 'mumbaistreet';
        } else {
            $bucket = $bucket->bucket_name;
        }
        
        if($bucket)
        {
            $this->response($bucket, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function uri_get(){
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
        if(!$this->get('type'))
        {
            $this->response(NULL, 400);
        }
        
        $uri = $this->media_storage_model->getUriByType($this->get('id'), $this->get('type'));
        if($uri){
            $uri = $uri->uri;
        } else {
            $uri = ($this->get('type')=='video')?$this->media_storage_model->genrate_unique_name().'/Videos':$this->media_storage_model->genrate_unique_name().'/Images';
        }
        
        if($uri)
        {
            $this->response($uri, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function media_post(){
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
        if(!$this->post('bucket'))
        {
            $this->response(NULL, 400);
        }
        if(!$this->post('uri'))
        {
            $this->response(NULL, 400);
        }
        if(!$this->post('name'))
        {
            $this->response(NULL, 400);
        }
        if(!$this->post('type'))
        {
            $this->response(NULL, 400);
        }
        $data = array(
                'bucket_name' => $this->post('bucket'),
                'uri' => $this->post('uri'),
                'media_name' => $this->post('name'),
                'type' => $this->post('type'),
                'user_id' => $this->get('id'),
            );
        if($this->media_storage_model->insertMedia($data)){
            $this->response('Success', 200); 
        }else{
            $this->response(NULL, 404);
        }
    }
    
    function media_get() {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
        if(!$this->get('type'))
        {
            $this->response(NULL, 400);
        }
        $user_id = $this->get('id');
        $type = $this->get('type');
        $bucket = $this->media_storage_model->getBucket($user_id, $type);
        if(!$bucket){
            $bucket = 'mumbaistreet';
        } else {
            $bucket = $bucket->bucket_name;
        }
        $uri = $this->media_storage_model->getUriByType($user_id, $type);
        if($uri){
            $uri = $uri->uri.'/'.ucfirst($type);
        } else {
            $this->response(NULL, 404);
        }
		$videos = $this->s3->getBucket($bucket,$uri);
        $return = array();
        if(empty($videos)){
            $this->response(NULL, 404);
        }  else {
            foreach ($videos as $value) {
                array_push($return, "http://".$bucket.".s3.amazonaws.com/".$value['name']);
            }
            $this->response(json_encode($return), 200);
        }
	}
}
