<?php 
if ($this->session->tipe==''){
    redirect(base_url());
}else{
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LAPORAN PEMESANAN</title>
    <meta name="author" content="phpmu.com">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>asset/images/<?php echo favicon(); ?>" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/admin/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/dist/css/style.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/dist/css/skins/_all-skins.min.css">
  </head>
  <body onload="window.print()">
    <h2 class="text-center">Laporan Pemesanan</h2>
    <h4 class="text-center">Periode : <?= tgl_indo($tgl_mulai) ?> - <?= tgl_indo($tgl_selesai) ?></h4>
    <hr>
    <div class="col-xs-12">  
        <div class="box">
            <div class="box-header">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th colspan="2">Jumlah Transaksi</th>
                        <th colspan="3"><?=$jml_transaksi?> <b>Transaksi</b></th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah Pemesanan</th>
                        <th>Total</th>
                    </tr>
                    <?php $no = 1; foreach ($record as $row) {
                    $jml_psn = $this->db->query("SELECT * FROM pemesanan a JOIN detil_pemesanan b ON a.id_pemesanan = b.id_pemesanan WHERE a.status = 4 AND b.id_produk = $row[id_produk]")->num_rows();
                    ?> 
                    <tr>
                        <td width="70px"><?= $no++ ?>.</td>
                        <td><?= $row['nama'] ?></td>
                        <td>Rp. <?= rupiah($row['harga']) ?></td>
                        <td><?= $jml_psn ?></td>
                        <td>Rp. <?= rupiah($jml_psn * $row['harga']) ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div><!-- /.box-header -->
            <h4 class="text-center">Detail Penjualan Barang</h4>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th style='width:20px'>No</th>
                        <th>No Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Treatment</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Lama Perawatan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no = 1;
                    foreach ($drecord as $row){
                    $pel = $this->model_app->view_where('pelanggan',array('id_pelanggan'=>$row['id_pelanggan']))->row_array();
                    echo "<tr><td>$no</td>
                                <td>$row[no_transaksi]</td>
                                <td>$pel[nama]</td>
                                <td>". tgl_indo($row['tanggal_treatment']) . "</td>
                                <td>$row[nama]</td>
                                <td>Rp. ".rupiah($row['harga'])."</td>
                                <td>$row[deskripsi]</td>
                                <td>$row[jam] Jam $row[menit] Menit</td>
                            </tr>";
                        $no++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- jQuery 2.1.4 -->
    <script src="asset/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>asset/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://almsaeedstudio.com/themes/AdminLTE/plugins/pace/pace.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>asset/admin/dist/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/dist/js/jquery.nestable.js"></script>
  
  </body>
</html>
<?php } ?>
