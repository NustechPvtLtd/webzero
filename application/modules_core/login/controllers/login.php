<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class login extends MX_Controller
{
    public $data = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation', 'template', 'visitor_count', 'facebook', 'google'));
        //$this->form_validation->CI =& $this;
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->data['title'] = $this->router->fetch_method();
        $this->data['pageMetaDescription'] = $this->router->fetch_class().'-'.$this->router->fetch_method();
        $this->load->model('account/plans_model');
    }
    
    public function index()
    {
        //$this->data['main_content'] = 'login_form';
        //$this->load->view('includes/template', $this->data);	

        if (!$this->ion_auth->logged_in()) {
            $this->data ['title'] = 'Web Zero';
                
            $this->data ['pageMetaDescription'] = 'Login to WebZero.in';

            //validate form input
            $this->form_validation->set_rules('identity', 'Email/Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
//            $this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
            if ($this->form_validation->run() == true) {
                //check to see if the user is logging in
                //check for "remember me"
                $remember = (bool) $this->input->post('remember');

                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    //if the login is successful
                    //redirect them back to the home page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->in_group(array('comp-admin', 'individuals'))) {
                        redirect('services', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                } else {
                    //if the login was un-successful
                    //redirect them back to the login page
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect(site_url('#login_register'), 'refresh'); 
                }
            } else {
                //the user is not logging in so display the login page
                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['identity'] = array('name' => 'identity',
                    'id' => 'identity',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('identity'),
                    'class' => "form-control",
                    'placeholder' => 'Email/Username',
                );
                $this->data['password'] = array('name' => 'password',
                    'id' => 'password',
                    'type' => 'password',
                    'class' => "form-control",
                    'placeholder' => 'Password',
                );
                $this->session->unset_userdata('fb_token');
                $this->template->load('home', 'login', 'home', $this->data);
                //$this->_render_page('auth/login', $this->data);
            }
        } elseif (!$this->ion_auth->is_admin()) {
            //remove this elseif if you want to enable this for non-admins

            if ($this->ion_auth->in_group(array('comp-admin', 'individuals'))) {
                redirect('services', 'refresh');
            } else {
                return show_error('You must be an logged-in to view this page.');
            }
        } else {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['users'] = $this->ion_auth->users(array('individuals', 'comp-admin'))->result();
            
            foreach ($this->data['users'] as $k => $user) {
                $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
                $this->data['users'][$k]->plans = $this->plans_model->get_plans_by_id($user->price_plan_id);
            }

            $this->data['title'] = 'Users';
            $this->data['pageMetaDescription'] = 'webzero.in';
            $this->data['pageHeading'] = lang('index_heading');
            $this->data['css'] = array(
                '<link href="'. base_url().'assets/datatable/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet">',
                '<link href="'. base_url().'assets/datatable/css/dataTables.responsive.css" type="text/css" rel="stylesheet">',
                '<style>td.child{text-align:left !important}</style>'
            );
            $this->data['js'] = array(
                '<script type="text/javascript" src="'. base_url().'assets/datatable/js/jquery.dataTables.min.js"></script>',
                '<script type="text/javascript" src="'. base_url().'assets/datatable/js/dataTables.bootstrap.js"></script>',
                '<script type="text/javascript" src="'. base_url().'assets/datatable/js/dataTables.responsive.js"></script>',
                '<script type="text/javascript" src="'. base_url().'assets/js/jquery.blockUI.js"></script>'
            );
            $this->template->load('main', 'login', 'index', $this->data);
            //$this->_render_page('auth/index', $this->data);
        }
    }
    
    //login the user via ajax request
    public function ajaxLogin()
    {
        if (isset($_POST['id'])) {
            if ($this->ion_auth->by_pass_login($_POST['id'])) {
                //if the login is successful
                //redirect them back to the home page
                if ($this->ion_auth->in_group(array('comp-admin', 'individuals'))) {
                    echo site_url('services');
                } else {
                    echo site_url();
                }
            }
        }
    }
    
    //log the user out
    public function logout()
    {
        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('/', 'refresh');
    }
    
    //change password
    public function change_password()
    {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
            //display the form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id'   => 'old',
                'type' => 'password',
            );
            $this->data['new_password'] = array(
                'name' => 'new',
                'id'   => 'new',
                'type' => 'password',
                'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id'   => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
            );
            $this->data['user_id'] = array(
                'name'  => 'user_id',
                'id'    => 'user_id',
                'type'  => 'hidden',
                'value' => $user->id,
            );

            //render
            $this->_render_page('login/change_password', $this->data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('login/change_password', 'refresh');
            }
        }
    }

    //forgot password
    public function forgot_password()
    {
        //setting validation rules by checking wheather identity is username or email
        if ($this->config->item('identity', 'ion_auth') == 'username') {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }
        
        $this->data['title'] = 'Forgot Password';
        $this->data['pageMetaDescription'] = 'webzero.in';

        if ($this->form_validation->run() == false) {
            //setup the input
            $this->data['email'] = array('name' => 'email',
                'id' => 'email',
                'class' => "form-control",
            );

            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            //set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->template->load('guest', 'login', 'forgot_password', $this->data);
            //$this->_render_page('login/forgot_password', $this->data);
        } else {
            // get identity from username or email
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
            } else {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            }
            if (empty($identity)) {
                if ($this->config->item('identity', 'ion_auth') == 'username') {
                    $this->ion_auth->set_message('forgot_password_username_not_found');
                } else {
                    $this->ion_auth->set_message('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("forgot-password", 'refresh');
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("forgot-password", 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("forgot-password", 'refresh');
            }
        }
    }

    //reset password - final step for forgotten password
    public function reset_password($code = null)
    {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            $this->data ['title'] = 'Reset Password';
            $this->data ['pageMetaDescription'] = 'webzero.in';
            //if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                //display the form

                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id'   => 'new',
                    'type' => 'password',
                    'class' => "form-control",
                    'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id'   => 'new_confirm',
                    'type' => 'password',
                    'class' => "form-control",
                    'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
                );
                $this->data['user_id'] = array(
                    'name'  => 'user_id',
                    'id'    => 'user_id',
                    'type'  => 'hidden',
                    'class' => "form-control",
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                //render
                $this->template->load('guest', 'login', 'reset_password', $this->data);
//				$this->_render_page('login/reset_password', $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === false || $user->id != $this->input->post('user_id')) {

                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        $this->logout();
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('reset-password' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("forgot-password", 'refresh');
        }
    }


    //activate the user
    public function activate($id, $code=false)
    {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } elseif ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("login", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("forgot-password", 'refresh');
        }
    }

    //deactivate the user
    public function deactivate($id = null)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == false) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();
            
            $this->template->load('main', 'login', 'deactivate_user', $this->data);
//			$this->_render_page('login/deactivate_user', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === false || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect('/', 'refresh');
        }
    }

    //create a new user
    public function create_user()
    {
        $this->data['title'] = 'Create User';
        $this->data['pageMetaDescription'] = 'webzero.in';

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('login', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
//        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
//        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
//        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {
            $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
            $email    = strtolower($this->input->post('email'));
            $password = $this->input->post('password');
            
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
                'parent_id'  => userdata('id'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data)) {
            //check to see if we are creating the user
            //redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("/", 'refresh');
        } else {
            //display the create user form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
                'class' => 'form-control',
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
                'class' => 'form-control',
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control',
            );
            $this->data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('company'),
                'class' => 'form-control',
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('phone'),
                'class' => 'form-control',
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
                'class' => 'form-control',
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
                'class' => 'form-control',
            );
            $this->data['js'] = array(
                '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.maskedinput.js"></script>',
            );
            $this->data['pageHeading'] = lang('create_user_heading');
// 			$this->_render_page('auth/create_user', $this->data);
            $this->template->load('main', 'login', 'create_user', $this->data);
        }
    }

    //edit a user
    public function edit_user($id)
    {
        $this->data['title'] = "Edit User";

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('login', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups=$this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === false || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            //update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === true) {
                $this->data['first_name'] = $this->input->post('first_name');
                    
                $this->data['last_name']  = $this->input->post('last_name');
                $this->data['company']    = $this->input->post('company');
                $this->data['phone']      = $this->input->post('phone');
                

                //update the password if it was posted
                if ($this->input->post('password')) {
                    $this->data['password'] = $this->input->post('password');
                }

                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {
                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }

            //check to see if we are updating the user
               if ($this->ion_auth->update($user->id, $this->data)) {
                   //redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                   if ($this->ion_auth->is_admin()) {
                       redirect('/', 'refresh');
                   } else {
                       redirect('/', 'refresh');
                   }
               } else {
                   //redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                   if ($this->ion_auth->is_admin()) {
                       redirect('/', 'refresh');
                   } else {
                       redirect('/', 'refresh');
                   }
               }
            }
        }

        //display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name'  => 'first_name',
            'id'    => 'first_name',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name'  => 'last_name',
            'id'    => 'last_name',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['company'] = array(
            'name'  => 'company',
            'id'    => 'company',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('company', $user->company),
        );
        $this->data['phone'] = array(
            'name'  => 'phone',
            'id'    => 'phone',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id'   => 'password',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id'   => 'password_confirm',
            'type' => 'password'
        );
        $this->template->load('main', 'login', 'edit_user', $this->data);
//		$this->_render_page('login/edit_user', $this->data);
    }

    // create a new group
    public function create_group()
    {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('login', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == true) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("login", 'refresh');
            }
        } else {
            //display the create group form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name'  => 'group_name',
                'id'    => 'group_name',
                'type'  => 'text',
                "class" => "form-control",
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name'  => 'description',
                'id'    => 'description',
                'type'  => 'text',
                "class" => "form-control",
                'value' => $this->form_validation->set_value('description'),
            );
            $this->data['pageHeading'] = lang('create_group_heading');
//			$this->_render_page('login/create_group', $this->data);
            $this->template->load('main', 'login', 'create_group', $this->data);
        }
    }

    //edit a group
    public function edit_group($id)
    {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('login', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('login', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === true) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("login", 'refresh');
            }
        }

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['group'] = $group;

        $this->data['group_name'] = array(
            'name'  => 'group_name',
            'id'    => 'group_name',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
        );
        $this->data['group_description'] = array(
            'name'  => 'group_description',
            'id'    => 'group_description',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->_render_page('login/edit_group', $this->data);
    }
    
    public function register()
    {
        $this->data ['title'] = 'Registration';
            
        $this->data ['pageMetaDescription'] = 'Webzero.in';
        if ($this->ion_auth->logged_in()) {
            redirect('/', 'refresh');
        }
        
        $tables = $this->config->item('tables', 'ion_auth');
        
        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
//	    $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
//	    $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
//	    $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {
            $username = strtolower($this->input->post('first_name'));
            $email    = strtolower($this->input->post('email'));
            $password = $this->input->post('password');
        
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
//	            'last_name'  => $this->input->post('last_name'),
//	            'company'    => $this->input->post('company'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data)) {
            //check to see if we are creating the user
            //redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("register", 'refresh');
        } else {
            //display the create user form
            //set the flash data error message if there is one
            $this->data['message'] = ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'));
        
            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
                'class' => 'form-control',
            );
//	        $this->data['last_name'] = array(
//	            'name'  => 'last_name',
//	            'id'    => 'last_name',
//	            'type'  => 'text',
//	            'value' => $this->form_validation->set_value('last_name'),
//	            'class' => 'form-control',
//	        );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control',
            );
//	        $this->data['company'] = array(
//	            'name'  => 'company',
//	            'id'    => 'company',
//	            'type'  => 'text',
//	            'value' => $this->form_validation->set_value('company'),
//	            'class' => 'form-control',
//	        );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
                'class' => 'form-control',
            );
//	        $this->data['password_confirm'] = array(
//	            'name'  => 'password_confirm',
//	            'id'    => 'password_confirm',
//	            'type'  => 'password',
//	            'value' => $this->form_validation->set_value('password_confirm'),
//	            'class' => 'form-control',
//	        );
            // 			$this->_render_page('auth/create_user', $this->data);
//	        $this->template->load('guest', 'login', 'register', $this->data);
            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
                'class' => "form-control",
                'placeholder' => 'Email/Username',
            );
            $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => "form-control",
                'placeholder' => 'Password',
            );
            $this->template->load('home', 'login', 'home', $this->data);
        }
    }

    public function register_google()
    {
        if ($this->google->getUser()) {
            $google = array('gl_token' => $this->session->userdata('gl_token'));
            $userInfo = $this->google->getUser();
            if (!$this->ion_auth->email_check($userInfo->email)) {
                $username = strtolower($userInfo->name);
                $email    = strtolower($userInfo->email);
                $password = 'google2015';

                $additional_data = array(
                    'first_name' => $userInfo->givenName,
                    'last_name'  => $userInfo->familyName,
                    'active'    => 1,
                    'social_account' => json_encode(array(
                        'google' => $google
                    ))
                );
                if ($this->ion_auth_model->register($username, $password, $email, $additional_data)) {
                    $this->ion_auth->login($email, $password);
                }
            } else {
                $this->ion_auth->by_pass_login($userInfo->email);
                if ($this->make_json()) {
                    $data = array(
                        'social_account' => $this->make_json()
                    );

                    $userId = userdata('user_id');
                    $this->ion_auth_model->update($userId, $data);
                }
            }
            redirect('/', 'refresh');
        }
    }
    
    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    public function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== false &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return true;
        } else {
            return false;
        }
    }

    public function _render_page($view, $data=null, $render=false)
    {
        $this->viewdata = (empty($data)) ? $this->data: $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render) {
            return $view_html;
        }
    }
    
//    function site_contact($id)
//    {
//        header('Access-Control-Allow-Origin: *');
//        $site_id = $this->encrypt->decode($id);
//
//        if(!empty($_REQUEST['email']) ){
//            $result = $this->ion_auth->contact_webpage_owner($_REQUEST['email'], $_REQUEST['name'], $_REQUEST['message'], $site_id);
//            if($result){
//                return TRUE;
//            }  else {
//                return FALSE;
//            }
//        } /*else {
//            return FALSE;
//        }*/
//    }

    public function site_contact($id)
    {
        header('Access-Control-Allow-Origin: *');
        $site_id = $this->encrypt->decode($id);
        $status = array();
        
        if (isset($_POST['email']) &&!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['formname'])) {
            $name     = "";
            $email     = $_POST['email'];
            $formname= $_POST['formname'];
            $phone     = "";
            $message = "";
            $resmsg  = "";
            if ($_POST['formname']=="contact1") {
                $name    = isset($_POST['name'])?$_POST['name']:"";
                $phone    = isset($_POST['phone'])?$_POST['phone']:"";
                $message= isset($_POST['message'])?$_POST['message']:"";
                $resmsg = "<h2>Thank you for contacting us,</h2> <p>We will be in touch soon.</p>";
            } elseif ($_POST['formname']=="contact2") {
                $name    = isset($_POST['name'])?$_POST['name']:"";
                $message= isset($_POST['message'])?$_POST['message']:"";
                $resmsg = "<h2>Thank you for contacting us,</h2> <p>We will be in touch soon.</p>";
            } elseif ($_POST['formname']=="contact3") {
                $name    = isset($_POST['name'])?$_POST['name']:"";
                $phone    = isset($_POST['phone'])?$_POST['phone']:"";
                $message= isset($_POST['message'])?$_POST['message']:"";
                $resmsg = "<h2>Thank you for contacting us,</h2> <p>We will be in touch soon.</p>";
            } elseif ($_POST['formname']=="header10") {
                $fname    = isset($_POST['firstname'])?$_POST['firstname']:"";
                $lname    = isset($_POST['lastname'])?$_POST['lastname']:"";
                $name    = $fname." ".$lname;
                $message= $name." contact with you..";
                $resmsg = "<h2>Thank you for contacting us,</h2> <p>We will be in touch soon.</p>";
            }
            
            // Now its time to send the mail to user. Function will work for you...
            $result = $this->ion_auth->contact_webpage_owner($email, $name, $message, $site_id, $phone);
            if ($result) {
                $status['status']    = "success";
                $status['message']    = $resmsg;
                $status['formname']    = $formname;
                $status['payload']    = $_POST;
                echo json_encode($status);
            } else {
                $status['status']    = "error";
                $status['formname']    = $formname;
                $status['message']    = "Something went wrong, Please try leter.!!!!";
                echo json_encode($status);
            }
        } else {
            // control will not come here test in future if in use..
            $status['status']    = "error";
            $status['message']    = "Please feel all required fields...";
            echo json_encode($result);
        }
    }
    
    public function visitor_counter($id)
    {
        header('Access-Control-Allow-Origin: *');
        $site_id = $this->encrypt->decode($id);

        if (!empty($_REQUEST['ip']) && $site_id) {
            $this->visitor_count->visitors($_REQUEST['ip'], $site_id, $_REQUEST['page_id'], $_REQUEST['page_url']);
        }
    }
    
    private function make_json()
    {
        $social_account = array();

        if ($this->session->userdata('fb_token')) {
            $social_account['facebook'] = array('fb_token' => $this->session->userdata('fb_token'));
        }
        
        if ($this->session->userdata('gl_token')) {
            $social_account['google'] = array('gl_token' => $this->session->userdata('gl_token'));
        }
        
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
        return false;
    }
}
