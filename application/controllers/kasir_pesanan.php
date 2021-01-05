<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	

class Kasir_pesanan extends CI_Controller
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
		//$data_menu['menu'] = $this->mdl_restoran->data_incoming();
		
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_kasir_tambah_pesanan',array(),true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	
	function tambah_pesanan()
	{
		echo $_SESSION['id_pengguna'],$_POST["meja"];
		$data_post=array(  
                'id_pengguna' => $_SESSION['id_pengguna'],
				'meja'		=>  $_POST["meja"]
            );  
			
       	$tambah = $this->mdl_restoran->tambah_pesanan($data_post,'pesanan');  
		$ambil_id = $this->db->insert_id();
		
		echo $ambil_id;
		redirect(site_url('kasir_pesanan/pesan/' . $ambil_id));
	}
	
	
	
	function pesan($ambil_id)
	{
		//echo $ambil_id;
		$level['level'] = $_SESSION['level'];
		$menu = $this->mdl_restoran->data_menu();
		$kodeunik = $this->mdl_restoran->code_cs();
		$data_menu = array(
			'menu' => $menu,
			'id_pesanan' => $ambil_id,
			'kode' => $kodeunik
		);
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_kasir_pesanan',$data_menu,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	
	function simpan_pesanan()
	{
		$dat_pesanan=$_POST['jml_pesanan'];
		$id_menu=$_POST['id_menu'];
		$nm = $dat_pesanan;
		$result = array();
		foreach($id_menu AS $key => $val)
		{
		 	if($dat_pesanan[$val] > 0)
			{
					$result[] = array(
					"id_pesanan" => $_POST['id_pesanan'],
					" id_menu" => $_POST['id_menu'][$key],
					"kode " => $_POST["kode"],
					"jumlah" => $_POST['jml_pesanan'][$val]
					);
			}
		}
		$this->mdl_restoran->post_add($result);
		$pesan ="<div class='alert alert-success alert-dismissible fade show'>
        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        	Data pesanan berhasil disimpan </div>";
		$this->session->set_flashdata('message',$pesan);
		redirect(base_url().'kasir_pesanan');
		
		
		echo var_dump($result);
	}
	
	function data_pesanan_koki()
	{
		$level['level'] = $_SESSION['level'];
		$menu = $this->mdl_restoran->data_pesanan_koki();
		$data_menu=array(
			'id_pesanan' => $id_pesanan,
			'menu' => $menu
		);
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_pesanan_koki',$data_menu,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	function ubah_status_pesanan_koki($id){
		
			$data_post=array(  
					'status_koki' => 'T'
				);
				
            $this->mdl_restoran->ubah_status_pesanan_koki($id,$data_post);
			$pesan ="<div class='alert alert-success alert-dismissible fade show'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					Data berhasil diubah</div>";
			$this->session->set_flashdata('message',$pesan);
			redirect('kasir_pesanan/data_pesanan_koki'); 
    }
	
	function data_pesanan_pelayan()
	{
		$level['level'] = $_SESSION['level'];
		$menu = $this->mdl_restoran->data_pesanan_pelayan();
		$data_menu=array(
			'id_pesanan' => $id_pesanan,
			'menu' => $menu
		);
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_pesanan_pelayan',$data_menu,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	function ubah_status_pesanan_pelayan($id){
		
			$data_post=array(  
					'status_pelayan' => 'T'
				);
				
            $this->mdl_restoran->ubah_status_pesanan_pelayan($id,$data_post);
			$pesan ="<div class='alert alert-success alert-dismissible fade show'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					Data berhasil diubah</div>";
			$this->session->set_flashdata('message',$pesan);
			redirect('kasir_pesanan/data_pesanan_pelayan'); 
    }
}