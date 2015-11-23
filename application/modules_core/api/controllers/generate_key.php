<?php defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Description of generate_key
 *
 * @author NUSTECH
 */
class Generate_key extends MX_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation', 'template'));
        $this->load->config('rest');
        $this->load->model('api/api_key_model');
        $this->load->model('login/ion_auth_model');
    }

    public function index()
    {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            
            $return = array(
                'status' => 'failed',
                'message' => 'Please provide user\'s email and password'
            );
            echo json_encode($return);
            exit();
        }
        $responce = $this->ion_auth_model->authenticate_user($_POST['email'], $_POST['password']);
        
        if($responce){
            // Build a new key
            $key = $this->_generate_key();

            // If no key level provided, give them a rubbish one
            $level = 5;
            $ignore_limits = 3;
            // Insert the new key
            if (self::_insert_key($key, array('level' => $level, 'ignore_limits' => $ignore_limits, 'user_id'=>$responce)))
            {
                $return = array(
                    'status' => 'success',
                    'item' => array(
                        $this->config->item('rest_key_name', 'rest') => $key,
                        'user_id' => $responce
                    ),
                    'message' => 'User is successfuly logged-in, Your api key-value pair is generated. Please note it down for further communication.'
                );
                
                echo json_encode($return);
                exit();
            } else {
                $return = array(
                    'status' => 'error',
                    'item' => array(
                        'user_id' => $responce
                    ),
                    'message' => 'User is successfuly logged-in, There is some problem to generate key, Please, try again latter.'
                );
                
                echo json_encode($return);
                exit();
            }
        } else {
            $return = array(
                'status' => 'failed',
                'message' => 'Please provide correct user\'s email and password'
            );
            echo json_encode($return);
            exit();
        }

    }
    
    /* Helper Methods */
	
	private function _generate_key()
	{
		$this->load->helper('security');
		
		do
		{
			$salt = do_hash(time().mt_rand());
			$new_key = substr($salt, 0, $this->config->item('rest_key_length', 'rest'));
		}while ($this->_key_exists($new_key));

		return $new_key;
	}
    
    /* Private Data Methods */

	private function _get_key($user_id)
	{
		return $this->api_key_model->get_key($user_id);
	}

	// --------------------------------------------------------------------

	private function _key_exists($key)
	{
		return $this->api_key_model->key_exists($key);
	}
    
    // --------------------------------------------------------------------

	private function _insert_key($key, $data)
	{
		
		$data[$this->config->item('rest_key_column', 'rest')] = $key;
		$data['date_created'] = function_exists('now') ? now() : time();

		return $this->api_key_model->insert_key($data);
	}


	// --------------------------------------------------------------------

	private function _delete_key($key)
	{
		return $this->api_key_model->delete($key);
	}
}
