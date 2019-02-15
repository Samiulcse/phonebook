<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Phonebook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->have_session_user_data();

        $this->load->model('Phonebook_model', 'p_model', true);

    }

     private function have_session_user_data()
    {
        if (isset($this->session->userdata['user_name']) && isset($this->session->userdata['user_email'])) {
            // redirect(base_url('phonebook'));
        } else{
            redirect(base_url());
        }
    }

    public function index(){
        $data['title'] = strtoupper($this->session->userdata['user_name'])."'s Phonebook";
        
        $this->load->view('common/header',$data);
        $this->load->view('phonebook');
        $this->load->view('common/footer');
    }

    // All Number data

    function phone_book_data(){
		$data=$this->p_model->product_list();
		echo json_encode($data);
    }
    
}