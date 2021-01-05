<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	

class Owner_laporan extends CI_Controller
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
		//
		$state_awal = "2018-01-01";
		$menu = $_POST["menu"];
		$tgl1 = $_POST["tgl1"];
		$tgl2 = $_POST["tgl2"];
		//$detail_laporan = $this->mdl_restoran->detail_laporan();
		//akumulasi data sebelumnya
		
		$akumulasi = date('Y-m-d',strtotime('-1 days', strtotime($tgl1)));
		$data_akumulasi = $this->mdl_restoran->jum_in($state_awal,$akumulasi); 
		$data_akumulasi_out = $this->mdl_restoran->jum_out($state_awal,$akumulasi); 
		$data_menu = $this->mdl_restoran->data_menu();
		//$jum_menu= $this->mdl_restoran->data_menu2()->num_rows();
		//$data_incoming = $this->mdl_restoran->stock_incoming($tgl1,$tgl2);
		//$data_outgoing = $this->mdl_restoran->stock_outgoing($tgl1,$tgl2);
		
		$start_date = new DateTime($tgl1);
		$end_date = new DateTime($tgl2);
		$interval = $start_date->diff($end_date);
		$jum_hari = $interval->days;
		
		
		//card stock semua menu
		foreach ($data_menu as $menu)
		{
			#echo "<table border=1>";
			#echo "<tr>";
			$id_menu = $menu["id_menu"];
			#echo $menu["nama_menu"],$id_menu;
			$data_incoming = $this->mdl_restoran->stock_incoming2($id_menu,$tgl1,$tgl2);
			$i=1;
			$data_outgoing = $this->mdl_restoran->stock_outgoing2($id_menu,$tgl1,$tgl2);
			$j=1;
			foreach($data_incoming as $incoming)
			{
				$push_incoming[$i][$id_menu]["kode_in"] = $incoming["kode"];
				$push_incoming[$i][$id_menu]["tgl_in"] = $incoming["tgl_in"];
				$push_incoming[$i][$id_menu]["incoming"] = $incoming["jumlah_in"];
				//echo "<td>".$incoming["tgl_in"]."</td>";
				//echo "<td>".$incoming["incoming"]."</td>";
				$i++;
			}
			foreach($data_outgoing as $outgoing)
			{
				$push_outgoing[$j][$id_menu]["kode_out"] = $outgoing["kode"];
				$push_outgoing[$j][$id_menu]["tgl_out"] = $outgoing["tgl_out"];
				$push_outgoing[$j][$id_menu]["outgoing"] = $outgoing["jumlah_out"];
				//echo "<td>".$outgoing["outgoing"]."</td>";
				$j++;
			}
			#echo "</tr>";
			#echo "</table>";
		
		}//penutup else jika semua menu
		#echo var_dump($push_incoming[1][7]);
		#echo $jum_menu; 
		
		$data_laporan=array(
			'laporan' => $detail_laporan,
			'menu' => $data_menu,
			'incoming'		=> $push_incoming,
			'outgoing'		=> $push_outgoing,
			'tgl' 		=> $tgl1,
			'jum_hari' 	=> $jum_hari,
			'akumulasi_in' => $data_akumulasi,
			'akumulasi_out' => $data_akumulasi_out
		);
		
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_laporan_stock',$data_laporan,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		$this->load->view('template',$data_konten);
	}
	
	function keuangan()
	{
		$level['level'] = $_SESSION['level'];
		$tgl1 = $_GET["tgl1"];
		$tgl2 = $_GET["tgl2"];
		$detail_laporan = $this->mdl_restoran->detail_laporan($tgl1,$tgl2);
		
		$data_laporan=array(
			'laporan' => $detail_laporan,
			'menu' => $data_menu,
			'incoming'		=> $push_incoming,
			'outgoing'		=> $push_outgoing,
			'tgl' 		=> $tgl1,
			'jum_hari' 	=> $jum_hari
		);
		
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_owner_laporan',$data_laporan,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten
		);
		
		//echo var_dump($detail_laporan);
		$this->load->view('template',$data_konten);
	}
	
	
	function laporan_bar()
	{
		$level['level'] = $_SESSION['level'];
		$detail_laporan = $this->mdl_restoran->laporan_bar();
		
		$data_laporan=array(
			'laporan' => $detail_laporan
			
		);
		
		
		$sidebar = $this->load->view('sidebar',$level,true);
		$konten = $this->load->view('v_laporan_bar',$data_laporan,true);
		$data_konten = array(
			'sidebar' => $sidebar,
			'konten' => $konten,
			'laporan' => $detail_laporan
		);
		
		//echo var_dump($detail_laporan);
		$this->load->view('template',$data_konten);
	}
	
	
	function cetak_comsumtion(){
		$tgl1= $_GET["tgl1"];
		$tgl2= $_GET["tgl2"];
	    $pdf = new FPDF('p','mm','A4');
		$pdf->SetMargins(20,30,15);
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        
        // mencetak string 
        $pdf->image(base_url().'images/logo_pembayaran.png',80,10,50,20);
        $pdf->SetFont('Arial','',10);
		$pdf->Cell(0,7,'Laporan tanggal '.$tgl1.' sampai '.$tgl2,0,1,'C');
		$pdf->SetFont('Arial','B',10);
        $pdf->SetFillColor(211, 211, 211);
		$pdf->Cell(20,6,'Kode',0,0,'',1);
		$pdf->Cell(80,6,'Nama Menu',0,0,'L',211, 211, 211);
		$pdf->Cell(27,6,'Qty',0,0,'C',211, 211, 211);
		$pdf->Cell(27,6,'Harga',0,0,'C',211, 211, 211);
		$pdf->Cell(25,6,'TOTAL',0,1,'C',211, 211, 211);
        $pdf->SetFont('Arial','',10);
        $consumtion = $this->mdl_restoran->detail_laporan($tgl1,$tgl2);
        foreach ($consumtion as $row){
            $pdf->Cell(20,6,$row["kode"],0,0);
            $pdf->Cell(80,6,$row["nama_menu"],0,0,'L');
			$pdf->Cell(27,6,$row["qty"],0,0,'C');
            $pdf->Cell(27,6,number_format($row["harga"], 0, ".", "."),0,0,'C');
			$total= $row["qty"]*$row["harga"];
            $pdf->Cell(25,6,number_format($total, 0, ".", "."),0,1,'C');
			$ttl_bayar = $ttl_bayar + $total; 
        }
		$pdf->Cell(154,6,'Grand Total',0,0,'R',211, 211, 211);
		$pdf->Cell(25,6,number_format($ttl_bayar, 0, ".", "."),0,1,'C',211, 211, 211);
		$pdf->Output();
		
    
	}

    
   
}
?>