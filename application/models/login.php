<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function loginsa($username_sa, $password_sa)
    {
        $username_sa = $this->input->post('username_sa');
        $password_sa = $this->input->post('password_sa');      
        
        $table = 'super_admin';
        $result = $this->db->query("SELECT * FROM $table WHERE username_sa = '$username_sa' AND password_sa = '$password_sa'");
        return $result->result();
    }

    function loginanc($username_anc, $password_anc)
    {
        $username_anc = $this->input->post('username_anc');
        $password_anc = $this->input->post('password_anc');      
        
        $table = 'admin_nc';
        $result = $this->db->query("SELECT * FROM $table WHERE username_anc = '$username_anc' AND password_anc = '$password_anc'");
        return $result->result();
    }

    function loginuser($username_user, $password_user)
    {
        $username_user = $this->input->post('username_user');
        $password_user = $this->input->post('password_user');      
        
        $table = 'user';
        $result = $this->db->query("SELECT * FROM $table WHERE username_user = '$username_user' AND password_user = '$password_user'");
        return $result->result();
    }
}