    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div class="design-box">
        <img src="<?=base_url()?>template/images/design-1.png" alt="">
      </div>
      <div class="slider_number-container d-none d-md-block">
      </div>
      <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail_box">
                    <h1>
                      Home Salon
                    </h1>
                    <p>
                      <?=$description?>
                    </p>
                    <div>
                      <a href="<?=base_url('produk')?>">Pesan Sekarang</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="<?=base_url()?>template/images/logo.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>

  <!-- item section -->

  <div class="item_section layout_padding2">
    <div class="container">
      <div class="item_container">
        <?php foreach ($record as $jp) { ?>
        <a href="<?=base_url()?>produk/jenis_perawatan/<?=$jp['id_jenis']?>" style="color: #000;">
          <div class="box">
            <div class="price">
              <h6>
                <?=$jp['jenis_perawatan']?>
              </h6>
            </div>
            <div class="name">
              <h5>
                <?=$jp['deskripsi']?>
              </h5>
            </div>
          </div>
        </a>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- end item section -->

  <!-- about section -->

  <section class="about_section layout_padding2-top layout_padding-bottom">
    <div class="design-box">
      <img src="<?=base_url()?>template/images/design-2.png" alt="">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                <?=$tk['judul']?>
              </h2>
            </div>
            <p>
              <?=substr($tk['isi'],0,220) . "...";?>
            </p>
            <div>
              <a href="<?=base_url('tentangkami')?>">
                Selengkapnya
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="img-box">
            <img src="<?=base_url()?>template/images/logo.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- price section -->

  <section class="price_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Produk Kami
        </h2>
      </div>
      <div class="price_container">
        <?php foreach ($record1->result_array() as $p) {
        if ($this->session->level=='pelanggan'){
            echo "<form action='".base_url()."members/keranjang/$p[id_produk]' method='POST'>";
        }else{
            echo "<form action='".base_url()."produk/keranjang/$p[id_produk]' method='POST'>";
        }
        ?>
        <div class="box">
          <div class="name">
            <h6>
              <?=$p['nama']?>
            </h6>
          </div>
          <p><?=$p['deskripsi']?></p>
          <p>Waktu Perawatan : <?=$p['jam']?> jam <?=$p['menit']?> menit</p>
          <div class="detail-box">
            <h5>
              Rp. <span><?=rupiah($p['harga'])?></span>
            </h5>
            <button type="submit" class="price_btn">Pesan Sekarang</button>
          </div>
        </div>
        </form>
        <?php } ?>
      </div>
      <div class="d-flex justify-content-center">
        <a href="<?=base_url('produk')?>" class="price_btn">
          Lihat Produk
        </a>
      </div>
    </div>
  </section>

  <!-- end price section -->