<?php echo $this->session->userdata('message'); ?>
<div class="col-md-6">
	<div class="card">
    	<div class="card-header">
       		<strong class="card-title mb-3">Tambah Menu</strong>
       	</div>
        
        <div class="card-body">
        <form action="<?=site_url('menu/tambah')?>" method="post" enctype="multipart/form-data">
        	<div class="form-group">
            	<label for="nama_menu" class="control-label mb-1">Nama menu</label>
             	<input id="nama_menu" name="nama_menu" type="text" class="form-control" required>
        	</div>
            <div class="form-group">
            	<label for="deskripsi" class="control-label mb-1">Deskripsi menu</label>
                <input id="deskripsi" name="deskripsi" type="text" class="form-control" required>
       		</div>
            <div class="form-group">
            	<label for="harga" class="control-label mb-1">Harga</label>
            	<input id="harga" name="harga" type="text" class="form-control" required>
         	</div>
            <div class="form-group">
            	<label for="gambar" class="control-label mb-1">Gambar</label>
             	<input id="gambar" name="gambar" type="file" class="form-control" required  accept="image/jpeg">
         	</div>
            <hr>
            <div>
            	<button id="tambah" type="submit" class="btn btn-lg btn-info btn-block">
            	<i class="fa fa-plus fa-lg"></i> Tambah
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
                        <th>Nama Menu</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($menu as $data){?>
                      <tr>
                        <td><?php echo $data["nama_menu"]?></td>
                        <td><?php echo $data["deskripsi"];?></td>
                        <td><?php echo $data["harga"];?></td>
                        <td><?php echo $data["stock"];?></td>
                        <td><?php echo $data["gambar"];?></td>
                        <td>
                            <?php
							$hapus = array(
								'class' => 'btn btn-lg btn-danger',
								'onclick' => 'javascript: return confirm(\'Anda yakin menghapus ' .$data['nama_menu'] . '?\')'
							);
							echo anchor(site_url('menu/hapus/' . $data['id_menu']), '<i class="fa fa-trash"></i>', $hapus);
							$ubah = array(
								'class' => 'btn btn-lg btn-info'
							);
							echo anchor(site_url('menu/ubah/' . $data['id_menu']), '<i class="fa fa-pencil"></i>', $ubah);
							?>
                            
                      		 
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                    </div>
				</div>
            </div>
