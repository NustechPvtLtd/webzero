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
        $bucket = $this->media_storage_model->getBucket($user_id, $type);
        $uri = $this->media_storage_model->getUri($user_id, $type);
		$videos = $this->s3->getBucket($bucket->bucket_name,$uri.'/'.$type);
        $return = array();
        $this->data['thumbnails'] = '';
        $this->data['videos'] = $videos;
        $this->data['bucket'] = 'mumbaistreet';
        $this->data['page'] = "Amazon Services";
		$this->data['pageHeading'] = "Get Bucket";
        $this->data['css'] = array(
		    '<link href="'.base_url().'assets/sites/less/flat-ui.css" rel="stylesheet">'
		);
        foreach ($videos as $value) {
                array_push($return, "http://".$bucket->bucket_name.".s3.amazonaws.com/".$value['name']);
        }
//        echo '<pre>';
//        print_r($videos);
//        echo '</pre>';
        $this->template->load('sites', 'sites', 'amazon/index', $this->data);
	}
    
    public function videoUploadAjax(){
        $return = array();
        $user_id = userdata('user_id');
        $type = 'video';
        $bucket = $this->media_storage_model->getBucket($user_id);
        if(!$bucket){
            $bucket = 'mumbaistreet';
        } else {
            $bucket = $bucket->bucket_name;
        }
        $uri = $this->media_storage_model->getUri($user_id);
        if($uri){
            $uri = $uri->uri;
        } else {
            $uri = $this->media_storage_model->genrate_unique_name();
        }
        
        $config['allowed_types'] = $this->config->item('upload_allowed_types_video');
		$config['max_size']	= $this->config->item('upload_max_size');
		$config['max_width']  = $this->config->item('upload_max_width');
		$config['max_height']  = $this->config->item('upload_max_height');
        
        $this->load->library('upload', $config);

        if(!empty($_FILES['videoFile']) && $this->upload->validate_file('videoFile')){
            $name = $_FILES['videoFile']['name'];
            $tmp = $_FILES['videoFile']['tmp_name'];
            $ext = $this->_getExtension($name);
            $actual_video_name = 'video'.date('DdmY').mt_rand(100000, 999999).".".$ext;
            $response = $this->s3->putObjectFile($tmp, $bucket , $uri.'/Videos/'.$actual_video_name, S3::ACL_PUBLIC_READ);
            if($response){
                $temp = array();
                $temp['header'] = $this->lang->line('assets_videoUploadAjax_success_heading');
                $temp['content'] = $this->lang->line('assets_videoUploadAjax_success_message');

                $data = array(
                    'bucket_name' => $bucket,
                    'uri' => $uri,
                    'media_name' => $actual_video_name,
                    'type' => $type,
                    'user_id' => $user_id,
                );
                $this->media_storage_model->insertMedia($data);
                //include the partils "myvideos" with all the uploaded videos
                $userVideos = $this->s3->getBucket($bucket, $uri.'/Videos');

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
            $temp['content'] = $this->lang->line('assets_videoUploadAjax_error1_message').$this->upload->display_errors();

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data'=>$temp), true);

            die( json_encode( $return ) );
        }
    }
    
    public function videoDelete()
    {
        if(isset($_POST['bucket']) && isset($_POST['uri'])){
            $response = $this->s3->deleteObject($_POST['bucket'], $_POST['uri']);
            if($response){
                $user_id = userdata('user_id');
                $temp = array();
                $temp['header'] = $this->lang->line('assets_videoDelete_success_heading');
                $temp['content'] = $this->lang->line('assets_videoDelete_success_message');
                $exp_array = explode('/', $_POST['uri']);
                $media_name = end($exp_array);
                $uri = $exp_array[0].'/'.$exp_array[1];
                $this->media_storage_model->deleteMedia($media_name, $user_id);
                
                //include the partils "myvideos" with all the uploaded videos
                $userVideos = $this->s3->getBucket($_POST['bucket'], $uri);

                if( $userVideos ) {
                    $return['myVideos'] = $this->load->view("partials/myvideos", array('userVideos' => $userVideos, 'bucket'=>$_POST['bucket']), true);
                } else {
                    $return['myVideos'] = '<div class="alert alert-info">
                                            <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                                            '.$this->lang->line('modal_videolibrary_message_novideos').'
                                        </div>';
                }

                $return['responseCode'] = 1;
                $return['responseHTML'] = $this->load->view('partials/success', array('data'=>$temp), true);

                die( json_encode( $return ) );
            } else {
                $temp = array();
                $temp['header'] = $this->lang->line('assets_videoDelete_error1_heading');
                $temp['content'] = $this->lang->line('assets_videoDelete_error1_message');

                $return['responseCode'] = 0;
                $return['responseHTML'] = $this->load->view('partials/error', array('data'=>$temp), true);

                die( json_encode( $return ) );
            }
        }else{
            $temp = array();
            $temp['header'] = $this->lang->line('assets_videoDelete_error1_heading');
            $temp['content'] = $this->lang->line('assets_videoDelete_error1_message');

            $return['responseCode'] = 0;
            $return['responseHTML'] = $this->load->view('partials/error', array('data'=>$temp), true);

            die( json_encode( $return ) );
        }
    }
    
    public function imageDelete()
    {
        if(isset($_POST['bucket']) && isset($_POST['uri'])){
            $response = $this->s3->deleteObject($_POST['bucket'], $_POST['uri']);
            if($response){
                $user_id = userdata('user_id');
                $temp = array();
                $temp['header'] = $this->lang->line('assets_imageDelete_heading');
                $temp['content'] = $this->lang->line('assets_imageDeleteAjax_success_message');
                $exp_array = explode('/', $_POST['uri']);
                $media_name = end($exp_array);
                $uri = $exp_array[0].'/'.$exp_array[1];
                $this->media_storage_model->deleteMedia($media_name, $user_id);
                
                $userImages = $this->s3->getBucket($_POST['bucket'], $uri);

                if( $userImages ) {
                    $return['myImages'] = $this->load->view('partials/myimagetab', array('userImages' => $userImages, 'bucket'=>$_POST['bucket']), true);
                } else {
                    $return['myImages'] = '<div class="alert alert-info">
                                            <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                                            '.$this->lang->line('modal_imagelibrary_message_noimages').'
                                        </div>';
                }

                $return['responseCode'] = 1;
                $return['responseHTML'] = $this->load->view('partials/success', array('data'=>$temp), true);

                die( json_encode( $return ) );
            } else {
                $temp = array();
                $temp['header'] = $this->lang->line('assets_imageDelete_heading');
                $temp['content'] = $this->lang->line('assets_imageDeleteAjax_error1_message');

                $return['responseCode'] = 0;
                $return['responseHTML'] = $this->load->view('partials/error', array('data'=>$temp), true);

                die( json_encode( $return ) );
            }
        }else{
            $temp = array();
            $temp['header'] = $this->lang->line('assets_imageDelete_heading');
            $temp['content'] = $this->lang->line('assets_imageDeleteAjax_error1_message');

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
}
