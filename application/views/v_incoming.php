<?php echo $this->session->userdata('message'); ?>
<div class="col-md-6">
             	<div class="card">
                	<div class="card-header">
                     	<strong class="card-title mb-3">Incoming</strong>
                  	</div>
                    <div class="card-body">
                    	<form action="<?=site_url('out_in/tambah_in')?>" method="post" novalidate>
                        	<div class="form-group">
                            	<label for="nama_menu" class="control-label mb-1">Nama menu</label>
                                <select name="id_menu" type="text" class="form-control" required>
                                	<option> Pilih </option>
                                    <?php foreach($menu as $data){?>
                                    <option value="<?php echo $data["id_menu"]?>"><?php echo $data["nama_menu"]?> </option>
                                    <?php }?>
                                </select>
                      		</div>
                            <div class="form-group">
                            	<label class="control-label mb-1">Tanggal</label>
                                <input type="date" name="tgl" class="form-control" required>
                            </div>
                            <div class="form-group">
                            	<label for="jum" class="control-label mb-1">Jumlah</label>
                                <input id="jum" name="jumlah" type="text" class="form-control" required>
                                <input id="jum" name="kode" type="hidden" class="form-control" value="<?php echo $kode;?>">
                      		</div>
                            <hr>
                            <div>
                            	<button type="submit" class="btn btn-lg btn-info btn-block">
                             		<i class="fa fa-arrow-circle-o-left fa-lg"></i> Masuk
                              	</button>
                         	</div>
                     	</form>
                	</div>
             	</div>
              </div>
<div class="col-md-12">
	<div class="card">
    	<div class="card-header">
        	<strong class="card-title">Detail Data Incoming</strong>
        </div>
   		<div class="card-body">
        	<table id="bootstrap-data-table" class="table table-striped table-bordered">
           		<thead>
            		<tr>
            			<td>Kode</td>
                        <th>Nama Menu</th>
                        <th>Tanggal</th>
                        <th>Jumlah Masuk</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data_out as $out){?>
                      <tr>
                        <td><?php echo $out["kode"]?></td>
                        <td><?php echo $out["nama_menu"]?></td>
                        <td><?php echo $out["tgl_in"]?></td>
                        <td><?php echo $out["jumlah_in"]?></td>
                        <td>
                        	 <?php
							$hapus = array(
								'class' => 'btn btn-lg btn-danger',
								'onclick' => 'javascript: return confirm(\'Anda yakin menghapus ' .$data['nama_menu'] . '?\')'
							);
							echo anchor(site_url('out_in/hapus_in/' . $out['id_incoming']), '<i class="fa fa-trash"></i>', $hapus);
							#$ubah = array(
							#	'class' => 'btn btn-lg btn-info'
							#);
							#echo anchor(site_url('#' . $out['id_incoming']), '<i class="fa fa-pencil"></i>', $ubah);
							?>
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
          		</div>
			</div>
  		</div>