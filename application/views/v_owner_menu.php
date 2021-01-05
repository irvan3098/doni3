<?php echo $id_pesanan;?>
<?php foreach($menu as $data){?>
<form method="post" action="<?=site_url('kasir_pesanan/simpan_pesanan')?>">
<div class="col-md-4">
<div class="card card-menu">
<div class="card-header">
	<strong class="card-title"><?php echo $data['nama_menu']?></strong>
</div>
	<div class="card-body">
                    	<div class="mx-auto d-block">
                        	<img class=" mx-auto d-block" style="width:300px; height:180px;" src="<?php echo base_url()?>images/makanan/<?php echo $data['gambar']?>" alt="Card image cap">
                     		<div class="location text-sm-center">
                            	<p class="card-text"><?php echo $data["deskripsi"]?></p>
                                <i class="fa fa-money"></i> <?php echo $data['harga']?><br>
								
                           	</div>
                        </div>
                        <hr>
                        <div class="card-text text-sm-center">
                        	
                            <strong>Stock :</strong><?php echo $data["stock"];?>
                            
                       	</div>
                	</div>
             	</div>
</div>
<?php }?>
</form>