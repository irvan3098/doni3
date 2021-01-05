
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
                        <th>Jumlah menu</th>
                        <th>Jumlah pesanan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($menu as $data){?>
                      <tr>
                        <td><?php echo $data["meja"]?></td>
                        <td><?php echo $data["jumlah_menu"];?></td>
                        <td><?php echo $data["jumlah_pesanan"];?></td>
                        <td>
                            <a href="<?=site_url('kasir_pembayaran/konfirmasi_pembayaran/'.$data['id_pesanan'])?>" class="btn btn-lg btn-info btn-block">
                        	<i class="fa fa-lock fa-money"></i>&nbsp;
                            <span id="payment-button-amount">Pembayaran</span>
                    		</a
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                    </div>
				</div>
            </div>