<div class="col-md-6">
	<div class="card">
    	<div class="card-header">
       		<strong class="card-title mb-3">Tambah Menu</strong>
       	</div>
        
        <div class="card-body">
        <?php foreach($ubah_menu as $data){?>
        <form action="" method="post" enctype="multipart/form-data">
        	<div class="form-group">
            	<label for="nama_menu" class="control-label mb-1">Nama menu</label>
             	<input id="nama_menu" name="unama_menu" type="text" class="form-control" required value="<?php echo $data["nama_menu"]?>">
        	</div>
            <div class="form-group">
            	<label for="deskripsi" class="control-label mb-1">Deskripsi menu</label>
                <input id="deskripsi" name="udeskripsi" type="text" class="form-control" required value="<?php echo $data["deskripsi"]?>">
       		</div>
            <div class="form-group">
            	<label for="harga" class="control-label mb-1">Harga</label>
            	<input id="harga" name="uharga" type="text" class="form-control" required value="<?php echo $data["harga"]?>">
         	</div>
            <div class="form-group">
            	<label for="gambar" class="control-label mb-1">Gambar</label>
             	<input id="gambar" name="ugambar" type="file" class="form-control" accept="image/jpeg" value="<?php echo $data["gambar"]?>">
         	</div>
            <hr>
            <div>
            <input type="hidden" name="ugambar" value="<?php echo $data["gambar"]?>">
            	<button type="submit" class="btn btn-lg btn-info btn-block">
            	<i class="fa fa-plus fa-lg"></i> Ubah
                </button>
        	</div>
     	</form>
        <?php }?>
   		</div>
 	</div>
</div>