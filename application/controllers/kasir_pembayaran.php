<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	

class Kasir_pembayaran extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form');
		$this->load->library('session');
		$this->load->model('mdl_restoran');
		$this->load->library('pdf');
		
	}
	
	function index()
	{
		$level['level'] = $_SESSION['level'];
		$data_menu['menu'] = $this->mdl_restoran->data_pesanan();
		
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_kasir_datapembayaran',$data_menu,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	
	function konfirmasi_pembayaran($id_pesanan)
	{
		$level['level'] = $_SESSION['level'];
		$menu = $this->mdl_restoran->data_pembayaran($id_pesanan);
		$data_menu=array(
			'id_pesanan' => $id_pesanan,
			'menu' => $menu
		);
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_kasir_pembayaran',$data_menu,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	
	function simpan_pembayaran($id_pesanan)
	{
		$id_pesanan = $_POST["id_pesanan"];
		$tanggal = date("y-m-d");
		$data_post=array(  
                'id_pesanan' => $_POST["id_pesanan"],
				'tanggal'		=>  $tanggal,
				'total_bayar' => $_POST["total_bayar"],
				'pembayaran' => $_POST["pembayaran"],
				'kembalian' => $_POST["kembalian"]
            );  
			
       	
		$this->mdl_restoran->tambah($data_post,'pembayaran');  
		#redirect(site_url('kasir_pembayaran'));
		//$this->cetak($id_pesanan,$pembayaran,$kembalian);
		#sleep(5);
		
		redirect(site_url('kasir_pembayaran'));
		
	}
	
	function history_pembayaran()
	{
		$level['level'] = $_SESSION['level'];
		$data["history"] = $this->mdl_restoran->dat_his_pembayaran();
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_history_pembayaran',$data,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	 
	 function cetak($id_pesanan){
		
        $pdf = new FPDF('p','mm','A4');
		$pdf->SetMargins(60,30,15);
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        
        // mencetak string 
        $pdf->image(base_url().'images/logo_pembayaran.png',80,10,50,20);
        $pdf->SetFont('Arial','',7);
		$pdf->Cell(90,3,'Jl. Pesantren Wetan No 20',0,1,'C');
		$pdf->Cell(90,3,'Pamoyanan, Cicendo, Bandung City',0,1,'C');
		$pdf->Cell(90,3,'West Java 40173',0,1,'C');
		// Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',7);
        $pdf->SetFillColor(211, 211, 211);
		$pdf->Cell(40,6,'NAMA MENU',0,0,'',1);
		$pdf->Cell(15,6,'JUMLAH',0,0,'C',211, 211, 211);
		$pdf->Cell(15,6,'HARGA',0,0,'C',211, 211, 211);
		$pdf->Cell(15,6,'TOTAL',0,1,'C',211, 211, 211);
        $pdf->SetFont('Arial','',6);
        $pembayaran = $this->mdl_restoran->data_pembayaran($id_pesanan);
        foreach ($pembayaran as $row){
            $pdf->Cell(40,6,$row["nama_menu"],0,0);
            $pdf->Cell(15,6,$row["jumlah"],0,0,'C');
            $pdf->Cell(15,6,number_format($row["harga"], 0, ".", "."),0,0,'C');
			$total= $row["jumlah"]*$row["harga"];
            $pdf->Cell(15,6,number_format($total, 0, ".", "."),0,1,'C');
			$ttl_bayar = $ttl_bayar + $total; 
        }
		$hasil_pembayaran = $this->mdl_restoran->dat_cetak_his_pembayaran($id_pesanan);
		foreach($hasil_pembayaran as $data)
		{
			$pdf->Cell(70,6,'TOTAL BAYAR',0,0,'R',211, 211, 211);
			$pdf->Cell(15,6,number_format($ttl_bayar, 0, ".", "."),0,1,'C',211, 211, 211);
			$pdf->Cell(70,6,'PEMBAYARAN',0,0,'R',211, 211, 211);
			$pdf->Cell(15,6,number_format($data["pembayaran"], 0, ".", "."),0,1,'C',211, 211, 211);
			$pdf->Cell(70,6,'KEMBALIAN',0,0,'R',211, 211, 211);
			$pdf->Cell(15,6,number_format($data["kembalian"], 0, ".", "."),0,1,'C',211, 211, 211);
		}
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(90,7,'Terima kasih atas kunjungan anda',0,1,'C');
		$pdf->Output();
		
    }

	
	
}