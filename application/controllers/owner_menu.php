<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	

class Owner_menu extends CI_Controller
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
		$konten = $this->load->view('v_owner_menu',$data_menu,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
}
?>