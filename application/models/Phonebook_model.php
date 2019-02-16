<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Phonebook_model extends CI_Model
{
//    get all phone number
    function phonenumber_list()
    {
        $user_id=$this->session->userdata['user_id'];
        $result = $this->db->where('phonebook_user_id',$user_id)->get('phonebooks');
        return $result->result();
    }

//    store phone number
    public function save_phone_number($data)
    {
        $result = $this->db->insert('phonebooks', $data);
        return $result;
    }

//    update phone number
    function update_phone_number()
    {
        $phonebook_id = $this->input->post('phonebook_id');
        $phonebook_name = $this->input->post('phonebook_name');
        $phonebook_phone = $this->input->post('phonebook_phone');
        $phonebook_address = $this->input->post('phonebook_address');
        $phonebook_updated_at = date("Y-m-d H:i:s");

        $this->db->set('phonebook_name',$phonebook_name);
        $this->db->set('phonebook_phone',$phonebook_phone);
        $this->db->set('phonebook_address',$phonebook_address);
        $this->db->set('phonebook_updated_at',$phonebook_updated_at);
        $this->db->where('phonebook_id', $phonebook_id);

        $result = $this->db->update('phonebooks');
        return $result;
    }


    function delete_phonebook(){
        $phonebook_id=$this->input->post('phonebook_id');
        $this->db->where('phonebook_id', $phonebook_id);
        $result=$this->db->delete('phonebooks');
        echo $this->db->last_query();
        exit;
        return $result;
    }

}
