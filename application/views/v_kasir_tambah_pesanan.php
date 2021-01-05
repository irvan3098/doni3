<?php echo $this->session->userdata('message'); ?>
<form method="post" action="<?=site_url('kasir_pesanan/tambah_pesanan')?>">
	<input type="number" name="meja" class="form-control" placeholder="No Meja" required>
    <input type="submit" value="tambah" class="form-control" >
</form>