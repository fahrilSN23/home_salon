<!-- contact section -->

<section class="contact_section layout_padding">
    <div class="design-box">
      <img src="images/design-2.png" alt="">
    </div>
    <div class="container ">
      <div class="">
        <h2 class="">
          <?=$title?>
        </h2>
      </div>

    </div>
    <div class="container">
        <form action="<?=base_url()?>konfirmasi" enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div>
                    <label>No Transaksi :</label>
                    <input type="hidden" name="id" value="<?=$rows['id_pemesanan']?>" placeholder="Email" readonly/>
                    <input type="text" name="a" value="<?=$rows['no_transaksi']?>" placeholder="Email" readonly/>
                    </div>
                    <div>
                    <label>Total Harga :</label>
                    <input type="text" name="b" value="Rp. <?=rupiah($total['total'])?>" placeholder="Email" readonly/>
                    </div>
                    <div>
                    <label>Transfer ke :</label>
                    <input type="text" name="c" value="<?=$iden['nama_bank'] . " : " . $iden['rekening'] . " (a.n. " . $iden['atas_nama'] . ")"?>" placeholder="Email" readonly/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                    <label>Nama Pengirim :</label>
                    <input type="text" name="d" autofocus required/>
                    </div>
                    <div>
                    <label>Tanggal Transfer :</label>
                    <input type="date" value="<?=date('Y-m-d')?>" name="e" required/>
                    </div>
                    <div>
                    <label>Bukti Transfer :</label>
                    <input type="file" name="f" required/>
                    </div>
                    <div>
                        <button type="submit" name="submit" class="price_btn" style="color:black">Kirim</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </section>

  <!-- end contact section -->