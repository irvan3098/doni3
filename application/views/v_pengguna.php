 <?php echo $this->session->userdata('message'); ?>
 <div class="col-lg-6">
        	<div class="card">
            	<div class="card-header">
                	<strong>Tambah data admin</strong>
            	</div>
              	<div class="card-body card-block">
                	<form method="post" action="<?=site_url("pengguna/tambah")?>">
                        <div class="row form-group">
                            <div class="col col-md-3">
                            	<label for="nama">Nama</label>
							</div>
                            <div class="col-12 col-md-9">
                            <input id="nama" name="nama" class="form-control" type="text" title="Tolong isi terlebih dahulu" required>
                        	</div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                            	<label for="level">Level</label>
							</div>
                            <div class="col-12 col-md-9">
                            <select name="level" class="form-control">
                            	<option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="owner">Owner</option>
                                <option value="pelayan">Pelayan</option>
                                <option value="koki">Koki</option>
                            </select>
                        	</div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                            	<label for="password">Password</label>
							</div>
                            <div class="col-12 col-md-9">
                            <input type="password" name="password" class="form-control" title="Tolong pilih terlebih dahulu" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                            	
							</div>
                            <div class="col-12 col-md-9">
                            <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Tambah
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                        	</div>
                        </div>
              		</form>
                      
                </div>
            </div>
       	</div>
<div class="col-md-12">
            	<div class="card">
               		<div class="card-header">
                  		<strong class="card-title">Data Pengguna</strong>
                	</div>
         			<div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    	</tr>
                    </thead>
                    <tbody>
                      <?php foreach($data as $row){?>
                      <tr>
                        <td><?php echo $row["nama_pengguna"];?></td>
                        <td><?php echo $row["level"];?></td>
                        <td><?php echo $row["password"];?></td>
                        <td>
                        	<a href="#" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#hapus<?php echo $row["id_pengguna"]?>">
                            	<i class="fa fa-trash"></i>
                            </a>
                            <div class="modal fade" id="hapus<?php echo $row["id_pengguna"]?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header badge-danger">
                                            <h5 class="modal-title" id="hapuslebel<?php echo $row["id_pengguna"]?>">Hapus data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                            	Apakah anda yakin akan menghapus data ini?
                                            </p>
                                        </div>
                                       <div class="modal-footer">
                                        <form method="post" action="<?=site_url("pengguna/hapus");?>">
                                        <input type="hidden" name="id_pengguna" value="<?php echo $row["id_pengguna"]?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-danger">Ya</button>
                                        </form>
                                    </div>
                                            
                                    </div>
                                </div>
                			</div>
                            <a href="#" class="btn btn-lg btn-info" data-toggle="modal" data-target="#<?php echo $row["id_pengguna"]?>">
                            	<i class="fa fa-edit"></i>
                            </a>
                            <div class="modal fade" id="<?php echo $row["id_pengguna"]?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="lebel<?php echo $row["id_pengguna"]?>">Ubah data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="<?=site_url("pengguna/ubah");?>">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="unama">Nama</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                <input id="unama" name="unama" class="form-control" type="text" value="<?php echo $row["nama_pengguna"];?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="utmp_lahir">Level</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                <select name="ulevel" class="form-control">
                                                	<option value="<?php echo $row["level"];?>"><?php echo $row["level"];?></option>
                                                    <option value="admin">Admin</option>
                                                    <option value="kasir">Kasir</option>
                                                    <option value="owner">Owner</option>
                                                    <option value="pelayan">Pelayan</option>
                                                    <option value="koki">Koki</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="upassword">Password</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                <input type="password" name="upassword" class="form-control" required value="<?php echo $row["password"];?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    
                                                </div>
                                                <div class="col-12 col-md-9">
                                                <input type="hidden" name="id_pengguna" value="<?php echo $row["id_pengguna"];?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        		<button type="submit" class="btn btn-primary">Ubah</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                   
                                    	
                                </div>
                            </div>
                </div>
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                    </div>
				</div>
            </div>