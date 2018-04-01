<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class android extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login');
    }

    public function index()
    {
        
    }

    public function LoginApi()
    {
        $username_sa = $this->input->post('username_sa');
        $password_sa = $this->input->post('password_sa');
        $result = $this->dbandroid->LoginApi($username_sa, $password_sa);
        echo json_encode($result);
    }
}