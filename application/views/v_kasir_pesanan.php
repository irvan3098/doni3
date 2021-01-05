<?php //echo $id_pesanan;?>
<?php foreach($menu as $data)
{
	if($data["stock"] == 0 )
	{
		$status  = 'card card-menu bg-danger';
		$input = "disabled";
	}elseif($data["stock"] < 5)
	{
		$status  = 'card card-menu bg-warning';
		$input = " ";
	}else
	{
		$status  = 'card card-menu';
		$input = " ";	
	}
?>
<form method="post" action="<?=site_url('kasir_pesanan/simpan_pesanan')?>">
	<div class="col-md-4">
		<div class="<?php echo $status?>">
			<div class="card-body">
            	<div class="mx-auto d-block">
                	<img class="mx-auto d-block" style="width:300px; height:180px;" src="<?php echo base_url()?>images/makanan/<?php echo $data['gambar']?>" alt="Card image cap">
                	<h5 class="text-sm-center mt-2 mb-1"><?php echo $data['nama_menu']?></h5>
                   	<div class="location text-sm-center">
                   		<i class="fa fa-money"></i> <?php echo $data['harga']?><br>
						Stock : <?php echo $data["stock"];?>
               		</div>
          		</div>
       			<hr>
                <div class="card-text text-sm-center">
                	<input type="hidden"  name="id_menu[]" class="form-control" value="<?php echo $data["id_menu"]?>">
              		<input type="number"  name="jml_pesanan[<?php echo $data["id_menu"]?>]" class="form-control" <?php echo $input;?>>
               		<input type="hidden" name="id_pesanan" value="<?php echo $id_pesanan;?>">
            		<input type="hidden" name="kode" value="<?php echo $kode;?>">
                </div>
         	</div>
    	</div>
	</div>
<?php	
}?>
<div class="breadcrumbs">
	<div class="col-sm-12">
    <div class="page-header float-right">
    <div class="page-title">
    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
    <i class="fa fa-arrow-circle-o-right"></i>&nbsp;
    <span id="payment-button-amount">Pesan</span>
    </button>
    </div>
    </div>
    </div>
</div>
</form>