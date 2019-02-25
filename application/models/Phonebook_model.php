<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Phonebook_model extends CI_Model
{
//    get all phone number
    public function phonenumber_list($id = null)
    {
        if ($id) {
            $user_id = $this->session->userdata['user_id'];
            $result = $this->db->where('phonebook_user_id', $user_id)->where('phonebook_id', $id)->get('phonebooks');
            return $result->row_array();
        }
        $user_id = $this->session->userdata['user_id'];
        $result = $this->db->where('phonebook_user_id', $user_id)->get('phonebooks');
        return $result->result_array();
    }

//    store phone number
    public function save_phone_number($data)
    {
        $allData = $this->phonenumber_list();
        $phone_number = $data['phonebook_phone'];

        if ($this->searchForMatch($phone_number, $allData)) {
            return true;
        } else {
            $result = $this->db->insert('phonebooks', $data);
            return false;
        }

    }

    // search for unique number for current user
    public function searchForMatch($phone_number, $allData)
    {
        foreach ($allData as $key => $val) {
            if ($val['phonebook_phone'] == $phone_number) {
                return true;
            }
        }
        return false;
    }

//    update phone number
    public function update_phone_number($phone)
    {
        $phonebook_id = $this->input->post('phonebook_id');
        $phonebook_name = $this->input->post('phonebook_name');
        $phonebook_phone = $this->input->post('phonebook_phone');
        $phonebook_address = $this->input->post('phonebook_address');
        $phonebook_updated_at = date("Y-m-d H:i:s");
        if ($phone == $phonebook_phone) {
            $this->db->set('phonebook_name', $phonebook_name);
            $this->db->set('phonebook_phone', $phonebook_phone);
            $this->db->set('phonebook_address', $phonebook_address);
            $this->db->set('phonebook_updated_at', $phonebook_updated_at);
            $this->db->where('phonebook_id', $phonebook_id);

            $result = $this->db->update('phonebooks');
            return false;
        } else {
            $allData = $this->phonenumber_list();
            if ($this->searchForMatch($phonebook_phone, $allData)) {
                return true;
            } else {
                $this->db->set('phonebook_name', $phonebook_name);
                $this->db->set('phonebook_phone', $phonebook_phone);
                $this->db->set('phonebook_address', $phonebook_address);
                $this->db->set('phonebook_updated_at', $phonebook_updated_at);
                $this->db->where('phonebook_id', $phonebook_id);

                $result = $this->db->update('phonebooks');
                return false;
            }
        }
    }

    public function delete_phonebook()
    {
        $phonebook_id = $this->input->post('phonebook_id');
        $this->db->where('phonebook_id', $phonebook_id);
        $result = $this->db->delete('phonebooks');
        return $result;
    }

}
