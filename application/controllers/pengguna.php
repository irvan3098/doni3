<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	

class Pengguna extends CI_Controller
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
		$level['level'] = $_SESSION['level'];
		$data_admin["data"] = $this->mdl_restoran->data_pengguna();
		
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_pengguna',$data_admin,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	
	function tambah()
	{
		$data = array(
					'nama_pengguna' => $_POST["nama"],
					'level' => $_POST["level"],
					'password' => $_POST["password"]
			);
		$this->mdl_restoran->tambah($data,'pengguna');
		$pesan ="<div class='alert alert-success alert-dismissible fade show'>
        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        	Data berhasil disimpan
        </div>";
		$this->session->set_flashdata('message',$pesan);
		redirect(site_url('pengguna'));
	}
	
	
	function hapus($id_pengguna){  
        $id= $_POST["id_pengguna"];
		$this->mdl_restoran->hapus_pengguna($id,'pengguna');  
		$pesan ="<div class='alert alert-success alert-dismissible fade show'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					Data berhasil dihapus</div>";
		$this->session->set_flashdata('message',$pesan);
		redirect(base_url().'pengguna'); //untuk kembali ke halaman home  
				
    }
	function ubah($id_pengguna){
		$id = $_POST["id_pengguna"];
		$data=array(
			'nama_pengguna' => $_POST["unama"],
			'level' => $_POST["ulevel"],
			'password' => $_POST["upassword"]
		);
				
    	$this->mdl_restoran->ubah_pengguna($id,$data);
		$pesan ="<div class='alert alert-success alert-dismissible fade show'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					Data berhasil diubah</div>";
		$this->session->set_flashdata('message',$pesan);
		redirect('pengguna'); 
        
    }
}