<?php 
class Mdl_restoran extends CI_Model{  
	function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','form'));
		}
		
	function login($user,$pass) 
	{    
		$sql = "SELECT * FROM pengguna WHERE nama_pengguna = '$user' and password = '$pass'";
		$query = $this->db->query($sql);
        return $query->result_array();
    }
	function data_pengguna() 
	{    
		$sql = "SELECT * FROM pengguna";
		$query = $this->db->query($sql);
        return $query->result_array();
    }
	
	function data_menu()
	{
		$sql = "SELECT * FROM menu ";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	function data_menu2()
	{
		$sql = "SELECT * FROM menu ";
		$query = $this->db->query($sql);
        return $query;
	}
	
	
	function tambah($data,$table){
		$this->db->insert($table,$data);
	}
	
	function tambah_stock($id_menu,$data){  
        $this->db->where('id_menu',$id_menu);  
        $this->db->update('incoming',$data);  
    }
	function hapus($id_menu,$table){  
        $this->db->where('id_menu',$id_menu);  
        $this->db->delete($table);  
    }
	function hapus_pengguna($id,$table){  
        $this->db->where('id_pengguna',$id);  
        $this->db->delete($table);  
    }
	function hapus_out($id,$table){  
        $this->db->where('id_outgoing',$id);  
        $this->db->delete($table);  
    }
	function hapus_in($id,$table){  
        $this->db->where('id_incoming',$id);  
        $this->db->delete($table);  
    }
	function get_by_id_out($id)
	  {
		$this->db->where('id_outgoing', $id);
		return $this->db->get('outgoing')->row();
	  }
	function get_by_id_in($id)
	{
		$this->db->where('id_incoming', $id);
		return $this->db->get('incoming')->row();
	 }
	function get_by_id($id)
	  {
		$this->db->where('id_menu', $id);
		return $this->db->get('menu')->row();
	  }
	function get_by_id_ubah($id)
	  {
		$sql = "SELECT * FROM menu where id_menu='$id'";
		$query = $this->db->query($sql);
        return $query->result_array();
	  }
	function ubah($id,$data){  
        $this->db->where('id_menu',$id);  
        $this->db->update('menu',$data);  
    }
	function ubah_pengguna($id,$data){  
        $this->db->where('id_pengguna',$id);  
        $this->db->update('pengguna',$data);  
    }
	function ubah_status_pesanan_koki($id,$data){  
        $this->db->where('id_menu',$id);  
        $this->db->update('detail_pesanan',$data);  
    }
	function ubah_status_pesanan_pelayan($id,$data){  
        $this->db->where('id_menu',$id);  
        $this->db->update('detail_pesanan',$data);  
    }
	
	///outgoing
	function data_outgoing()
	{
		$sql = "SELECT * FROM outgoing JOIN menu USING(id_menu) ORDER BY id_outgoing DESC ";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	function data_incoming()
	{
		$sql = "SELECT * FROM incoming join menu using(id_menu) ORDER BY id_incoming DESC";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	//kasir
	function tambah_pesanan($data,$table){
		$this->db->insert($table,$data);
	}
	
	function post_add($result = array())
	{
		$total_array = count($result);
		 
		if($total_array != 0)
		{
		$this->db->insert_batch('detail_pesanan', $result);
		}
	}
	
	function data_pesanan()
	{
		$sql = "SELECT pembayaran.id_pembayaran,pesanan.meja ,detail_pesanan.id_pesanan,COUNT(menu.nama_menu) AS jumlah_menu,
SUM(detail_pesanan.jumlah) AS jumlah_pesanan FROM detail_pesanan
JOIN pesanan USING(id_pesanan)
JOIN menu USING(id_menu)
LEFT JOIN pembayaran ON detail_pesanan.id_pesanan = pembayaran.id_pesanan
WHERE pembayaran.id_pembayaran IS NULL
GROUP BY id_pesanan
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	function data_pembayaran($id_pesanan)
	{
		$sql = "SELECT id_pesanan,nama_menu, jumlah, harga,(jumlah*harga) AS total FROM detail_pesanan
JOIN menu USING(id_menu)
WHERE id_pesanan = $id_pesanan
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	function data_pesanan_koki()
	{
		$sql = "SELECT id_pesanan,id_menu, meja, nama_menu, jumlah, status_koki FROM pesanan
JOIN detail_pesanan USING(id_pesanan)
JOIN menu USING(id_menu) where status_koki = 'F'
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	function data_pesanan_pelayan()
	{
		$sql = "SELECT id_pesanan,id_menu, meja, nama_menu, jumlah, status_koki FROM pesanan
JOIN detail_pesanan USING(id_pesanan)
JOIN menu USING(id_menu) where status_koki = 'T' and status_pelayan = 'F'
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	function stock_incoming($menu,$tgl1,$tgl2)
	{
		$sql = "SELECT id_menu,nama_menu,tgl_in,jumlah_in , kode FROM incoming
		join menu using(id_menu)
WHERE tgl_in BETWEEN '$tgl1' AND '$tgl2' AND nama_menu = '$menu'
ORDER BY tgl_in ASC
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	function stock_incoming2($id_menu,$tgl1,$tgl2)
	{
		$sql = "SELECT id_menu,tgl_in,jumlah_in , kode FROM incoming
WHERE id_menu = $id_menu AND tgl_in BETWEEN '$tgl1' AND '$tgl2'
ORDER BY tgl_in ASC

";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	
	function stock_outgoing($menu,$tgl1,$tgl2)
	{
		$sql = "SELECT id_menu,tgl_out, jumlah_out,kode FROM outgoing
		join menu using(id_menu)
WHERE tgl_out BETWEEN '$tgl1' AND '$tgl2' AND nama_menu = '$menu'
ORDER BY tgl_out ASC
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	function stock_outgoing2($id_menu,$tgl1,$tgl2)
	{
		$sql = "SELECT id_menu,tgl_out, jumlah_out,kode FROM outgoing
WHERE id_menu = $id_menu AND tgl_out BETWEEN '$tgl1' AND '$tgl2' 
ORDER BY tgl_out ASC
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	
	function detail_laporan($tgl1,$tgl2)
	{
		$sql = "SELECT kode,id_menu,menu.nama_menu,SUM(detail_pesanan.jumlah) AS qty ,pembayaran.tanggal, menu.harga 
FROM detail_pesanan
JOIN menu USING(id_menu)
JOIN pesanan USING(id_pesanan)
JOIN pembayaran USING(id_pesanan)
WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'
GROUP BY menu.id_menu
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	function laporan_bar()
	{
		$sql = "SELECT kode,id_menu,menu.nama_menu,SUM(detail_pesanan.jumlah) AS qty ,pembayaran.tanggal, menu.harga 
FROM detail_pesanan
JOIN menu USING(id_menu)
JOIN pesanan USING(id_pesanan)
JOIN pembayaran USING(id_pesanan)
WHERE tanggal = CURDATE()
GROUP BY menu.id_menu
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	function code_in(){
            $this->db->select('Right(incoming.kode,3) as kode ',false);
            $this->db->order_by('id_incoming', 'desc');
            $this->db->limit(1);
            $query = $this->db->get('incoming');
            if($query->num_rows()<>0){
                $data = $query->row();
                $kode = intval($data->kode)+1;
            }else{
                $kode = 1;

            }
            $kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
            $kodejadi  = "IN".$kodemax;
            return $kodejadi;

        }
	function code_out(){
            $this->db->select('Right(outgoing.kode,3) as kode ',false);
            $this->db->order_by('id_outgoing', 'desc');
            $this->db->limit(1);
            $query = $this->db->get('outgoing');
            if($query->num_rows()<>0){
                $data = $query->row();
                $kode = intval($data->kode)+1;
            }else{
                $kode = 1;

            }
            $kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
            $kodejadi  = "OU".$kodemax;
            return $kodejadi;

        }
	function code_cs(){
    	$this->db->select('Right(detail_pesanan.kode,3) as kode ',false);
       	$this->db->order_by('id_detail_pesanan', 'desc');
       	$this->db->limit(1);
       	$query = $this->db->get('detail_pesanan');
        if($query->num_rows()<>0){
      		$data = $query->row();
         	$kode = intval($data->kode)+1;
       	}else{
       		$kode = 1;
		}
            $kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
            $kodejadi  = "CS".$kodemax;
            return $kodejadi;
        }
	
	function dat_his_pembayaran()
	{
		$sql = "SELECT 
	pesanan.id_pesanan,
	pesanan.meja,
	detail_pesanan.kode,
	COUNT(menu.nama_menu) AS jum_menu,
	SUM((detail_pesanan.jumlah*menu.harga)) AS total
FROM detail_pesanan
JOIN pesanan USING(id_pesanan)
JOIN menu USING(id_menu)
GROUP BY kode
ORDER BY id_pesanan DESC
";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	function dat_cetak_his_pembayaran($id_pesanan)
	{
		$sql = "SELECT * from pembayaran where id_pesanan = $id_pesanan";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
	function jum_in($state_awal,$akumulasi)
	{
		$sql = "SELECT id_menu, SUM(jumlah_in) AS jum_in FROM incoming
where tgl_in between '$state_awal' and '$akumulasi'
GROUP BY id_menu";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	function jum_out($state_awal,$akumulasi)
	{
		$sql = "SELECT id_menu, SUM(jumlah_out) AS jum_out FROM outgoing
where tgl_out between '$state_awal' and '$akumulasi'
GROUP BY id_menu";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
	
}
?>