 
<form method="post" action="<?=site_url('owner_laporan')?>">
<div class="col-lg-12">
 	<div class="card">
    <div class="card-header"><strong>Form</strong><small> Cari</small></div>
        	<div class="card-body card-block">
          		<div class="row form-group align-content-center">
                	<div class="col-12">
                    	<div class="input-group">
                        	<select name="menu" class="form-control">
                            	<option></option>
                                <?php foreach($menu as $dat_menu){?>
                                <option value="<?php echo $dat_menu["nama_menu"]?>"><?php echo $dat_menu["nama_menu"]?></option>
								<?php }?>
                            </select>
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
<?php foreach($menu as $dat_menu){?>
<?php 
if(empty($_POST["menu"]))
{
	
?>
	<div class="col-md-12">
	<div class="card">
    	<div class="card-header">
        	<strong class="card-title"><?php echo $dat_menu["nama_menu"];?></strong>
     	</div>
 		<div class="card-body">
        	<table class="table table-striped table-bordered">
           		<thead>
                	<tr>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Incoming</th>
                        <th>Outgoing</th>
                        <th>Qty</th>
                  	</tr>
          		</thead>
       			<tbody>
                	<tr>
                    	<td>Akumulasi</td>
                        <td></td>
                        <?php 
							foreach($akumulasi_in as $ak_in){
							if($dat_menu["id_menu"] == $ak_in["id_menu"]){
								$in_ak =$ak_in["jum_in"];
						?>
                        		<td><?php echo $ak_in["jum_in"]?></td>
						<?php
								$stock = $stock + $ak_in["jum_in"]; 
							}
								
							}
						?>
                        <?php 
							foreach($akumulasi_out as $ak_out){
							if($dat_menu["id_menu"] == $ak_out["id_menu"]){
								$out_ak = $ak_out["jum_out"];
						?>
                        		<td><?php echo $ak_out["jum_out"]?></td>
						<?php
								$stock = $stock - $ak_out["jum_out"]; 
							}else{
								echo "<td></td>";
							}
								
							}
						?>
                        	<td><?php echo $stock?></td>
                    </tr>
                	<tr>
              	<?php
					$id_menu=$dat_menu["id_menu"]; 
					for($i=1;$i<=$jum_hari;$i++)
					{
						$coba = "+ ".$i." days";
						$tanggal =  date('Y-m-d', strtotime($coba, strtotime($tgl)));
						foreach($incoming as $tgl_in)//tgl
						{
							if($tanggal == $tgl_in[$id_menu]["tgl_in"])
							{
								echo "<tr>";
								echo "<td>".$tanggal."</td>";
								echo "<td>".$tgl_in[$id_menu]["kode_in"]."</td>";
								echo "<td>".$tgl_in[$id_menu]["incoming"]."</td>";
								$dat_in = $tgl_in[$id_menu]["incoming"]; 
								$jum_in = $jum_in + $dat_in; 
								$stock = $stock + $dat_in; 
								echo "<td></td>";
								echo "<td>$stock</td>";
								echo "</tr>";
								
								//$row_tgl = $tanggal ;
							}
						}
						
						foreach($outgoing as $dat_outgoing)
						{
							if($tanggal == $dat_outgoing[$id_menu]["tgl_out"])
							{
								echo "<tr>";
								echo "<td>".$tanggal."</td>";
								echo "<td>".$dat_outgoing[$id_menu]["kode_out"]."</td>";
								echo "<td></td>";
								echo "<td>".$dat_outgoing[$id_menu]["outgoing"]."</td>";
								$stock = $stock - $dat_outgoing[$id_menu]["outgoing"]; 
								
								echo "<td>$stock</td>";
								echo "</tr>";
								$jum_out = $jum_out + $dat_outgoing[$id_menu]["outgoing"];
								$ab=0;
							}
						}
						
						
					}
					
						
				?>	
          			</tr>
                    <tr>
                    	<td><strong>Jumlah</strong></td>
                        <td></td>
                    	<?php 
							$stock = 0;
							echo "<td>".$jum_in."</td>";
                        	echo "<td>".$jum_out."</td>";
							$jum_in = 0;
							$jum_out =0;
						?>
                    </tr>
                </tbody>
     		</table>
    	</div>
   	</div>
</div>	
<?php 
}
else{
	if($dat_menu["nama_menu"] == $_POST["menu"])
		{
?>	
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"><?php echo $dat_menu["nama_menu"];?></strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Incoming</th>
                                    <th>Outgoing</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                    	<td>Akumulasi</td>
                        <td></td>
                        <?php 
							foreach($akumulasi_in as $ak_in){
							if($dat_menu["id_menu"] == $ak_in["id_menu"]){
								$in_ak =$ak_in["jum_in"];
						?>
                        		<td><?php echo $ak_in["jum_in"]?></td>
						<?php
								$stock = $stock + $ak_in["jum_in"]; 
							}
								
							}
						?>
                        <?php 
							foreach($akumulasi_out as $ak_out){
							if($dat_menu["id_menu"] == $ak_out["id_menu"]){
								$out_ak = $ak_out["jum_out"];
						?>
                        		<td><?php echo $ak_out["jum_out"]?></td>
						<?php
								$stock = $stock - $ak_out["jum_out"]; 
							}else{
								echo "<td></td>";
							}
								
							}
						?>
                        	<td><?php echo $stock?></td>
                    </tr>
                            
                	<tr>
              	<?php
					$id_menu=$dat_menu["id_menu"]; 
					for($i=1;$i<=$jum_hari;$i++)
					{
						//echo "<tr>";
						
						$coba = "+ ".$i." days";
						$tanggal =  date('Y-m-d', strtotime($coba, strtotime($tgl)));
						foreach($incoming as $tgl_in)//tgl
						{
							if($tanggal == $tgl_in[$id_menu]["tgl_in"])
							{
								echo "<tr>";
								echo "<td>".$tanggal."</td>";
								echo "<td>".$tgl_in[$id_menu]["kode_in"]."</td>";
								echo "<td>".$tgl_in[$id_menu]["incoming"]."</td>";
								$dat_in = $tgl_in[$id_menu]["incoming"]; 
								$jum_in = $jum_in + $dat_in ; 
								$stock = $stock + $dat_in; 
								echo "<td></td>";
								echo "<td>$stock</td>";
								echo "</tr>";
								$a=0;	
								//$row_tgl = $tanggal ;
							}
						}
						
						foreach($outgoing as $dat_outgoing)
						{
							if($tanggal == $dat_outgoing[$id_menu]["tgl_out"])
							{
								echo "<tr>";
								echo "<td>".$tanggal."</td>";
								echo "<td>".$dat_outgoing[$id_menu]["kode_out"]."</td>";
								echo "<td></td>";
								echo "<td>".$dat_outgoing[$id_menu]["outgoing"]."</td>";
								$stock = $stock - $dat_outgoing[$id_menu]["outgoing"]; 
								
								echo "<td>$stock</td>";
								echo "</tr>";
								$jum_out = $jum_out + $dat_outgoing[$id_menu]["outgoing"];
							}
						}
						
						
					}
					
						
				?>	
          			</tr>
                    <tr>
                    	<td><strong>Jumlah</strong></td>
                        <td></td>
                    	<?php 
							$stock = 0;
							echo "<td>".$jum_in."</td>";
                        	echo "<td>".$jum_out."</td>";
							$jum_in = 0;
							$jum_out =0;
						?>
                    </tr>
                </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php 
		}
	}
}?>
