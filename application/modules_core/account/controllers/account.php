<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Account extends MY_Controller {

    public $data = array();

    function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->lang->load('plans');
        $this->lang->load('gateways');
        $this->load->model('addressmodel');
        $this->load->model('account/plans_model');
        $this->load->model('account/account_upgrade_model');
        $this->load->model('account/payment_gateways_model');
        $this->data['title'] = ucfirst($this->router->fetch_class());
        $this->data['pageMetaDescription'] = $this->router->fetch_class() . '|' . $this->router->fetch_method();
    }

    public function address_details()
    {
        $address = $this->addressmodel->get_address($this->ion_auth->get_user_id());
        //validation rule
        $this->form_validation->set_rules('blng_street', $this->lang->line('edit_blng_street_label'), 'required');
        $this->form_validation->set_rules('blng_city', $this->lang->line('edit_blng_city_label'), 'required');
        $this->form_validation->set_rules('blng_state', $this->lang->line('edit_blng_state_label'), 'required');
        $this->form_validation->set_rules('blng_zipcode', $this->lang->line('edit_blng_zipcode_label'), 'required');
        $this->form_validation->set_rules('blng_country', $this->lang->line('edit_blng_country_label'), 'required');
        $this->form_validation->set_rules('spng_street', $this->lang->line('edit_spng_street_label'), 'required');
        $this->form_validation->set_rules('spng_city', $this->lang->line('edit_spng_city_label'), 'required');
        $this->form_validation->set_rules('spng_state', $this->lang->line('edit_spng_state_label'), 'required');
        $this->form_validation->set_rules('spng_zipcode', $this->lang->line('edit_spng_zipcode_label'), 'required');
        $this->form_validation->set_rules('spng_country', $this->lang->line('edit_spng_country_label'), 'required');
        $this->data['message'] = '';
        if (isset($_POST) && !empty($_POST)) {

            if ($this->form_validation->run() === TRUE) {

                if ($address) {
                    $data = array(
                        array(
                            'id' => $address['blng_id'],
                            'street' => $this->input->post('blng_street'),
                            'city' => $this->input->post('blng_city'),
                            'state' => $this->input->post('blng_state'),
                            'zipcode' => $this->input->post('blng_zipcode'),
                            'country' => $this->input->post('blng_country'),
                            'phone' => $this->input->post('blng_phone'),
                            'type' => "billing",
                            'user_id' => $this->ion_auth->get_user_id()
                        ),
                            array(
                            'id' => (isset($address['spng_id']))?$address['spng_id']:'',
                            'street' => $this->input->post('spng_street'),
                            'city' => $this->input->post('spng_city'),
                            'state' => $this->input->post('spng_state'),
                            'zipcode' => $this->input->post('spng_zipcode'),
                            'country' => $this->input->post('spng_country'),
                            'phone' => $this->input->post('spng_phone'),
                            'type' => "shipping",
                            'user_id' => $this->ion_auth->get_user_id()
                        )
                    );

                    //check to see if we are updating the user
                    if ($this->addressmodel->update_address($data)) {
                        //redirect them back to the admin page if admin, or to the base url if non admin
                        $this->data['message'] = '<div class="alert alert-success">Address Updated</div>';
                    } else {
                        //redirect them back to the admin page if admin, or to the base url if non admin
                        $this->data['message'] = '<div class="alert alert-error">Error</div>';
                    }
                } else {
                    $data = array(
                        array(
                            'street' => $this->input->post('blng_street'),
                            'city' => $this->input->post('blng_city'),
                            'state' => $this->input->post('blng_state'),
                            'zipcode' => $this->input->post('blng_zipcode'),
                            'country' => $this->input->post('blng_country'),
                            'phone' => $this->input->post('blng_phone'),
                            'type' => "billing",
                            'user_id' => $this->ion_auth->get_user_id(),
                        ),
                        array(
                            'street' => $this->input->post('spng_street'),
                            'city' => $this->input->post('spng_city'),
                            'state' => $this->input->post('spng_state'),
                            'zipcode' => $this->input->post('spng_zipcode'),
                            'country' => $this->input->post('spng_country'),
                            'phone' => $this->input->post('spng_phone'),
                            'type' => "shipping",
                            'user_id' => $this->ion_auth->get_user_id(),
                        ),
                    );

                    if ($this->addressmodel->set_address($data)) {
                        $this->data['message'] = 'Address Updated';
                        redirect(site_url('account/address_details'), 'refresh');
                    } else {
                        $this->data['message'] = '<div class="alert alert-error">Error</div>';
                    }
                }
            } else {
                $this->data['message'] = '<div class="alert alert-error">' . validation_errors() . '</div>';
            }
        }

        //pass the user to the view
        $this->data['country'] = $this->addressmodel->get_country();

        $this->data['states'] = (isset($address['blng_country'])) ? $this->addressmodel->get_state_by_country($address['blng_country']) : array('' => 'please select');

        $this->data['blng_street'] = array(
            'name' => 'blng_street',
            'id' => 'blng_street',
            'type' => 'text',
            'value' => (isset($address['blng_street'])) ? $this->form_validation->set_value('blng_street', $address['blng_street']) : '',
            'class' => 'form-control',
        );
        $this->data['blng_city'] = array(
            'name' => 'blng_city',
            'id' => 'blng_city',
            'type' => 'text',
            'value' => (isset($address['blng_city'])) ? $this->form_validation->set_value('blng_city', $address['blng_city']) : '',
            'class' => 'form-control city',
        );
        $this->data['blng_state'] = (isset($address['blng_zipcode'])) ? $address['blng_state'] : '';
        $this->data['blng_zipcode'] = array(
            'name' => 'blng_zipcode',
            'id' => 'blng_zipcode',
            'type' => 'text',
            'value' => (isset($address['blng_zipcode'])) ? $this->form_validation->set_value('blng_zipcode', $address['blng_zipcode']) : '',
            'class' => 'form-control',
        );
        $this->data['blng_country'] = (isset($address['blng_country'])) ? $address['blng_country'] : '';
        $this->data['blng_phone'] = array(
            'name' => 'blng_phone',
            'id' => 'blng_phone',
            'type' => 'text',
            'value' => (isset($address['blng_phone'])) ? $this->form_validation->set_value('blng_phone', $address['blng_phone']) : '',
            'class' => 'form-control',
        );
        $this->data['spng_street'] = array(
            'name' => 'spng_street',
            'id' => 'spng_street',
            'type' => 'text',
            'value' => (isset($address['spng_street'])) ? $this->form_validation->set_value('spng_street', $address['spng_street']) : '',
            'class' => 'form-control',
        );
        $this->data['spng_city'] = array(
            'name' => 'spng_city',
            'id' => 'spng_city',
            'type' => 'text',
            'value' => (isset($address['spng_city'])) ? $this->form_validation->set_value('spng_city', $address['spng_city']) : '',
            'class' => 'form-control city',
        );
        $this->data['spng_state'] = (isset($address['spng_state'])) ? $address['spng_state'] : '';
        $this->data['spng_zipcode'] = array(
            'name' => 'spng_zipcode',
            'id' => 'spng_zipcode',
            'type' => 'text',
            'value' => (isset($address['spng_zipcode'])) ? $this->form_validation->set_value('spng_zipcode', $address['spng_zipcode']) : '',
            'class' => 'form-control',
        );
        $this->data['spng_country'] = (isset($address['spng_country'])) ? $address['spng_country'] : '';
        $this->data['spng_phone'] = array(
            'name' => 'spng_phone',
            'id' => 'spng_phone',
            'type' => 'text',
            'value' => (isset($address['spng_phone'])) ? $this->form_validation->set_value('spng_phone', $address['spng_phone']) : '',
            'class' => 'form-control',
        );
        $this->data['js'] = array(
            '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.maskedinput.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/js/select2.min.js"></script>'
        );
        $this->data['css'] = array(
            '<link href="' . base_url() . 'assets/css/select2.css" type="text/css" rel="stylesheet">',
        );
        $this->data['pageHeading'] = 'Address Details';
        $this->template->load('main', 'account', 'account/address_details', $this->data);
    }

    public function plans()
    {
        $this->data['pageHeading'] = 'Plans & Feature';
        $this->data['message'] = '';
        $this->data['css'] = array(
            '<link href="' . base_url() . 'assets/css/plans.css" rel="stylesheet">'
        );
        if ($this->ion_auth->in_group(array('business'))) {
            $this->data['plans'] = $this->plans_model->get_plans(2);
        } elseif ($this->ion_auth->in_group(array('students'))) {
            $this->data['plans'] = $this->plans_model->get_plans(3);
        } elseif ($this->ion_auth->in_group(array('ecommerce'))) {
            $this->data['plans'] = $this->plans_model->get_plans(4);
        } else {
            $this->data['plans'] = $this->plans_model->get_plans();
        }
        if (!$this->ion_auth->is_admin()) {
            if (check_account_expiration() == 1) {
                $this->data['got_expired'] = 1;
            }
        }

        $this->template->load('main', 'account', 'account/plans', $this->data);
    }

    public function get_state($country)
    {
        $result = $this->addressmodel->get_state_by_country($country);
        return $this->output->set_content_type('application/json')
                        ->set_output(json_encode($result));
    }

    public function account_upgrade_list()
    {
        if (!$this->ion_auth->is_admin()) {
            redirect('/', 'refresh');
        }
        $this->data['pageHeading'] = 'Accounts Upgrade';
        $this->data['message'] = '';
        $this->data['css'] = array(
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.responsive.css" type="text/css" rel="stylesheet">',
            '<style>td.child{text-align:left !important}</style>'
        );
        $this->data['js'] = array(
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/jquery.dataTables.min.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.bootstrap.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.responsive.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/js/readmore.min.js"></script>',
            '<script>
$(".plan_description").readmore({
speed: 75,
maxHeight: 0,
collapsedHeight:50,
moreLink: \'<a href="#">Read More</a>\',
lessLink: \'<a href="#">Less</a>\',
startOpen: false,

});
</script>'
        );
        $this->data['upgrade_list'] = $this->account_upgrade_model->get_upgrade_details();
//        var_dump($this->data['upgrade_list']);
        $this->template->load('main', 'account', 'account/upgradelist', $this->data);
    }

    public function payment_gateways()
    {
        $user_id = userdata('user_id');
        $gateways = $this->payment_gateways_model->get_payment_gateways($user_id);

        //validation rule
        $this->form_validation->set_rules('gateway', $this->lang->line('gateway_label'), 'required');
        $this->form_validation->set_rules('merchant_id', $this->lang->line('merchant_id_label'), 'required');
        $this->form_validation->set_rules('merchant_key', $this->lang->line('merchant_key_label'), 'required');
        $this->form_validation->set_rules('salt', $this->lang->line('salt_label'), 'required');
        $this->data['message'] = '';
        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                if (!empty($gateways)) {
                    $data = array(
                        'id' => $gateways->id,
                        'gateway' => $this->input->post('gateway'),
                        'merchant_id' => $this->input->post('merchant_id'),
                        'merchant_key' => $this->input->post('merchant_key'),
                        'salt' => $this->input->post('salt'),
                        'user_id' => $user_id
                    );

                    //check to see if we are updating the user
                    if ($this->payment_gateways_model->update_payment_gateways($data)) {
                        //redirect them back to the admin page if admin, or to the base url if non admin
                        $this->data['message'] = '<div class="alert alert-success">Payment Gateways Details Updated!</div>';
                    } else {
                        //redirect them back to the admin page if admin, or to the base url if non admin
                        $this->data['message'] = '<div class="alert alert-error">Error</div>';
                    }
                } else {
                    $data = array(
                        'gateway' => $this->input->post('gateway'),
                        'merchant_id' => $this->input->post('merchant_id'),
                        'merchant_key' => $this->input->post('merchant_key'),
                        'salt' => $this->input->post('salt'),
                        'user_id' => $user_id
                    );

                    if ($this->payment_gateways_model->set_payment_gateways($data)) {
                        $this->data['message'] = 'Payment Gateways Updated!';
                        redirect(site_url('account/payment_gateways'), 'refresh');
                    } else {
                        $this->data['message'] = '<div class="alert alert-error">Error</div>';
                    }
                }
            } else {
                $this->data['message'] = '<div class="alert alert-error">' . validation_errors() . '</div>';
            }
        }

        $this->data['gateway'] = array(
            'name' => 'gateway',
            'id' => 'gateway',
            'type' => 'text',
            'readonly' => TRUE,
            'value' => (isset($gateways->gateway)) ? $this->form_validation->set_value('gateway', $gateways->gateway) : 'PayU Money',
            'class' => 'form-control',
        );

        $this->data['merchant_id'] = array(
            'name' => 'merchant_id',
            'id' => 'merchant_id',
            'type' => 'text',
            'value' => (isset($gateways->merchant_id)) ? $this->form_validation->set_value('merchant_id', $gateways->merchant_id) : '',
            'class' => 'form-control',
        );

        $this->data['merchant_key'] = array(
            'name' => 'merchant_key',
            'id' => 'merchant_key',
            'type' => 'text',
            'value' => (isset($gateways->merchant_key)) ? $this->form_validation->set_value('merchant_key', $gateways->merchant_key) : '',
            'class' => 'form-control',
        );

        $this->data['salt'] = array(
            'name' => 'salt',
            'id' => 'salt',
            'type' => 'text',
            'value' => (isset($gateways->salt)) ? $this->form_validation->set_value('salt', $gateways->salt) : '',
            'class' => 'form-control',
        );

        $this->data['pageHeading'] = 'Payment Gateways';
        $this->template->load('main', 'account', 'account/payment_gateways', $this->data);
    }

}
