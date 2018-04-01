<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class apinya extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id_sa = $this->get('id_sa');
        if ($id_sa == '') {
            $pkl = $this->db->get('super_admin')->result();
        } else {
            $this->db->where('id_sa', $id_sa);
            $pkl = $this->db->get('super_admin')->result();
        }
        $this->response($pkl, 200);
    }

    function index_post() {
        $data = array(
            'id_sa'          => $this->post('id_sa'),
            'nama_sa'        => $this->post('nama_sa'),
            'username_sa'    => $this->post('username_sa'),
            'password_sa'    => md5($this->post('password_sa'))
        );
        if($param1 = 'new'){                
            $insert = $this->db->insert('super_admin', $data);
            if ($insert) {
                $this->response(['message'=>'Register berhasil', 'status'=> true, $data], 200);
            }
            else {
                $this->response(array('status' => 'fail', 502));
            }
        }

        else if($param1 = 'login_admin'){
            $username_sa = $this->post('username_sa');
            $password_sa = md5($this->post('password_sa'));

            if($username_sa != null && $username_sa != '' && $password_sa != null && $password_sa != ''){
                $user_login = $this->db>get('super_admin',array('username_sa' => $username_sa, 'password_sa' => $password_sa));
                if($user_login){

                    $session_text = $this->generateRandomString(32);
                    $this->super_admin->update($user_login->id_sa, array('session'=>$session_text));
                    $user_login->session = $session_text;
                    $this->response(['message'=>'Login berhasil, silahkan tunggu ....', 'status'=> true, 'super_admin'=> $user_login], 200);
                }
                else{
                    $this->response(['message'=>'Email atau password anda salah', 'status' => false, 'msuper_admin' => ''], 502);
                }
            }
            else{
                $this->response(['message'=>'Lengkapi data anda', 'status' => false, 'super_admin' => ''], 200);
            }
        }
    }

    function index_put() {
        $id_sa = $this->put('id_sa');
        $data = array(
                    'id_sa'          => $this->put('id_sa'),
                    'nama_sa'        => $this->put('nama_sa'),
                    'username_sa'    => $this->put('username_sa'),
                    'password_sa'    => $this->put('password_sa'));
        $this->db->where('id_sa', $id_sa);
        $update = $this->db->update('super_admin', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id_sa = $this->delete('id_sa');
        $this->db->where('id_sa', $id_sa);
        $delete = $this->db->delete('super_admin');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    public function adminnc_post($param1 = '', $param2 = '', $param3 = ''){
        if($param1 === 'new'){
            $data = array(
                'username_anc'   => $this->post('username_anc'),
                'password_anc'   => md5($this->post('password_anc')),
                'nama_anc'       => $this->post('nama_anc'),
                'alamat_anc'     => $this->post('alamat_anc'),
                'telp_anc'       => $this->post('telp_anc'),
                'id_sa'          => $this->post('id_sa'));
            
            $insert = $this->db->insert('admin_nc', $data);
            if ($username_anc != null && $password_anc != null && $nama_anc != null) {
                $this->response($data, 200);
            } 
            else {
                $this->response(array('status' => 'fail', 502));
            }
        }
        
        else if($param1 === 'login'){
            $username_anc = $this->post('username_nc');
            $password_anc = md5($this->post('password_anc'));

            if($username_anc != null && $username_anc != '' && $password_anc != null && $password_anc != ''){
                $user_login = $this->admin_nc->get_by(array('username_nc' => $username_nc, 'password_nc' => $password_nc));
                if($user_login != null && $user_login){

                    $session_text = $this->generateRandomString(32);
                    $this->admin_nc->update($user_login->id_sa, array('session'=>$session_text));
                    $user_login->session = $session_text;

                    $this->response(['message'=>'Login berhasil, silahkan tunggu ....', 'status'=>true, 'member'=> $user_login], 200);
                }
                else{
                    $this->response(['message'=>'Email atau password anda salah', 'status' => false, 'member' => ''], 200);
                }
            }
            else{
                $this->response(['message'=>'Lengkapi data anda', 'status' => false, 'member' => ''], 200);
            }
        }
        else{
            $this->response(['message'=>'Invalid', 'status' => false], 200);
        }
    }

    public function lahan_get($param1 = '', $param2 = ''){
        if($param1 == 'all'){
            $lahanData = $this->lahan_m->get_all();
            //echo print_r($lahanData);
            foreach ($lahanData as $key) {
                $this->addLahanDetail($key);
            }
            $this->response($lahanData, 200);
        }else if( $param2 == 'detail' && (int)$param1 > 0){
            $lahanData = $this->lahan_m->get($param1);
            $this->addLahanDetail($lahanData);
            $this->response($lahanData, 200);
        }else{
            echo 'invalid';
        }

    }





    
}
?>