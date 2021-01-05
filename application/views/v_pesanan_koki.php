<?php echo $this->session->userdata('message'); ?>
<div class="col-md-12">
            	<div class="card">
               		<div class="card-header">
                  		<strong class="card-title">Detail Data Pesanan</strong>
                	</div>
         			<div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No pesanan</th>
                        <th>Meja</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach($menu as $data){?>
                      <tr>
                        <td><?php echo $data["id_pesanan"]?></td>
                        <td><?php echo $data["meja"];?></td>
                        <td><?php echo $data["nama_menu"];?></td>
                        <td><?php echo $data["jumlah"];?></td>
                        <td>
                            <?php
							$ubah = array(
								'class' => 'btn btn-lg btn-info'
							);
							echo anchor(site_url('kasir_pesanan/ubah_status_pesanan_koki/' . $data['id_menu']), '<i class="fa fa-check"></i>', $ubah);
							?>
                            
                      		 
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                    </div>
				</div>
            </div>