<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Phonebook extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->have_session_user_data();

        $this->data['page_title'] = strtoupper($this->session->userdata['user_name']) . "'s Phonebook";

        $this->load->model('Phonebook_model', 'p_model', true);

    }

    private function have_session_user_data()
    {
        if (isset($this->session->userdata['user_name']) && isset($this->session->userdata['user_email'])) {
            // redirect(base_url('phonebook'));
        } else {
            redirect(base_url());
        }
    }

    public function index()
    {

        $this->data['css'] = [
            'demo' => '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/bootstrap.css" />',
            'style2' => ' <link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/jquery.dataTables.css" />',
            'animate-custom' => ' <link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/dataTables.bootstrap4.css " />',
        ];

        $this->data['js'] = [
            'bootstrap' => '<script type="text/javascript" src="' . base_url() . 'assets/js/bootstrap.js"></script>',
            'jquery.dataTables' => '<script type="text/javascript" src="' . base_url() . 'assets/js/jquery.dataTables.js"></script>',
            'dataTables.bootstrap4' => '<script type="text/javascript" src="' . base_url() . 'assets/js/dataTables.bootstrap4.js"></script>',
        ];

        $this->render_template('phonebook', $this->data);

    }

    // fetch all phonenumber

    public function phone_book_data()
    {
        $data = $this->p_model->phonenumber_list();
        echo json_encode($data);
    }

//    save phone number

    public function save()
    {
        $config = array(
            array(
                'field' => 'phonebook_user_id',
                'label' => 'User Id',
                'rules' => 'trim|xss_clean|required',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
            array(
                'field' => 'phonebook_name',
                'label' => 'Name',
                'rules' => 'trim|xss_clean|required|max_length[60]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
            array(
                'field' => 'phonebook_phone',
                'label' => 'Phone number',
                'rules' => 'trim|xss_clean|required|min_length[11]|max_length[11]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                    'is_unique' => 'This %s already exists.',
                ),
            ),
            array(
                'field' => 'phonebook_address',
                'label' => 'Address',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),

        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run()) {
            $data = [
                'phonebook_user_id' => $this->input->post('phonebook_user_id'),
                'phonebook_name' => $this->input->post('phonebook_name'),
                'phonebook_phone' => $this->input->post('phonebook_phone'),
                'phonebook_address' => $this->input->post('phonebook_address'),
                'phonebook_created_at' => date("Y-m-d H:i:s"),
            ];

            $data = $this->p_model->save_phone_number($data);

            if ($data) {
                $errors['common'] = 'Phone Number Already Exists';
                echo json_encode(['error' => $errors]);
            } else {
                echo json_encode($data);
            }

        } else {
            $errors['phonebook_name_error'] = form_error('phonebook_name') ? form_error('phonebook_name') : '';
            $errors['phonebook_phone_error'] = form_error('phonebook_phone') ? form_error('phonebook_phone') : '';
            $errors['phonebook_address_error'] = form_error('phonebook_address') ? form_error('phonebook_address') : '';
            echo json_encode(['error' => $errors]);
        }

    }

    //    save phone number

    public function update()
    {
        $config = array(
            array(
                'field' => 'phonebook_id',
                'label' => 'Phone Number Id',
                'rules' => 'trim|xss_clean|required',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
            array(
                'field' => 'phonebook_name',
                'label' => 'Name',
                'rules' => 'trim|xss_clean|required|max_length[60]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
            array(
                'field' => 'phonebook_phone',
                'label' => 'Phone number',
                'rules' => 'trim|xss_clean|required|min_length[11]|max_length[11]',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),
            array(
                'field' => 'phonebook_address',
                'label' => 'Address',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You have not provided %s.',
                ),
            ),

        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run()) {

            $data = $this->p_model->phonenumber_list($this->input->post('phonebook_id'));
            $phone_number = $data['phonebook_phone'];

            $data = $this->p_model->update_phone_number($phone_number);

            if ($data) {
                $errors['common'] = 'Phone Number Already Exists';
                echo json_encode(['error' => $errors]);
            } else {
                echo json_encode($data);
            }

        } else {
            $errors['phonebook_name_edit_error'] = form_error('phonebook_edit_name') ? form_error('phonebook_edit_name') : '';
            $errors['phonebook_phone_edit_error'] = form_error('phonebook_edit_phone') ? form_error('phonebook_edit_phone') : '';
            $errors['phonebook_address_edit_error'] = form_error('phonebook_edit_address') ? form_error('phonebook_edit_address') : '';

            echo json_encode(['error' => $errors]);
        }
    }

    public function delete()
    {
        $data = $this->p_model->delete_phonebook();
        echo json_encode($data);
    }

}
