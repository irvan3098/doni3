<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	

class Menu extends CI_Controller
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
		$data_menu['menu'] = $this->mdl_restoran->data_menu();
		
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_admin_menu',$data_menu,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	
	function tambah()
	{
		$config = array(
			'upload_path' => './images/makanan/',
			'allowed_types' => 'jpeg|jpg|png',
			'max_size' => '2048',
			'max_width' => '2000',
			'max_height' => '2000'
 		);
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$this->session->set_flashdata('message', "<div style='color:#ff0000;'>" . $this->upload->display_errors() . "</div>");
			redirect(site_url('admin_incoming'));
		} else {
			$file = $this->upload->data();
			$data = array(
					'nama_menu' => $_POST["nama_menu"],
					'deskripsi' => $_POST["deskripsi"],
					'harga' => $_POST["harga"],
					'gambar' => $_FILES['gambar']['name']
			);
			$this->mdl_restoran->tambah($data,'menu');
		}
		$pesan ="<div class='alert alert-success alert-dismissible fade show'>
        	<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        	Data berhasil disimpan
        </div>";
		$this->session->set_flashdata('message',$pesan);
		redirect(site_url('menu'));
	}
	
	
	function hapus($id){  
        $row = $this->mdl_restoran->get_by_id($id);

		if($row){
				// unlink() use for delete files like image.
				unlink('images/makanan/'.$row->gambar);
				$this->mdl_restoran->hapus($id,'menu');  
				$pesan ="<div class='alert alert-success alert-dismissible fade show'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					Data berhasil dihapus</div>";
				$this->session->set_flashdata('message',$pesan);
				redirect(base_url().'menu/'); //untuk kembali ke halaman home  
		}else{
			$this->session->set_flashdata('message', "<div style='color:#dd4b39;'>Data tidak ditemukan.</div>");
			redirect(base_url().'menu/'); //untuk kembali ke halaman home  
		}
		
    }
	function ubah($id){
		if($_POST){  
            //$tanggal = date("y-m-d");
			if(empty($_FILES['ugambar']['name']))
			{
			$data_post=array(  
					'nama_menu' => $_POST["unama_menu"],
					'deskripsi' => $_POST["udeskripsi"],
					'harga' => $_POST["uharga"],
					'stock' => $_POST["ustock"],
					'gambar' => $_POST["ugambar"]
				);
			}else{
			$data_post=array(  
					'nama_menu' => $_POST["unama_menu"],
					'deskripsi' => $_POST["udeskripsi"],
					'harga' => $_POST["uharga"],
					'stock' => $_POST["ustock"],
					'gambar' => $_FILES['ugambar']['name']
				);
			}
            $this->mdl_restoran->ubah($id,$data_post);
			$pesan ="<div class='alert alert-success alert-dismissible fade show'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					Data berhasil diubah</div>";
			$this->session->set_flashdata('message',$pesan);
			redirect('menu'); 
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