<?php if($level =='admin'){?>
<ul class="nav navbar-nav">
	<li class="">
    	<a href="<?=site_url('menu')?>"> <i class="menu-icon fa fa-arrow-circle-o-right"></i>Menu </a>
   	</li>
    <li class="">
    	<a href="<?=site_url('pengguna')?>"> <i class="menu-icon fa fa-user"></i>Pengguna </a>
   	</li>
    <li class="">
    	<a href="<?=site_url('owner_menu')?>"> <i class="menu-icon fa fa-book"></i>Stock </a>
   	</li>
    <li class="">
    	<a href="<?=site_url('out_in/incoming')?>"> <i class="menu-icon fa fa-arrow-circle-o-left"></i>Incoming </a>
   	</li>
    <li class="">
    	<a href="<?=site_url('out_in/outgoing')?>"> <i class="menu-icon fa fa-arrow-circle-o-left"></i>Outgoing</a>
   	</li>
    <li>
    <a href="<?=site_url('kasir_pesanan')?>"> <i class="menu-icon fa fa-pencil"></i>Pesanan </a>
  	</li>
    <li class="">
  	<a href="<?=site_url('kasir_pembayaran')?>"> <i class="menu-icon fa fa-money"></i>Pembayaran </a>
   	</li>
    <li>
    	<a href="<?=site_url('owner_laporan');?>"> <i class="menu-icon fa fa-archive"></i>Stock Card Report</a>
    </li>
    <li>
    	<a href="<?=site_url('owner_laporan/keuangan');?>"> <i class="menu-icon fa fa-archive"></i>Comsumtion</a>
    </li>
    <li class="">
    	<a href="<?=site_url('login/logout')?>"> <i class="menu-icon fa fa-long-arrow-left"></i>Logout </a>
   	</li>
</ul>
<?php }elseif($level == 'kasir'){?>
<ul class="nav navbar-nav">
	<li class="">
    	<a href="<?=site_url('owner_menu')?>"> <i class="menu-icon fa fa-book"></i>Stock </a>
   	</li>
    <li>
    <a href="<?=site_url('kasir_pesanan')?>"> <i class="menu-icon fa fa-pencil"></i>Pesanan </a>
  	</li>
    <li class="">
  	<a href="<?=site_url('kasir_pembayaran')?>"> <i class="menu-icon fa fa-money"></i>Pembayaran </a>
   	</li>
   	<li>
    	<a href="<?=site_url('kasir_pembayaran/history_pembayaran');?>"> <i class="menu-icon fa fa-archive"></i>History Pembayaran</a>
    </li>
    <li class="">
  	<a href="<?=site_url('login/logout')?>"> <i class="menu-icon fa fa-long-arrow-left"></i>Logout </a>
    </li>
</ul>
<?php }elseif($level == 'owner'){?>
<ul class="nav navbar-nav">
	<li class="">
    	<a href="<?=site_url('menu')?>"> <i class="menu-icon fa fa-arrow-circle-o-right"></i>Menu </a>
   	</li>
    <li class="">
    	<a href="<?=site_url('owner_menu')?>"> <i class="menu-icon fa fa-book"></i>Stock </a>
   	</li>
    <li class="">
    	<a href="<?=site_url('out_in/incoming')?>"> <i class="menu-icon fa fa-arrow-circle-o-left"></i>Incoming </a>
   	</li>
    <li class="">
    	<a href="<?=site_url('out_in/outgoing')?>"> <i class="menu-icon fa fa-arrow-circle-o-left"></i>Outgoing</a>
   	</li>
    <li>
    <a href="<?=site_url('kasir_pesanan')?>"> <i class="menu-icon fa fa-pencil"></i>Pesanan </a>
  	</li>
    <li class="">
  	<a href="<?=site_url('kasir_pembayaran')?>"> <i class="menu-icon fa fa-money"></i>Pembayaran </a>
   	</li>
    <li>
    	<a href="<?=site_url('owner_laporan');?>"> <i class="menu-icon fa fa-archive"></i>Stock Card Report</a>
    </li>
    <li>
    	<a href="<?=site_url('owner_laporan/laporan_bar');?>"> <i class="menu-icon fa fa-bar-chart"></i>Penjualan hari ini</a>
    </li>
    <li>
    	<a href="<?=site_url('owner_laporan/keuangan');?>"> <i class="menu-icon fa fa-archive"></i>Comsumtion</a>
    </li>
    <li class="">
    	<a href="<?=site_url('login/logout')?>"> <i class="menu-icon fa fa-long-arrow-left"></i>Logout </a>
   	</li>
</ul>
<?php }elseif($level == 'koki'){?>
<ul class="nav navbar-nav">
	<li class="">
    	<a href="<?=site_url('owner_menu')?>"> <i class="menu-icon fa fa-book"></i>Menu </a>
   	</li>
    <li class="">
    	<a href="<?=site_url('owner_menu')?>"> <i class="menu-icon fa fa-book"></i>Stock </a>
   	</li>
	<li class="">
    	<a href="<?=site_url('kasir_pesanan/data_pesanan_koki')?>"> <i class="menu-icon fa fa-book"></i>Data Pesanan </a>
   	</li>
    <li class="">
    	<a href="<?=site_url('login/logout')?>"> <i class="menu-icon fa fa-long-arrow-left"></i>Logout </a>
   	</li>
</ul>
<?php }elseif($level == 'pelayan'){?>
<ul class="nav navbar-nav">
	<li class="">
    	<a href="<?=site_url('owner_menu')?>"> <i class="menu-icon fa fa-book"></i>Menu </a>
   	</li>
	<li>
    <a href="<?=site_url('kasir_pesanan')?>"> <i class="menu-icon fa fa-pencil"></i>Pesanan </a>
  	</li>
    <li class="">
    	<a href="<?=site_url('kasir_pesanan/data_pesanan_pelayan')?>"> <i class="menu-icon fa fa-book"></i>Data Pesanan </a>
   	</li>
    
    <li class="">
    	<a href="<?=site_url('login/logout')?>"> <i class="menu-icon fa fa-long-arrow-left"></i>Logout </a>
   	</li>
</ul>
<?php }?>