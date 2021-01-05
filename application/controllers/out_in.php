<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	

class Out_in extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form');
		$this->load->library('session');
		$this->load->model('mdl_restoran');
		
	}
	
	function outgoing()
	{
		$level['level'] = $_SESSION['level'];
		$data_menu= $this->mdl_restoran->data_menu();
		$data_out = $this->mdl_restoran->data_outgoing();
		$kodeunik = $this->mdl_restoran->code_out();
		$data=array(
			'menu' => $data_menu,
			'data_out' => $data_out,
			'kode' => $kodeunik
		);
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_admin_outgoing',$data,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	
	function incoming()
	{
		$level['level'] = $_SESSION['level'];
		$data_menu= $this->mdl_restoran->data_menu();
		$data_out = $this->mdl_restoran->data_incoming();
		$kodeunik = $this->mdl_restoran->code_in();
		$data=array(
			'menu' => $data_menu,
			'data_out' => $data_out,
			'kode' => $kodeunik
		);
		
		
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_incoming',$data,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	
	function tambah_out()
	{
		$data = array(
					'id_menu' => $_POST["id_menu"],
					'kode' => $_POST["kode"],
					'tgl_out' => $_POST["tgl"],
					'jumlah_out' => $_POST["jumlah"],
					'deskripsi_out' => $_POST["deskripsi"]
			);
			$this->mdl_restoran->tambah($data,'outgoing');
		$pesan ="<div class='alert alert-success alert-dismissible fade show'>
        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        	Data berhasil disimpan
        </div>";
		$this->session->set_flashdata('message',$pesan);
		redirect(site_url('out_in/outgoing'));
	}
	
	function tambah_in()
	{
		$data = array(
					'id_menu' => $_POST["id_menu"],
					'kode'	=> $_POST["kode"],
					'tgl_in' => $_POST["tgl"],
					'jumlah_in' => $_POST["jumlah"]
			);
			$this->mdl_restoran->tambah($data,'incoming');
		$pesan ="<div class='alert alert-success alert-dismissible fade show'>
        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        	Data berhasil disimpan
        </div>";
		$this->session->set_flashdata('message',$pesan);
		redirect(site_url('out_in/incoming'));
	}
	
	
	function hapus_out($id){  
   		$row = $this->mdl_restoran->get_by_id_out($id);

		if($row){
			$this->mdl_restoran->hapus_out($id,'outgoing');  
			$pesan ="<div class='alert alert-success alert-dismissible fade show'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					Data berhasil dihapus</div>";
			$this->session->set_flashdata('message',$pesan);
			redirect(base_url().'out_in/outgoing'); //untuk kembali ke halaman home    
		}else{
			$this->session->set_flashdata('message', "<div style='color:#dd4b39;'>Data tidak ditemukan.</div>");
			redirect(base_url().'out_in/outgoing'); //untuk kembali ke halaman home    
		}
		
		
    }
	function hapus_in($id){  
   		$row = $this->mdl_restoran->get_by_id_in($id);

		if($row){
			$this->mdl_restoran->hapus_in($id,'incoming');  
			$pesan ="<div class='alert alert-success alert-dismissible fade show'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					Data berhasil dihapus</div>";
			$this->session->set_flashdata('message',$pesan);
			redirect(base_url().'out_in/incoming'); //untuk kembali ke halaman home    
		}else{
			$this->session->set_flashdata('message', "<div style='color:#dd4b39;'>Data tidak ditemukan.</div>");
			redirect(base_url().'out_in/incoming'); //untuk kembali ke halaman home    
		}
		
		
    }
	function ubah($id){
		if($_POST){  
            //$tanggal = date("y-m-d");
			$data_post=array(  
					'nama_menu' => $_POST["unama_menu"],
					'deskripsi' => $_POST["udeskripsi"],
					'harga' => $_POST["uharga"],
					'stock' => $_POST["ustock"],
					'gambar' => $_FILES['ugambar']['name']
				);
				
            $this->mdl_restoran->ubah($id,$data_post);
			$pesan ="<div class='alert alert-success alert-dismissible fade show'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					Data berhasil diubah</div>";
			$this->session->set_flashdata('message',$pesan);
			redirect('admin_incoming'); 
        }
		  
        $data_menu['ubah_menu']=$this->mdl_restoran->get_by_id_ubah($id);  
        $konten =$this->load->view('v_ubah_incoming',$data_menu,true);
		$sidebar = $this->load->view('sidebar',array(),true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
		
		
    }
}