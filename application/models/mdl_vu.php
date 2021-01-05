<?php
class Mdl_vu extends CI_Model{  
	function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','form'));
		}
	
	function hu_news()
	{
		$sql = "SELECT id_tulisan,nama_pengguna,judul,tgl_mulai, tgl_akhir,tulisan FROM tulisan
JOIN pengguna USING(id_pengguna) WHERE kategori='news'
ORDER BY id_tulisan DESC LIMIT 4";
		$query=$this->db->query($sql);  
        return $query->result_array();
	}
	
	function hu_blog()
	{
		$sql = "SELECT id_tulisan,nama_pengguna,judul,tgl_mulai, tgl_akhir,tulisan FROM tulisan
JOIN pengguna USING(id_pengguna) WHERE kategori='blog'
ORDER BY id_tulisan DESC LIMIT 4";
		$query=$this->db->query($sql);  
        return $query->result_array();
	}
	
	
	function baca($id_tulisan)
	{
		$sql = "SELECT id_tulisan,nama_pengguna,judul,tanggal,tulisan FROM tulisan
JOIN pengguna USING(id_pengguna) WHERE id_tulisan = $id_tulisan ";
		$query=$this->db->query($sql);  
        return $query->result_array();
	}
	
	
	function login($nama_pengguna,$password) 
	{    
	
		$sql = "SELECT * FROM pengguna WHERE nama_pengguna = '$nama_pengguna' and password = '$password'";
		$query = $this->db->query($sql);
        return $query->result_array();
    }
	
	
	//studio musik
	function daftar_sm(){  
		$sql_query = "SELECT s.id_pengguna, s.id_studio, bd.icon, bd.nama_studio, bd.alamat, bd.buka, bd.tutup, bd.kontak, bd.lat, bd.lng FROM bio_data AS bd
JOIN pengguna AS p USING(id_biodata) 
JOIN studio AS s USING(id_pengguna) 
GROUP BY s.id_pengguna 
";
        $row = $this->db->query($sql_query);
        return $row->result_array(); 
    }
	
	function detail_harga($id_pengguna)
	{
		$sql="SELECT nama_studio,harga FROM pengguna
JOIN studio USING(id_pengguna)
WHERE id_pengguna = $id_pengguna";
		$row = $this->db->query($sql);
        return $row->result_array();
	}
	
	function jum_studio($id)
	{
        $sql_query = "SELECT * from studio where id_pengguna=$id  ";  
        $query=$this->db->query($sql_query);  
        return $query->result_array();  
	}
	
	function harga_studio($id)
	{
        $sql_query = "SELECT nama_studio, harga FROM studio
JOIN pengguna USING(id_pengguna) where id_pengguna=$id  ";  
        $query=$this->db->query($sql_query);  
        return $query->result_array();  
	}
	
	function detail_studio($id){  
        $sql_query = "SELECT s.id_pengguna, s.id_studio, bd.icon, bd.nama_studio, bd.alamat, bd.buka, bd.tutup, bd.kontak, bd.lat, bd.lng FROM bio_data AS bd
JOIN pengguna AS p USING(id_biodata) 
JOIN studio AS s USING(id_pengguna) 
where s.id_pengguna = $id group by s.id_pengguna";  
        $query=$this->db->query($sql_query);  
        return $query->result_array();  
    }
	
	function data_table($id,$tgl1,$tgl2,$car_day){  
        $sql_query = "SELECT id_pengguna, id_studio,nama_band,tgl,jam_msk, jam_klr, DAYNAME(tgl) as nam_har FROM studio 
JOIN jadwal USING(id_studio)
WHERE id_pengguna =$id  AND tgl BETWEEN '$tgl1' AND '$tgl2' AND DAYNAME(tgl) = '$car_day' ORDER BY jam_msk ASC";  
        $query=$this->db->query($sql_query);  
        return $query->result_array();  
    }
	
	function data_table2($id,$tgl1,$tgl2,$car_day,$id_stu){  
        $sql_query = "SELECT id_pengguna, id_studio,nama_band,tgl,jam_msk, jam_klr, DAYNAME(tgl) as nam_har FROM studio 
JOIN jadwal USING(id_studio)
WHERE id_pengguna ='$id'  AND tgl BETWEEN '$tgl1' AND '$tgl2' AND DAYNAME(tgl) = '$car_day' AND id_studio ='$id_stu' ORDER BY jam_msk ASC";  
        $query=$this->db->query($sql_query);  
        return $query->result_array();  
    }
	
	function coba(){  
        $sql_query = "SELECT id_pengguna,id_studio,nama_band,DAYNAME(tgl) AS namhar,jam_msk, jam_klr FROM studio 
JOIN jadwal USING(id_studio)
WHERE id_pengguna =2 AND id_studio = 2 AND tgl BETWEEN '2017-12-04' AND '2017-12-10'  ORDER BY jam_msk ASC";  
        $query=$this->db->query($sql_query);  
        return $query->result_array();  
    }
	
	//ambil gambar
	function ambil_gambar($id)
	{
		$sql_query = "select * from galeri where id_pengguna = $id";
		$query=$this->db->query($sql_query);  
        return $query->result_array();
	}
	
	//cari buka tutup
	function buka_tutup($id)
	{
		$sql_query = "select * from bio_data join pengguna using(id_biodata) where id_pengguna = $id";  
        $query=$this->db->query($sql_query);  
        return $query->result_array(); 
	}
	
	////////////////////////////////////////////////////////////////////////// ADMIN
	function get_id_studio($id){  
        $sql = "SELECT p.id_pengguna, s.id_studio, s.nama_studio,s.harga FROM studio AS s
JOIN pengguna AS p USING(id_pengguna)
JOIN bio_data AS b USING(id_biodata) where p.id_pengguna = $id";
		$query=$this->db->query($sql); 
		return $query->result_array();
    }
	
	
	//profil
	function get_profil($id_s){  
        $sql = "select * from bio_data join pengguna using(id_biodata) where id_pengguna = $id_s";
		$query=$this->db->query($sql);  
        return $query->result_array();  
    }
	
	function get_studio($id_s){  
        $sql = "select * from studio where id_pengguna = $id_s";
		$query=$this->db->query($sql);  
        return $query->result_array();  
    }
	
	function update_profil($id_b,$data){  
        $this->db->where('id_biodata',$id_b);  
        $this->db->update('bio_data',$data);  
    }  

	
	
	//crud
	function data_tulisan($idpengguna){  
        $sql_query = "SELECT * from tulisan WHERE id_pengguna = $idpengguna";  
        $query=$this->db->query($sql_query);  
        return $query->result_array();
	}
	
	function tambah($data,$table){
		$this->db->insert($table,$data);
	}
	
	function delete_tulisan($idtulisan){  
        $this->db->where('id_tulisan',$idtulisan);  
        $this->db->delete('tulisan');  
    }
	
	function get_1_tulisan($idtulisan){  
        $this->db->select()->from('tulisan')->where(array('id_tulisan'=>$idtulisan));  
        $query=$this->db->get();  
        return $query->first_row('array');
    }
	
	function ubah_tulisan($id,$data){  
        $this->db->where('id_tulisan',$id);  
        $this->db->update('tulisan',$data);  
    }

	function delete_jadwal($idjadwal){  
        $this->db->where('id_jadwal',$idjadwal);  
        $this->db->delete('jadwal');  
    }
}  
?>  
