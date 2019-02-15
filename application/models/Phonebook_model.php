<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Phonebook_model extends CI_Model
{
    function phonenumber_list(){
		$result=$this->db->get('phonebooks');
		return $result->result();
	}
}