<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form');
		$this->load->library('session');
		$this->load->model('mdl_restoran');
		
	}
	
	function index()
	{
		$this->load->view('v_login',array());
	}
	
	function cek_login()
	{
		$this->load->model('mdl_restoran');
		$user = $_POST['username'];
        $pass = $_POST['password'];
			
		$data = $this->mdl_restoran->login($user,$pass);
		
		if (empty($data)) {
			$pesan ="<div class='alert alert-denger alert-dismissible fade show'>
        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        	Username dan password salah
        </div>";
			$this->session->set_flashdata('message',$pesan);
			header("Location: ".site_url('login'));
			
		}else{
			
			foreach ($data as $row)
			{
				if($row["level"] == 'admin')
				{
					$_SESSION['id_pengguna'] = $row["id_pengguna"];
					$_SESSION['nama_pengguna'] = $row["nama_pengguna"];
					$_SESSION['level'] = $row["level"];
					$_SESSION['status'] = true; 
					header("Location: ".site_url('menu'));
				}elseif($row["level"] == 'kasir')
				{
					$_SESSION['id_pengguna'] = $row["id_pengguna"];
					$_SESSION['nama_pengguna'] = $row["nama_pengguna"];
					$_SESSION['level'] = $row["level"];
					$_SESSION['status'] = true; 
					header("Location: ".site_url('kasir_pesanan'));
				}elseif($row["level"] == 'owner')
				{
					$_SESSION['id_pengguna'] = $row["id_pengguna"];
					$_SESSION['nama_pengguna'] = $row["nama_pengguna"];
					$_SESSION['level'] = $row["level"];
					$_SESSION['status'] = true; 
					header("Location: ".site_url('owner_menu'));
				}elseif($row["level"] == 'koki')
				{
					$_SESSION['id_pengguna'] = $row["id_pengguna"];
					$_SESSION['nama_pengguna'] = $row["nama_pengguna"];
					$_SESSION['level'] = $row["level"];
					$_SESSION['status'] = true; 
					header("Location: ".site_url('kasir_pesanan/data_pesanan_koki'));
				}elseif($row["level"] == 'pelayan')
				{
					$_SESSION['id_pengguna'] = $row["id_pengguna"];
					$_SESSION['nama_pengguna'] = $row["nama_pengguna"];
					$_SESSION['level'] = $row["level"];
					$_SESSION['status'] = true; 
					header("Location: ".site_url('kasir_pesanan/data_pesanan_pelayan'));
				}
			}
		}
	}
	
	function logout()
		{
			session_destroy();
			header("Location: ".site_url());
		}
}
?>