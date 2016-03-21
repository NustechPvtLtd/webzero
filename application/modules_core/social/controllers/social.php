<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of social
 *
 * @author NUSTECH
 */
class Social extends MX_Controller {

    public $data = array();

    function __construct()
    {

        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation', 'template'));
        $this->load->library('facebook');
        $this->load->library('twitteroauth');
        $this->load->library('linkedin');
        $this->data['title'] = ucwords(str_replace('_', ' ', $this->router->fetch_class()));
        $this->data['pageMetaDescription'] = $this->router->fetch_class() . '|' . $this->router->fetch_method();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('/', 'refresh');
        }
        $this->load->model('sites/sitemodel');
        $this->data['pageHeading'] = 'Social Media';
        $sites = $this->sitemodel->all();
        if (empty($sites)) {
            $this->session->set_flashdata('error', $this->lang->line('sites_site_error1'));
            redirect('/sites/', 'refresh');
        }
        $this->data['site_url'] = $sites[0]['siteData']->remote_url;

        $this->template->load('main', 'social', 'index', $this->data);
    }

    public function register_facebook()
    {
        $this->load->model('login/ion_auth_model');

        if ($this->facebook->logged_in()) {
            $Fbuser = $this->facebook->user();
            $facebook = array('fb_token' => $this->session->userdata('fb_token'));
            $redirect_url = (userdata('redirect_url')) ? userdata('redirect_url') : '';

            if (isset($redirect_url) && $redirect_url == 'seo') {
                if($this->make_json()){
                    $data = array(
                        'social_account' => $this->make_json()
                    );
                    
                    $userId = userdata('user_id');
                    $this->ion_auth_model->update($userId, $data);
                }
                $this->session->unset_userdata('redirect_url');
                redirect(site_url('seo'));
            } else {
                if(!isset($Fbuser['data']['email'])){
                    $this->session->set_flashdata('message', 'There is some problem in registration.<br>Please use your email to register yourself.');
                    redirect(site_url('#login_register'), 'refresh');
                }
                if (!$this->ion_auth->email_check($Fbuser['data']['email'])) {
//                    $username = strtolower($Fbuser['data']['name']);
                    $email = strtolower($Fbuser['data']['email']);
                    $username = explode('@', $email);
                    $username = $username[0].'_'.$username[1];
                    $password = random_string('alnum', 8);

                    $additional_data = array(
                        'first_name' => $Fbuser['data']['first_name'],
                        'last_name' => $Fbuser['data']['last_name'],
                        'active' => 1,
                        'social_account' => json_encode(array(
                            'facebook' => $facebook
                        ))
                    );
                    $id = $this->ion_auth->register($username, $password, $email, $additional_data);
                    if ($id) {
                        $user_id = $this->encrypt->encode($id);
                        redirect(site_url('choose-plan/'.$user_id));
//                        $this->ion_auth->login($email, $password);
                    }
                } else {
                    /*$this->ion_auth->by_pass_login($Fbuser['data']['email']);
                    if($this->make_json()){
                        $data = array(
                            'social_account' => $this->make_json()
                        );

                        $userId = userdata('user_id');
                        $this->ion_auth_model->update($userId, $data);
                    }*/
                    $this->session->set_flashdata('message', 'Email already in used.<br>Please use your email to login directly.<br>If you have forgotten your password, use Forget Password to recover.');
                    redirect(site_url('#login_register'), 'refresh');
                }
            }
        } else {
            redirect('/', 'refresh');
        }
    }

    public function register_twitter()
    {
//		$to = new TwitterOAuth( $consumerKey, $consumerSecret );
        $userId = $this->ion_auth->get_user_id();
        if (isset($_GET['register'])) {
            $tok = $this->twitteroauth->getRequestToken(site_url('social/register_twitter'));
            $this->session->set_userdata('request_token', $tok['oauth_token']);
            $this->session->set_userdata('request_token_secret', $tok['oauth_token_secret']);

            switch ($this->twitteroauth->http_code) {
                case 200:
                    /* Build authorize URL and redirect user to Twitter. */
                    $url = $this->twitteroauth->getAuthorizeURL($tok['oauth_token']);
                    header('Location: ' . $url);
                    break;
                default:
                    /* Show notification if something went wrong. */
                    echo 'Could not connect to Twitter. Refresh the page or try again later.';
            }
        }

        if (!isset($_REQUEST['denied'])) {
            $connection = new TwitterOAuth($this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));

            if (isset($_REQUEST['oauth_verifier'])) {
                $tokenCredentials = $connection->getAccessToken($_REQUEST['oauth_verifier']);
                $this->session->unset_userdata('request_token');
                $this->session->unset_userdata('request_token_secret');
                $this->session->set_userdata('tw_access_token', $tokenCredentials['oauth_token']);
                $this->session->set_userdata('tw_access_key', $tokenCredentials['oauth_token_secret']);
                if($this->make_json()){
                    $data = array(
                        'social_account' => $this->make_json()
                    );
                    
                    $userId = userdata('user_id');
                    $this->ion_auth_model->update($userId, $data);
                }
                redirect(site_url('seo'));
            }
        }
    }

    public function register_linkedin()
    {
        $reponse = $this->linkedin->getAccessToken();
        if($reponse){
            $linkedin = array('access_token' => $reponse);
            $user = $this->linkedin->user();
            if (!$this->ion_auth->email_check($user->emailAddress)) {
                $email = strtolower($user->emailAddress);
                $username = explode('@', $email);
                $username = $username[0] . '_' . $username[1];
                $password = random_string('alnum', 8);

                $additional_data = array(
                    'first_name' => $user->firstName,
                    'last_name' => $user->lastName,
                    'active' => 1,
                    'social_account' => json_encode(array(
                        'linkedin' => $linkedin
                    ))
                );
                $id = $this->ion_auth->register($username, $password, $email, $additional_data);
                if ($id) {
                    $user_id = $this->encrypt->encode($id);
                    redirect(site_url('choose-plan/' . $user_id));
                }
            } else {
                $this->session->set_flashdata('message', 'Email already in used.<br>Please use your email to login directly.<br>If you have forgotten your password, use Forget Password to recover.');
                redirect(site_url('#login_register'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', 'There is some problem in registration.<br>Please try again later.');
            redirect(site_url('#login_register'), 'refresh');
        }
    }

    public function post_to_facebook()
    {
        header('Content-Type: application/json');
        $paramters = array(
            'message' => $_POST['desc'],
            'link' => isset($_POST['link']) ? $_POST['link'] : site_url(),
            'name' => isset($_POST['title']) ? $_POST['title'] : 'Jadooweb',
//                        'picture' => $imgPath
        );

        $result = $this->facebook->publish_content($paramters);
        echo json_encode($result);
    }

    public function post_to_twitter()
    {
        if (isset($_POST['title'])) {
            if (isset($_POST['desc'])) {
                $msg = isset($_POST['link']) ? $_POST['title'] . ' ' . $_POST['desc'] . ' ' . $_POST['link'] : $_POST['title'] . ' ' . $_POST['desc'] . ' ' . site_url();
            } else {
                $msg = isset($_POST['link']) ? $_POST['title'] . ' ' . $_POST['link'] : $_POST['title'] . ' ' . site_url();
            }
        } else {
            $msg = isset($_POST['link']) ? $_POST['link'] : site_url();
        }


        $tw = TRUE;
        $connection = new TwitterOAuth($this->session->userdata('tw_access_token'), $this->session->userdata('tw_access_key'));
        /* $connection->ssl_verifypeer = TRUE;
          $connection->content_type = 'application/x-www-form-urlencoded'; */
        $connection->get('account/verify_credentials');
        $responce = $connection->post('statuses/update', array('status' => $msg/* , 'media[]' => $imgPath */));
        echo json_encode($responce);
    }

    public function post_to_profile()
    {
        $return = array();
        if (isset($_POST['socialMedia'])) {
            foreach ($_POST['socialMedia'] as $value) {
                if ($value == 'facebook') {
                    $paramters = array(
                        'message' => $_POST['desc'],
                        'link' => isset($_POST['link']) ? $_POST['link'] : site_url(),
                        'name' => isset($_POST['title']) ? $_POST['title'] : 'Jadooweb',
//                        'picture' => $imgPath
                    );
                    $responce = (new Facebook())->publish($paramters);
                    if ($responce) {
                        $return['facebook'] = $responce;
                    }
                }
                if (isset($_POST['title'])) {
                    if (isset($_POST['desc'])) {
                        $msg = isset($_POST['link']) ? $_POST['title'] . ' ' . $_POST['desc'] . ' ' . $_POST['link'] : $_POST['title'] . ' ' . $_POST['desc'] . ' ' . site_url();
                    } else {
                        $msg = isset($_POST['link']) ? $_POST['title'] . ' ' . $_POST['link'] : $_POST['title'] . ' ' . site_url();
                    }
                } else {
                    $msg = isset($_POST['link']) ? $_POST['link'] : site_url();
                }

                if ($value == 'twitter') {
                    $tw = TRUE;
                    $connection = new TwitterOAuth($this->session->userdata('tw_access_token'), $this->session->userdata('tw_access_key'));
                    /* $connection->ssl_verifypeer = TRUE;
                      $connection->content_type = 'application/x-www-form-urlencoded'; */
                    $connection->get('account/verify_credentials');
                    $responce = $connection->post('statuses/update', array('status' => $msg/* , 'media[]' => $imgPath */));
                    if ($responce) {
                        $return['twitter'] = $responce;
                    }
                }
                if ($value == 'linkedin') {
                    
                }
            }
            redirect(site_url('social'));
        } else {
            redirect(site_url('social'), 'refresh');
        }
    }

    public function disconnect_account($account)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('/', 'refresh');
        }
        $query = $this->db->select('social_account')
                ->where('id', $this->ion_auth->get_user_id())
                ->get('users');
        if ($query->num_rows() === 1) {
            $social_account = $query->row();
            $social_account = json_decode($social_account->social_account);

            if ($account == 'facebook') {
                unset($social_account->facebook);
                $this->session->unset_userdata('fb_token');
            } elseif ($account == 'twitter') {
                unset($social_account->twitter);
                $this->session->unset_userdata(array(
                    'tw_access_token' => '',
                    'tw_access_key' => '',
                ));
            } else {
                unset($social_account->twitter);
                $this->session->unset_userdata(array(
                    'li_access_token' => '',
                    'li_access_key' => '',
                    'li_access_verifier' => '',
                ));
            }
            $this->db->update('users', array('social_account' => json_encode($social_account)), array('id' => $this->ion_auth->get_user_id()));
        }
        redirect(site_url('social'));
    }

    private function make_json()
    {
        $social_account = array();

        if($this->session->userdata('fb_token')){$social_account['facebook'] = array('fb_token' => $this->session->userdata('fb_token'));}
        
        if($this->session->userdata('gl_token')){$social_account['google'] = array('gl_token' => $this->session->userdata('gl_token'));}
        
        if ($this->session->userdata('li_access_token') && $this->session->userdata('li_access_key')) {
            $social_account['linkedin'] = array(
                'access_token' => $this->session->userdata('li_access_token'),
                'access_key' => $this->session->userdata('li_access_key'),
                'access_verifier' => $this->session->userdata('li_access_verifier')
            );
        }

        if ($this->session->userdata('tw_access_token') && $this->session->userdata('tw_access_key')) {
            $social_account['twitter'] = array(
                'access_token' => $this->session->userdata('tw_access_token'),
                'access_key' => $this->session->userdata('tw_access_key'),
            );
        }

        if (!empty($social_account)) {
            return json_encode($social_account);
        }
        return FALSE;
    }

}
