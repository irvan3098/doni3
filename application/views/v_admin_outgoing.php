<?php echo $this->session->userdata('message'); ?>
<div class="col-md-6">
             	<div class="card">
                	<div class="card-header">
                     	<strong class="card-title mb-3">Outgoing</strong>
                  	</div>
                    <div class="card-body">
                    	<form action="<?=site_url('out_in/tambah_out')?>" method="post" novalidate>
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
                      		</div>
                            <div class="form-group">
                            	<label for="deskripsi" class="control-label mb-1">Deskripsi</label>
                                <input id="deskripsi" name="deskripsi" type="text" class="form-control" required>
                                <input name="kode" type="hidden" class="form-control" value="<?php echo $kode;?>">
                      		</div>
                            <hr>
                            <div>
                            	<button type="submit" class="btn btn-lg btn-danger btn-block">
                             		<i class="fa fa-arrow-circle-o-left fa-lg"></i> Keluar
                              	</button>
                         	</div>
                     	</form>
                	</div>
             	</div>
              </div>
<div class="col-md-12">
	<div class="card">
    	<div class="card-header">
        	<strong class="card-title">Detail Data Menu</strong>
        </div>
   		<div class="card-body">
        	<table id="bootstrap-data-table" class="table table-striped table-bordered">
           		<thead>
            		<tr>
            			<th>Kode</th>
                        <th>Nama Menu</th>
                        <th>Tanggal</th>
                        <th>Jumlah keluar</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data_out as $out){?>
                      <tr>
                      	<td><?php echo $out["kode"]?></td>
                        <td><?php echo $out["nama_menu"]?></td>
                        <td><?php echo $out["tgl_out"]?></td>
                        <td><?php echo $out["jumlah_out"]?></td>
                        <td><?php echo $out["deskripsi_out"]?></td>
                        <td>
                        	 <?php
							$hapus = array(
								'class' => 'btn btn-lg btn-danger',
								'onclick' => 'javascript: return confirm(\'Anda yakin menghapus ' .$data['nama_menu'] . '?\')'
							);
							echo anchor(site_url('out_in/hapus_out/' . $out['id_outgoing']), '<i class="fa fa-trash"></i>', $hapus);
							#$ubah = array(
							#	'class' => 'btn btn-lg btn-info'
							#);
							#echo anchor(site_url('#' . $out['id_outgoing']), '<i class="fa fa-pencil"></i>', $ubah);
							?>
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
          		</div>
			</div>
  		</div>