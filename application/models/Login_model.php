<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
    // add new user data

    public function add_new_user($user_data)
    {
        $this->db->insert('users', $user_data);

        return $user_id = $this->db->insert_id();

    }

    // user login permission check

    public function can_login($user_name , $user_pass){

        $result = $this->db->select('*')->from('users')->where('user_name',$user_name)->where('user_pass',$user_pass)->get()->result();

        return $result[0]->user_id;
    }

    // get current user information

    public function get_current_user_data($user_id)
    {
        $result = $this->db->select('*')->from('users')->where('user_id', $user_id)->get()->result();

        return $result;
    }
}
