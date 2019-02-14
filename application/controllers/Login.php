<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Login_model', 'auth_model', true);

        $this->have_session_user_data();

    }

    private function have_session_user_data()
    {
        if (isset($this->session->userdata['user_name']) && isset($this->session->userdata['user_email'])) {
            redirect(base_url('phonebook'));
        } 
    }

    public function index()
    {

        $this->load->view('common/header');
        $this->load->view('auth/auth');
        $this->load->view('common/footer');

    }

    public function login_validation()
    {

        $config = array(
            array(
                'field' => 'user_name',
                'label' => 'Username',
                'rules' => 'trim|xss_clean|required',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
            array(
                'field' => 'user_pass',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run()) {
            $user_name = $this->input->post('user_name');
            $user_pass = md5($this->input->post('user_pass'));

            $user_id = $this->auth_model->can_login($user_name , $user_pass);
            if ($user_id) {
                if ($this->set_session_data_user_info($user_id)) {
                    echo json_encode(['redirect' => base_url('phonebook')]);
                }
            } 

        } else {

            $errors['user_name'] = form_error('user_name') ? form_error('user_name') : '';
            $errors['user_pass'] = form_error('user_pass') ? form_error('user_pass') : '';
            echo json_encode(['error' => $errors]);

        }

    }

    // regiter user

    public function register_user()
    {
        $config = array(
            array(
                'field' => 'user_name',
                'label' => 'Username',
                'rules' => 'trim|xss_clean|required|min_length[2]|max_length[12]|is_unique[users.user_name]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                    'is_unique' => 'This %s already exists.',
                ),
            ),
            array(
                'field' => 'user_email',
                'label' => 'Email',
                'rules' => 'trim|required|xss_clean|valid_email|is_unique[users.user_email]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                    'is_unique' => 'This %s already exists.',
                ),
            ),
            array(
                'field' => 'user_pass',
                'label' => 'Password',
                'rules' => 'required|min_length[5]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
            array(
                'field' => 'user_confirm_pass',
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[user_pass]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run()) {
            $user_data = $this->input->post();
            unset($user_data['user_confirm_pass']);
            $user_data['user_pass'] = md5($this->input->post('user_pass'));
            $user_data['created_at'] = date("Y-m-d H:i:s");

            $user_id = $this->auth_model->add_new_user($user_data);
            if ($user_id) {
                if ($this->set_session_data_user_info($user_id)) {
                    echo json_encode(['redirect' => base_url('phonebook')]);
                }
            } else {
                redirect(base_url());
            }

        } else {

            $errors['user_name'] = form_error('user_name') ? form_error('user_name') : '';
            $errors['user_email'] = form_error('user_email') ? form_error('user_email') : '';
            $errors['user_pass'] = form_error('user_pass') ? form_error('user_pass') : '';
            $errors['user_confirm_pass'] = form_error('user_confirm_pass') ? form_error('user_confirm_pass') : '';
            echo json_encode(['error' => $errors]);

        }
    }

    // set session data
    private function set_session_data_user_info($user_id)
    {
        $current_user_data = $this->auth_model->get_current_user_data($user_id);
        if ($current_user_data) {
            $session_data = array(
                'user_name' => $current_user_data[0]->user_name,
                'user_email' => $current_user_data[0]->user_email,
                'user_id' => $current_user_data[0]->user_id,
            );
            $this->session->set_userdata($session_data);
            return true;
        } else {
            redirect(base_url());
        }

    }

}
