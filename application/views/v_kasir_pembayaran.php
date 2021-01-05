<div class="col-lg-6">
            	<div class="card">
                	<div class="card-header">
                    	<strong class="card-title">Nomor Pesanan</strong>
                  	</div>
                   	<div class="card-body">
                    	<table class="table">
                        	<thead>
                            	 <tr>
                                 	<th scope="col">#</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total</th>
                                </tr>
                        	</thead>
                            <tbody>
                            	<?php
								$i=1; 
								foreach($menu as $data){
									
								?>
                                <tr>
                                	<th scope="row"><?php echo $i++;?></th>
                                 		<td><?php echo $data["nama_menu"];?></td>
                                        <td><?php echo $data["jumlah"];?></td>
                                        <td><?php echo $data["harga"];?></td>
                                        <td><?php echo $data["total"];?></td>
                                        
                            	</tr>
                                <?php 
									$total_bayar=$total_bayar+$data["total"];
								}?>
                              <form action="<?=site_url('kasir_pembayaran/simpan_pembayaran')?>" method="post">
                              	<input type="hidden" name="id_pesanan" value="<?php echo $id_pesanan?>">
                                 <tr>
                                 	<th colspan="4" rowspan="1">Total bayar</th>
                                    <th scope="col"><input type="number" name="total_bayar" id="txt1" class="form-control" value="<?php echo $total_bayar;?>" onkeyup="sum();" readonly></th>
                                </tr>
                                <tr>
                                 	<th colspan="4" rowspan="1">Pembayaran</th>
                                    <th scope="col">
                                    	<input type="number" name="pembayaran" id="txt2" class="form-control" onkeyup="sum();" required>
                                  	</th>
                                </tr>
                                <tr>
                                 	<th colspan="4" rowspan="1">Kembalian</th>
                                    <th scope="col">
                                    	<input type="number" name="kembalian" id="txt3" class="form-control" readonly required>
                                  	</th>
                                </tr>
                            </tbody>
                    	</table>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        	<i class="fa fa-lock fa-money"></i>&nbsp;
                            <span id="payment-button-amount">Konfirmasi Pembayaran</span>
                    	</button>
                        </form>
                        
                        
						
                    </div>
             	</div>
       		</div>
            <script>
			function sum() {
				  var txtFirstNumberValue = document.getElementById('txt1').value;
				  var txtSecondNumberValue = document.getElementById('txt2').value;
				  if(txtSecondNumberValue < txtFirstNumberValue)
				  {
					 //alert('Kurang cu');
					  
					}
				  var result = parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue) ;
				  if (!isNaN(result)) {
					 document.getElementById('txt3').value = result;
				  }
			}
			
			</script>