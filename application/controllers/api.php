<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class api extends REST_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login');
    }

    public function index_get($param1='') {
        if ($param1 =='super_admin'){
            $id_sa = $this->get('id_sa');
            if ($id_sa == '') {
                $lihat = $this->db->get('super_admin')->result();
            } else {
                $this->db->where('id_sa', $id_sa);
                $lihat = $this->db->get('super_admin')->result();
            }
            $this->response($lihat, 200);
        }
        
        else if ($param1 =='admin_nc'){
            $id_anc = $this->get('id_anc');
            if ($id_anc == '') {
                $lihat = $this->db->get('admin_nc')->result();
            } else {
                $this->db->where('id_anc', $id_anc);
                $lihat = $this->db->get('admin_nc')->result();
            }
            $this->response($lihat, 200);
        }

        else if ($param1 =='user'){
            $id_user = $this->get('id_user');
            if ($id_user == '') {
                $lihat = $this->db->get('user')->result();
            } else {
                $this->db->where('id_user', $id_user);
                $lihat = $this->db->get('user')->result();
            }
            $this->response($lihat, 200);
        }

        else if ($param1 =='timbangan'){
            $id_user = $this->get('id_user');
            if ($id_user == '') {
                $lihat = $this->db->get('timbangan')->result();
            } else {
                $this->db->where('id_user', $id_user);
                $lihat = $this->db->get('timbangan')->result();
            }
            $this->response($lihat, 200);
        }

        else if ($param1 =='jadwal'){
            $id_user = $this->get('id_user');
            if ($id_user == '') {
                $lihat = $this->db->get('jadwal')->result();
            } else {
                $this->db->where('id_user', $id_user);
                $lihat = $this->db->get('jadwal')->result();
            }
            $this->response($lihat, 200);
        }
    }

    public function index_post($param1='', $param2='') {
        if ($param1 == 'super_admin'){
            $id_sa          = $this->post('id_sa');
            $nama_sa        = $this->post('nama_sa');
            $username_sa    = $this->post('username_sa');
            $password_sa    = md5($this->post('password_sa'));

            if ($param2 == 'new'){
                $data = array(
                    'id_sa'          => $this->post('id_sa'),
                    'nama_sa'        => $this->post('nama_sa'),
                    'username_sa'    => $this->post('username_sa'),
                    'password_sa'    => md5($this->post('password_sa'))
                );
                if($nama_sa != null && $username_sa != null && $password_sa != null){               
                    $insert = $this->db->insert('super_admin', $data);
                    if ($insert) {
                        $this->response(['message'=>'Register berhasil', 'status'=> true, $data], 200);
                    }
                    else {
                        $this->response(array(['message'=>'Register tidak berhasil, silahkan coba lagi', 'status' => false], 502));
                    }
                }
                else {
                    $this->response(['message'=>'Mohon isi data dengan lengkap...', 'status' => false], 200);
                }
            }

            else if ($param2 == 'login') {
                if($username_sa != null && $username_sa !='' && $password_sa != null && $password_sa != ''){
                    $result = $this->login->loginsa($username_sa, $password_sa);
                    if ($result) {
                        $this->response(['message'=>'Login berhasil', 'status'=> true, $result], 200);
                    }
                    else {
                        $this->response(array(['message'=>'Login tidak berhasil, periksa username dan password anda', 'status' => false], 502));
                    }
                }
                else {
                    $this->response(['message'=>'Mohon isi data dengan lengkap...', 'status' => false], 200);
                }
            }
        }
        
        else if ($param1 == 'admin_nc'){
            $id_anc         = $this->post('id_anc');
            $nama_anc       = $this->post('nama_anc');
            $username_anc   = $this->post('username_anc');
            $password_anc   = md5($this->post('password_anc'));
            $alamat_anc     = $this->post('alamat_anc');
            $telp_anc       = $this->post('telp_anc');
            $status_anc     = $this->post('status_anc');
            $foto_profil    = $this->post('foto_profil');
            $foto_bukti_nc  = $this->post('foto_bukti_nc');
            $id_sa          = $this->post('id_sa');

            if ($param2 == 'new'){
                $data = array(
                    'id_anc'         => $this->post('id_anc'),
                    'nama_anc'       => $this->post('nama_anc'),
                    'username_anc'   => $this->post('username_anc'),
                    'password_anc'   => md5($this->post('password_anc')),
                    'alamat_anc'     => $this->post('alamat_anc'),
                    'telp_anc'       => $this->post('telp_anc'),
                    'status_anc'     => $this->post('status_anc'),
                    'foto_profil'    => $this->post('foto_profil'),
                    'foto_bukti_nc'  => $this->post('foto_bukti_nc'),
                    'id_sa'          => $this->post('id_sa')
                );
                if($nama_anc != null && $username_anc != null && $password_anc != null && $alamat_anc != null && $telp_anc != null && $id_sa != null){               
                    $insert = $this->db->insert('admin_nc', $data);
                    if ($insert) {
                        $this->response(['message'=>'Register berhasil', 'status'=> true, $data], 200);
                    }
                    else {
                        $this->response(['message'=>'Register tidak berhasil, silahkan coba lagi', 'status' => false], 502);
                    }
                }
                else {
                    $this->response(['message'=>'Mohon isi data dengan lengkap...', 'status' => false], 200);
                }
            }

            else if ($param2 == 'login') {
                if($username_anc != null && $username_anc !='' && $password_anc != null && $password_anc != ''){
                    $result = $this->login->loginanc($username_anc, $password_anc);
                    if ($result) {
                        $this->response(['message'=>'Login berhasil', 'status'=> true, $result], 200);
                    }
                    else {
                        $this->response(array(['message'=>'Login tidak berhasil, periksa username dan password anda', 'status' => false], 502));
                    }
                }
                else {
                    $this->response(['message'=>'Mohon isi data dengan lengkap...', 'status' => false], 200);
                }
            }
        }

        else if ($param1 == 'user'){
            $id_user         = $this->post('id_user');
            $nama_user       = $this->post('nama_user');
            $username_user   = $this->post('username_user');
            $password_user   = md5($this->post('password_user'));
            $alamat_user     = $this->post('alamat_user');
            $telp_user       = $this->post('telp_user');
            $status_user     = $this->post('status_user');
            $id_anc          = $this->post('id_anc');

            if ($param2 == 'new'){
                $data = array(
                    'id_user'         => $this->post('id_user'),
                    'nama_user'       => $this->post('nama_user'),
                    'username_user'   => $this->post('username_user'),
                    'password_user'   => md5($this->post('password_user')),
                    'alamat_user'     => $this->post('alamat_user'),
                    'telp_user'       => $this->post('telp_user'),
                    'status_user'     => $this->post('status_user'),
                    'id_anc'          => $this->post('id_anc')
                );
                if($nama_user != null && $username_user != null && $password_user != null && $alamat_user != null && $telp_user != null && $id_anc != null){               
                    $insert = $this->db->insert('user', $data);
                    if ($insert) {
                        $this->response(['message'=>'Register berhasil', 'status'=> true, $data], 200);
                    }
                    else {
                        $this->response(['message'=>'Register tidak berhasil, silahkan coba lagi', 'status' => false], 502);
                    }
                }
                else {
                    $this->response(['message'=>'Mohon isi data dengan lengkap...', 'status' => false], 200);
                }
            }

            else if ($param2 == 'login') {
                if($username_user != null && $username_user !='' && $password_user != null && $password_user != ''){
                    $result = $this->login->loginuser($username_user, $password_user);
                    if ($result) {
                        $this->response(['message'=>'Login berhasil', 'status'=> true, $result], 200);
                    }
                    else {
                        $this->response(array(['message'=>'Login tidak berhasil, periksa username dan password anda', 'status' => false], 502));
                    }
                }
                else {
                    $this->response(['message'=>'Mohon isi data dengan lengkap...', 'status' => false], 200);
                }
            }
        }

        else if ($param1 == 'timbangan'){
            $id_user          = $this->post('id_user');
            $tanggal          = $this->post('tanggal');
            $berat_badan      = $this->post('berat_badan');
            $lemak_tubuh      = $this->post('lemak_tubuh');
            $kadar_air        = $this->post('kadar_air');
            $masa_otot        = $this->post('masa_otot');
            $rating_fisik     = $this->post('rating_fisik');
            $usia_sel         = $this->post('usia_sel');
            $kepadatan_tulang = $this->post('kepadatan_tulang');
            $lemak_perut      = $this->post('lemak_perut');
            $bmr              = $this->post('bmr');

            if ($param2 == 'new'){
                $data = array(
                    'id_user'           => $this->post('id_user'),
                    'tanggal'           => $this->post('tanggal'),
                    'berat_badan'       => $this->post('berat_badan'),
                    'lemak_tubuh'       => $this->post('lemak_tubuh'),
                    'kadar_air'         => $this->post('kadar_air'),
                    'masa_otot'         => $this->post('masa_otot'),
                    'rating_fisik'      => $this->post('rating_fisik'),
                    'usia_sel'          => $this->post('usia_sel'),
                    'kepadatan_tulang'  => $this->post('kepadatan_tulang'),
                    'lemak_perut'       => $this->post('lemak_perut'),
                    'bmr'               => $this->post('bmr')
                );
                if($id_user != null){               
                    $insert = $this->db->insert('timbangan', $data);
                    if ($insert) {
                        $this->response(['message'=>'Register berhasil', 'status'=> true, $data], 200);
                    }
                    else {
                        $this->response(['message'=>'Register tidak berhasil, silahkan coba lagi', 'status' => false], 502);
                    }
                }
                else {
                    $this->response(['message'=>'Mohon isi data dengan lengkap...', 'status' => false], 200);
                }
            }
        }

        else if ($param1 == 'jadwal'){
            $id_user     = $this->post('id_user');
            $tanggal     = $this->post('tanggal');
            $status      = $this->post('status');

            if ($param2 == 'new'){
                $data = array(
                    'id_user'   => $this->post('id_user'),
                    'tanggal'   => $this->post('tanggal'),
                    'status'    => $this->post('status')
                );
                if($id_user != null){               
                    $insert = $this->db->insert('jadwal', $data);
                    if ($insert) {
                        $this->response(['message'=>'Register berhasil', 'status'=> true, $data], 200);
                    }
                    else {
                        $this->response(['message'=>'Register tidak berhasil, silahkan coba lagi', 'status' => false], 502);
                    }
                }
                else {
                    $this->response(['message'=>'Mohon isi data dengan lengkap...', 'status' => false], 200);
                }
            }
        }
    }

    public function index_put($param1 ='') {    
        if($param1 == 'super_admin'){
            $id_sa = $this->put('id_sa');
            $data = array(
                    'id_sa'          => $this->put('id_sa'),
                    'nama_sa'        => $this->put('nama_sa'),
                    'username_sa'    => $this->put('username_sa'),
                    'password_sa'    => md5($this->put('password_sa'))
                );
            $this->db->where('id_sa', $id_sa);
            $update = $this->db->update('super_admin', $data);
            if ($update) {
                $this->response(['message'=>'Updated!', 'status'=> true, $data], 200);
            }
            else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }

        else if($param1 == 'admin_nc'){
            $id_anc = $this->put('id_anc');
            $data = array(
                'id_anc'         => $this->put('id_anc'),
                'nama_anc'       => $this->put('nama_anc'),
                'username_anc'   => $this->put('username_anc'),
                'password_anc'   => md5($this->put('password_anc')),
                'alamat_anc'     => $this->put('alamat_anc'),
                'telp_anc'       => $this->put('telp_anc'),
                'status_anc'     => $this->put('status_anc'),
                'foto_profil'    => $this->put('foto_profil'),
                'foto_bukti_nc'  => $this->put('foto_bukti_nc'),
                'id_sa'          => $this->put('id_sa')
            );
            $this->db->where('id_anc', $id_anc);
            $update = $this->db->update('admin_nc', $data);
            if ($update) {
                $this->response(['message'=>'Updated!', 'status'=> true, $data], 200);
            }
            else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }

        else if($param1 == 'user'){
            $id_user = $this->put('id_user');
            $data = array(
                'id_user'         => $this->put('id_user'),
                'nama_user'       => $this->put('nama_user'),
                'username_user'   => $this->put('username_user'),
                'password_user'   => md5($this->put('password_user')),
                'alamat_user'     => $this->put('alamat_user'),
                'telp_user'       => $this->put('telp_user'),
                'status_user'     => $this->put('status_user'),
                'id_anc'          => $this->put('id_anc')
            );
            $this->db->where('id_user', $id_user);
            $update = $this->db->update('user', $data);
            if ($update) {
                $this->response(['message'=>'Updated!', 'status'=> true, $data], 200);
            }
            else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }

        else if($param1 == 'timbangan'){
            $id_user = $this->put('id_user');
            $data = array(
                'id_user'           => $this->put('id_user'),
                'tanggal'           => $this->put('tanggal'),
                'berat_badan'       => $this->put('berat_badan'),
                'lemak_tubuh'       => $this->put('lemak_tubuh'),
                'kadar_air'         => $this->put('kadar_air'),
                'masa_otot'         => $this->put('masa_otot'),
                'rating_fisik'      => $this->put('rating_fisik'),
                'usia_sel'          => $this->put('usia_sel'),
                'kepadatan_tulang'  => $this->put('kepadatan_tulang'),
                'lemak_perut'       => $this->put('lemak_perut'),
                'bmr'               => $this->put('bmr')
            );
            $this->db->where('id_user', $id_user);
            $update = $this->db->update('timbangan', $data);
            if ($update) {
                $this->response(['message'=>'Updated!', 'status'=> true, $data], 200);
            }
            else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }

        else if($param1 == 'jadwal'){
            $id_user = $this->put('id_user');
            $data = array(
                'id_user'   => $this->put('id_user'),
                'tanggal'   => $this->put('tanggal'),
                'status'    => $this->put('status')
            );
            $this->db->where('id_user', $id_user);
            $update = $this->db->update('jadwal', $data);
            if ($update) {
                $this->response(['message'=>'Updated!', 'status'=> true, $data], 200);
            }
            else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }
    }

    public function index_delete($param1='') {
        if($param1 == 'super_admin'){
            $id_sa = $this->delete('id_sa');
            $this->db->where('id_sa', $id_sa);
            $delete = $this->db->delete('super_admin');
            if ($delete) {
                $this->response(['message'=>'Deleted!', 'status'=> true], 200);
            } else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }
        
        else if($param1 == 'admin_nc'){
            $id_anc = $this->delete('id_anc');
            $this->db->where('id_anc', $id_anc);
            $delete = $this->db->delete('admin_nc');
            if ($delete) {
                $this->response(['message'=>'Deleted!', 'status'=> true], 200);
            } else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }
        
        else if($param1 == 'user'){
            $id_user = $this->delete('id_user');
            $this->db->where('id_user', $id_user);
            $delete = $this->db->delete('user');
            if ($delete) {
                $this->response(['message'=>'Deleted!', 'status'=> true], 200);
            } else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }
        
        else if($param1 == 'timbangan'){
            $id_user = $this->delete('id_user');
            $this->db->where('id_user', $id_user);
            $delete = $this->db->delete('timbangan');
            if ($delete) {
                $this->response(['message'=>'Deleted!', 'status'=> true], 200);
            } else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }  

        else if($param1 == 'jadwal'){
            $id_user = $this->delete('id_user');
            $this->db->where('id_user', $id_user);
            $delete = $this->db->delete('jadwal');
            if ($delete) {
                $this->response(['message'=>'Deleted!', 'status'=> true], 200);
            } else {
                $this->response(['message'=>'Update failed!', 'status' => false], 502);
            }
        }  
    }
    
    
}

?>