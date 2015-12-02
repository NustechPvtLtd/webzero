<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of amazon_services
 *
 * @author NUSTECH
 */
class Amazon_services extends MY_Controller{
    public $data = array();
    
	function __construct()
	{
		parent::__construct();
		$this->load->helper('directory');
		
		$this->load->model('sites/usermodel');
		$this->load->model('sites/media_storage_model');
        
		$this->load->library('s3');	
        
		$this->data['pageTitle'] = $this->lang->line('sites_page_title');
	
		if(!$this->ion_auth->logged_in()) {
			
			redirect('/login');
		
		}
		
	}
    
    public function index() {
	
//		var_dump($this->s3->listBuckets());
        $user_id = userdata('user_id');
        $type = 'video';
        $bucket = $this->media_storage_model->getBucketByType($user_id, $type);
        $uri = $this->media_storage_model->getUriByType($user_id, $type);
		$videos = $this->s3->getBucket($bucket->bucket_name,$uri->uri);
        
        $this->data['thumbnails'] = '';
        $this->data['videos'] = $videos;
        $this->data['bucket'] = 'mumbaistreet';
        $this->data['page'] = "Amazon Services";
		$this->data['pageHeading'] = "Get Bucket";
        $this->data['css'] = array(
		    '<link href="'.base_url().'assets/sites/less/flat-ui.css" rel="stylesheet">'
		);

        echo '<pre>';
        print_r(count($videos));
        print_r($videos);
        echo '</pre>';
//        $this->template->load('sites', 'sites', 'amazon/index', $this->data);
	}
    
    public function videoUploadAjax(){
        $return = array();
        $user_id = userdata('user_id');
        $type = 'video';
        $bucket = $this->media_storage_model->getBucketByType($user_id, $type);
        if(!$bucket){
            $bucket = 'mumbaistreet';
        } else {
            $bucket = $bucket->bucket_name;
        }
        $uri = $this->media_storage_model->getUriByType($user_id, $type);
        if($uri){
            $uri = $uri->uri;
        } else {
            $uri = $this->_genrate_unique_name().'/Videos';
        }
        if(!empty($_FILES['videoFile'])){
            $name = $_FILES['videoFile']['name'];
            $size = $_FILES['videoFile']['size'];
            $tmp = $_FILES['videoFile']['tmp_name'];
            $ext = $this->_getExtension($name);
            $actual_video_name = 'video'.date('DdmY').mt_rand(100000, 999999).".".$ext;
            $response = $this->s3->putObjectFile($tmp, $bucket , $uri.'/'.$actual_video_name, S3::ACL_PUBLIC_READ);
            if($response){
                $temp = array();
                $temp['header'] = $this->lang->line('assets_videoUploadAjax_success_heading');
                $temp['content'] = $this->lang->line('assets_videoUploadAjax_success_message');

                //include the partils "myvideos" with all the uploaded videos
                $userVideos = $this->s3->getBucket($bucket, $uri);

                if( $userVideos ) {
                    $return['myVideos'] = $this->load->view("partials/myvideos", array('userVideos' => $userVideos, 'bucket'=>$bucket), true);
                }

                $return['responseCode'] = 1;
                $return['responseHTML'] = $this->load->view('partials/success', array('data'=>$temp), true);

                die( json_encode( $return ) );
            } else {
                $temp = array();
                $temp['header'] = $this->lang->line('assets_videoUploadAjax_error1_heading');
                $temp['content'] = $this->lang->line('assets_videoUploadAjax_error1_message');

                $return['responseCode'] = 0;
                $return['responseHTML'] = $this->load->view('partials/error', array('data'=>$temp), true);

                die( json_encode( $return ) );
            }
        } else {
            $temp = array();
            $temp['header'] = $this->lang->line('assets_videoUploadAjax_error1_heading');
            $temp['content'] = $this->lang->line('assets_videoUploadAjax_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data'=>$temp), true);

            die( json_encode( $return ) );
        }
    }
    
    private function _getExtension($str)
    {
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
    
    private function _genrate_unique_name()
    {
        return strtoupper(substr(hash('sha256', mt_rand() . microtime()), 0, 10));
    }
}
