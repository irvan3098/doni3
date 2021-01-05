<?php
$config = array(
    array(
        'field' => 'nama_studio',
        'rules' => 'trim|required',
		'errors' => array(
                        'required' => 'harap isi studio kosong',
				),
		
    ),
	array(
        'field' => 'alamat',
        'rules' => 'trim|required',
		'errors' => array(
                        'required' => 'harap isi alamat',
				),
		
    ),
	array(
        'field' => 'jam_buka',
        'rules' => 'trim|required|alpha_numeric',
		'errors' => array(
                        'required' => 'harap isi jam buka',
						'alpha_numeric' => 'form jam buka format angka'
                ),
		
    ),
	array(
        'field' => 'jam_tutup',
        'rules' => 'trim|required|alpha_numeric',
		'errors' => array(
                        'required' => 'harap isi jam tutup',
						'alpha_numeric' => 'form jam buka format angka'
                ),
		
    ),
	array(
        'field' => 'kontak',
        'rules' => 'trim|required',
		'errors' => array(
                        'required' => 'harap isi alamat',
				),
		
    ),
	array(
        'field' => 'lat',
        'rules' => 'trim|required',
		'errors' => array(
                        'required' => 'tentukan titik lokasi anda dengan klik lokasi pada peta',
			    ),
		
    ),
	array(
        'field' => 'lng',
        'rules' => 'trim|required',
		'errors' => array(
                        'required' => 'tentukan titik lokasi anda dengan klik lokasi pada peta',
				),
		
    ),
	array(
        'field' => 'nama_pengguna',
        'rules' => 'trim|required',
		'errors' => array(
                        'required' => 'harap isi nama_pengguna',
				),
		
    ),
	array(
        'field' => 'email',
        'rules' => 'trim|required|valid_email',
		'errors' => array(
                        'required' => 'harap isi email',
						'alpha_numeric' => 'bukan email'
                ),
		
    ),
	array(
        'field' => 'password',
        'rules' => 'trim|required',
		'errors' => array(
                        'required' => 'password'
                ),
		
    ),
	array(
        'field' => 'confrim_password',
        'rules' => 'trim|required|matches[password]',
		'errors' => array(
                        'required' => 'password',
						'matches' => 'password salah'
                ),
		
    )
	
);