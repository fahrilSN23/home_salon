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


  <!-- price section -->

  <section class="price_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Produk Perawatan<?=isset($sub_title) ? $sub_title : null?>
        </h2>
      </div>
      <div class="price_container">
        <?php foreach ($record1 as $p) {
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
    </div>
  </section>

  <!-- end price section -->