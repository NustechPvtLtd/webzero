<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Example extends MX_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->library('facebook');
        $this->load->helper('url');
        $this->load->library(array('ion_auth', 'form_validation', 'template', 'visitor_count'));
        $this->data['title'] = $this->router->fetch_method();
        $this->data['pageMetaDescription'] = $this->router->fetch_class() . '-' . $this->router->fetch_method();
    }

    public function index()
    {
        //		$this->load->view('examples/start');
        $this->template->load('main', 'example', 'start', $this->data);
    }

    public function web_login()
    {
        $this->data['user'] = array();

        if ($this->facebook->logged_in()) {
            $user = $this->facebook->user();

            if ($user['code'] === 200) {
                unset($user['data']['permissions']);
                $this->data['user'] = $user['data'];
            }
        }

//		$this->load->view('examples/web', $data);
        $this->template->load('main', 'example', 'web', $this->data);
    }

    public function js_login()
    {
        //		$this->load->view('examples/js');
        $this->template->load('main', 'example', 'js', $this->data);
    }

    public function post()
    {
        header('Content-Type: application/json');

        $result = $this->facebook->publish_text($this->input->post('message'));
        echo json_encode($result);
    }

    public function logout()
    {
        $this->facebook->destroy_session();
        redirect('example/web_login', redirect);
    }
}
