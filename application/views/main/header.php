<header class="header_section">
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="<?=base_url()?>">
        <img src="<?=base_url()?>template/images/logo.png" alt="">
        <span>
            Home Salon
        </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
            <ul class="navbar-nav  ">
            <li class="nav-item active">
                <a class="nav-link" href="<?=base_url()?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('tentangkami')?>">Tentang Kami </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('produk')?>">Porduk Perawatan </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?=base_url('kontak')?>">Kontak Kami</a>
            </li> -->
            <?php if ($this->session->id_pelanggan != '') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('members/profile')?>">Profile</a>                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('members/pesanan')?>">Pesanan Saya</a>                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('auth/logout')?>">Logout</a>                    
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('auth/login')?>">Login</a>
                </li>
            <?php } ?>
            </ul>

        </div>
        <div class="quote_btn-container ">
            <?php if ($this->session->id_pelanggan != '') {
          	$isi_keranjang = $this->db->query("SELECT * FROM pemesanan a JOIN detil_pemesanan b ON b.id_pemesanan = a.id_pemesanan WHERE a.id_pemesanan='".$this->session->idp."' AND a.status = 0")->num_rows(); ?>
                <a href="<?=base_url()?>members/keranjang">
                <img src="<?=base_url()?>template/images/cart.png" alt="">
                <div class="cart_number">
                    <b><?=$isi_keranjang?></b>
                </div>
                </a>
            <?php }else {
          	$isi_keranjang = $this->db->query("SELECT * FROM pemesanan_temp where session='".$this->session->idp."'")->num_rows(); ?>
                <a href="<?=base_url()?>produk/keranjang">
                <img src="<?=base_url()?>template/images/cart.png" alt="">
                <div class="cart_number">
                    <b><?=$isi_keranjang?></b>
                </div>
                </a>
            <?php } ?>
        </div>
        </div>
    </nav>
    </div>
</header>