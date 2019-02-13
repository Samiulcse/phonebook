<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Login_model', 'auth_model', true);
    }

    public function index()
    {

        $this->load->view('common/header');
        $this->load->view('auth/auth');
        $this->load->view('common/footer');

    }

    public function login_validation()
    {

        $this->load->view('auth/auth');

    }

    // regiter user

    public function register_user()
    {

        // $this->load->library('form_validation');

        // $this->form_validation->set_rules('user_name', 'User Name', 'required|min_length[5]|max_length[12]|is_unique[users.user_name]',
        //     array(
        //         'required' => 'You have not provided %s.',
        //         'is_unique' => 'This %s already exists.',
        //     ));

        // $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[users.user_email]');

        // $this->form_validation->set_rules('user_pass', 'Password', 'required|min_length[5]');

        // $this->form_validation->set_rules('user_confirm_pass', 'Password', 'required|matches[user_pass]');

        $config = array(
            array(
                'field' => 'user_name',
                'label' => 'Username',
                'rules' => 'required|min_length[5]|max_length[12]|is_unique[users.user_name]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                    'is_unique' => 'This %s already exists.',
                ),
            ),
            array(
                'field' => 'user_email',
                'label' => 'Username',
                'rules' => 'trim|required|valid_email|is_unique[users.user_email]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                    'is_unique' => 'This %s already exists.',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run()) {

            print_r($this->input->post());

        } else {
            
            $data= form_error('user_name')? form_error('user_name') : '';
            return $data;
            exit;

            redirect(base_url('#toregister'));

        }
    }

}
