<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assets extends MY_Controller {
    
    public $data = array();
    
	function __construct()
	{
		parent::__construct();
		$this->load->helper('directory');
		
		$this->load->model('sites/usermodel');
		$this->load->model('sites/sitemodel');
        $this->load->model('sites/media_storage_model');
        
		$this->load->library('s3');
			
		$this->data['pageTitle'] = $this->lang->line('sites_page_title');
	
		if(!$this->ion_auth->logged_in()) {
			
			redirect('/login');
		
		}
		
	}
	
	public function images() {
		
		//load user images
		
		$user = $this->ion_auth->user()->row();
		
		$userID = $user->id;
		
		$userImages = $this->usermodel->getUserImages( $userID );
		
		if( $userImages ) {
		
			$this->data['userImages'] = $userImages;
		
		}
	
		
		//load admin images		
		
		$adminImages = $this->sitemodel->adminImages();
		
		if( $adminImages ) {
		
			$this->data['adminImages'] = $adminImages;
		
		}
		
		$this->data['userID'] = $userID;
	
		$this->data['page'] = "images";
		$this->data['pageHeading'] = $this->lang->line('images_heading');
        $this->data['css'] = array(
		    '<link href="'.base_url().'assets/sites/less/flat-ui.css" rel="stylesheet">'
		);
        $this->template->load('sites', 'sites', 'assets/images', $this->data);
//		$this->load->view(, $this->data);
	
	}
	
	
	
	/*
		
		takes an incoming form with file upload
		
	*/
	
	public function imageUpload() {
	
		$user = $this->ion_auth->user()->row();
		
		$userID = $user->id;
		
		
		//if the upload path does not exist, create it
		
		if( !file_exists( './'.$this->config->item('images_uploadDir').'/'.$userID ) ) {
		
			mkdir('./'.$this->config->item('images_uploadDir').'/'.$userID, 0777, true);
		
		}
		
	
		$config['upload_path'] = './'.$this->config->item('images_uploadDir').'/'.$userID.'/';
		$config['allowed_types'] = $this->config->item('upload_allowed_types');
		$config['max_size']	= $this->config->item('upload_max_size');
		$config['max_width']  = $this->config->item('upload_max_width');
		$config['max_height']  = $this->config->item('upload_max_height');
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('userFile')) {
					
			$this->session->set_flashdata('error', $this->upload->display_errors());
				
		} else {
			
			$this->session->set_flashdata('success', 1);
		
		}
		
		redirect(site_url('sites/assets/images'), 'location');
	
	}
	
	
	
	/*
	
		takes an incoming form with image via Ajax
		
	
	
	public function imageUploadAjax($siteID) {
	
		$user = $this->ion_auth->user()->row();
			
		$userID = $user->id;
			
			
		//if the upload path does not exist, create it
			
		if( !file_exists( './'.$this->config->item('images_uploadDir').'/'.$userID ) ) {
			
			mkdir('./'.$this->config->item('images_uploadDir').'/'.$userID, 0777, true);
			
		}
			
		
		$config['upload_path'] = './'.$this->config->item('images_uploadDir').'/'.$userID.'/';
		$config['allowed_types'] = $this->config->item('upload_allowed_types');
		$config['max_size']	= $this->config->item('upload_max_size');
		$config['max_width']  = $this->config->item('upload_max_width');
		$config['max_height']  = $this->config->item('upload_max_height');
			
		$this->load->library('upload', $config);
			
		if ( ! $this->upload->do_upload('imageFile')) {
									
			$return = array();
				
			$temp = array();
			$temp['header'] = $this->lang->line('assets_imageUploadAjax_error1_heading');
			$temp['content'] = $this->lang->line('assets_imageUploadAjax_error1_message').$this->upload->display_errors();
				
			$return['responseCode'] = 0;
			$return['responseHTML'] = $this->load->view('partials/error', array('data'=>$temp), true);
				
			die( json_encode( $return ) );
					
		} else {
				
			$return = array();
				
			$temp = array();
			$temp['header'] = $this->lang->line('assets_imageUploadAjax_success_heading');
			$temp['content'] = $this->lang->line('assets_imageUploadAjax_success_message');
			
			
			//include the partils "myimages" with all the uploaded images
			
			
			$userID = $user->id;
			
			$userImages = $this->usermodel->getUserImages( $userID );
			
			if( $userImages ) {
			
				$siteData = $this->sitemodel->getSite($siteID);
							
				$return['myImages'] = $this->load->view('partials/myimages', array('userImages'=>$userImages,'siteData'=>$siteData), true);
			
			}
			
			
			
				
			$return['responseCode'] = 1;
			$return['responseHTML'] = $this->load->view('partials/success', array('data'=>$temp), true);
			
			die( json_encode( $return ) );
			
		}
				
	}
	
	
		takes an incoming form with image via Ajax
		
	*/
	
	public function imageUploadAjax($siteID) {

		$user_id = userdata('user_id');
			
        $type = 'image';
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
		
		$config['allowed_types'] = $this->config->item('upload_allowed_types');
		$config['max_size']	= $this->config->item('upload_max_size');
		$config['max_width']  = $this->config->item('upload_max_width');
		$config['max_height']  = $this->config->item('upload_max_height');
        
        $this->load->library('upload', $config);
        $return = array();

		if($this->upload->validate_file('imageFile')){
            $name = $_FILES['imageFile']['name'];
            $tmp = $_FILES['imageFile']['tmp_name'];
            $ext = $this->upload->get_extension($name);
            $actual_image_name = 'Image'.date('DdmY').mt_rand(100000, 999999).$ext;
            $response = $this->s3->putObjectFile($tmp, $bucket , $uri.'/Images/'.$actual_image_name, S3::ACL_PUBLIC_READ);
            if($response){
                $temp = array();
				
                $temp['header'] = $this->lang->line('assets_imageUploadAjax_success_heading');
                $temp['content'] = $this->lang->line('assets_imageUploadAjax_success_message');

                $data = array(
                    'bucket_name' => $bucket,
                    'uri' => $uri,
                    'media_name' => $actual_image_name,
                    'type' => $type,
                    'user_id' => $user_id,
                );
                $this->media_storage_model->insertMedia($data);
                //include the partils "myvideos" with all the uploaded videos
                $userImages = $this->s3->getBucket($bucket, $uri.'/Images');

                if( $userImages ) {
                    $siteData = $this->sitemodel->getSite($siteID);
                    $return['myImages'] = $this->load->view('partials/myimages', array('userImages'=>$userImages,'siteData'=>$siteData, 'bucket'=>$bucket), true);
                }

                $return['responseCode'] = 1;
                $return['responseHTML'] = $this->load->view('partials/success', array('data'=>$temp), true);

                die( json_encode( $return ) );
            } else {
                $temp = array();
                $temp['header'] = $this->lang->line('assets_imageUploadAjax_error1_heading');
                $temp['content'] = $this->lang->line('assets_imageUploadAjax_error1_message').$this->upload->display_errors();
                $return['responseCode'] = 0;
                $return['responseHTML'] = $this->load->view('partials/error', array('data'=>$temp), true);

                die( json_encode( $return ) );
            }
        } else {
			$temp = array();
			$temp['header'] = $this->lang->line('assets_imageUploadAjax_error1_heading');
			$temp['content'] = $this->lang->line('assets_imageUploadAjax_error1_message').$this->upload->display_errors();
				
			$return['responseCode'] = 0;
			$return['responseHTML'] = $this->load->view('partials/error', array('data'=>$temp), true);
				
			die( json_encode( $return ) );
        }	
	}
    
	/*
	
		takes an incoming form with image via Ajax from Editor
		
	*/
	
	public function imageUploadEditor($siteID) {
	
		$user = $this->ion_auth->user()->row();
			
		$userID = $user->id;
			
		//if the upload path does not exist, create it
			
		if( !file_exists( './'.$this->config->item('images_uploadDir').'/'.$userID ) ) {
			
			mkdir('./'.$this->config->item('images_uploadDir').'/'.$userID, 0777, true);
			
		}
			
		$upload_path = $this->config->item('images_uploadDir').'/'.$userID.'/';
		$config['upload_path'] = './'.$this->config->item('images_uploadDir').'/'.$userID.'/';
		$config['allowed_types'] = $this->config->item('upload_allowed_types');
		$config['max_size']	= $this->config->item('upload_max_size');
		$config['max_width']  = $this->config->item('upload_max_width');
		$config['max_height']  = $this->config->item('upload_max_height');
			
		$this->load->library('upload', $config);
			
		if ( ! $this->upload->do_upload('file')) {
            return FALSE;
					
		} else {
			$upload_data = $this->upload->data(); 
            $file_name =   $upload_data['file_name'];	
            $array = array(
                'filelink' => base_url($upload_path.$file_name),
                'alt' => $file_name,
                'title'=>$upload_data['raw_name']
            );

            echo stripslashes(json_encode($array));
			
		}
				
	}
	
	
	
	
	/*
		removes a single user image
	*/
	
	public function delImage() {
	
		if( isset($_POST['file']) && $_POST['file'] != '' ) {
		
			
			$user = $this->ion_auth->user()->row();
			
			$userID = $user->id;
			
		
			//disect the URL
			
			$temp = explode("/", $_POST['file']);
			
			$fileName = array_pop( $temp );
			
			$userDirID = array_pop( $temp );
			
			
			//make sure this is the user's images
			
			if( $userID == $userDirID ) {
			
				//all good, remove!
				unlink( './'.$this->config->item('images_uploadDir').'/'.$userID.'/'.$fileName );
			
			}
		
		}
	
	}
	
}

/* End of file assets.php */
/* Location: ./application/controllers/assets.php */