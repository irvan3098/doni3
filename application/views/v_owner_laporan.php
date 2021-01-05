 
<form method="get" action="<?=site_url('owner_laporan/keuangan')?>">
<div class="col-lg-12">
 	<div class="card">
    <div class="card-header"><strong>Form</strong><small> Cari</small></div>
        	<div class="card-body card-block">
          		<div class="row form-group align-content-center">
                	<div class="col-12">
                    	<div class="input-group">
                        
                            <input type="date" name="tgl1" class="form-control">
                           	<input type="date" name="tgl2" class="form-control">
                        	<button type="submit" class="btn btn-primary">
                            	<i class="fa fa-search"></i> Cari
                         	</button>
                           
                 		</div>
             		</div>
        	</div>  
    	</div>
	</div>
</div>
</form>
<?php //foreach($menu as $dat_menu){?>
<div class="col-md-12">
	<div class="card">
    	<div class="card-header">
        	<strong class="card-title">
            	Hasil <?php
				$tgl1=$_GET['tgl1'];
				$tgl2=$_GET['tgl2']; 
				echo $tgl1." Sampai ". $tgl2;?>
                <a href="<?=site_url("owner_laporan/cetak_comsumtion?tgl1=$tgl1&tgl2=$tgl2")?>" class="btn btn-primary">
                	<i class="fa fa-print"></i> Cetak
                </a>
            </strong>
     	</div>
 		<div class="card-body">
        	<table class="table table-striped table-bordered">
           		<thead>
                	<tr>
                        <th>Kode</th>
                        <th>Nama Menu</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                        
                  	</tr>
          		</thead>
       			<tbody>
                	<?php foreach($laporan as $data){?>
                    <tr>
                    	<td><?php echo $data["kode"]?></td>
                    	<td><?php echo $data["nama_menu"]?></td>
                        <td><?php echo $data["qty"]?></td>
                        <td><?php echo $data["harga"]?></td>
                        <td>
							<?php
							$total =$data["qty"]*$data["harga"];
							echo number_format($total, 0, ".", ".");
							?>
                     	</td>
                    </tr>
					<?php 
						$grand_total= $grand_total + $total;
					}?> 
                    <tr>
                    	<td colspan="4" align="right"><strong>GRAND TOTAL</strong></td>
                    	<td><?php echo number_format($grand_total, 0, ".", ".");?></td>
                    </tr>
                </tbody>
     		</table>
    	</div>
   	</div>
</div>
<?php #}?>

<?php  //echo var_dump($incoming);?>