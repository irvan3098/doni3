
<div class="col-md-12">
            	<div class="card">
               		<div class="card-header">
                  		<strong class="card-title">Detail Data Menu</strong>
                	</div>
         			<div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Meja</th>
                        <th>Bon</th>
                        <th>Jumlah Menu</th>
                        <th>Total</th>
                        <th>Cetak</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($history as $data){?>
                      <tr>
                        <td><?php echo $data["meja"]?></td>
                        <td><?php echo $data["kode"];?></td>
                        <td><?php echo $data["jum_menu"];?></td>
                        <td><?php echo number_format($data["total"], 0, ".", ".");?></td>
                        <td>
                            <a href="<?=site_url('kasir_pembayaran/cetak/'.$data['id_pesanan'])?>" class="btn btn-lg btn-info btn-block">
                        	<i class="fa fa-lock fa-print"></i>&nbsp;
                            <span id="payment-button-amount">Pembayaran</span>
                    		</a>
                            </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                    </div>
				</div>
            </div>