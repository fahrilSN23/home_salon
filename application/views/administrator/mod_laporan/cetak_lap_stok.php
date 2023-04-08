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
    <title>LAPORAN KETERSEDIAAN PRODUK PERAWATAN</title>
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
    <h2 class="text-center">Laporan Ketersediaan Produk Perawatan</h2>
    <hr>
    <div class="col-xs-12">  
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $title ?></h3>
            </div><!-- /.box-header -->
        <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th style='width:20px'>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Waktu</th>
                <th>Aktif</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            foreach ($record as $row){
            // Jam
            if ($row['jam'] == null) {
                $jam = '0';
            }else{
                $jam = $row['jam'];
            }
            // Menit
            if ($row['menit'] == null) {
                $menit = '0';
            }else{
                $menit = $row['menit'];
            }
            // aktif
            if ($row['aktif'] == 1) {
                $aktif = 'Aktif';
            }else{
                $aktif = 'Tidak Aktif';
            }
            echo "<tr><td>$no</td>
                        <td>$row[nama]</td>
                        <td>Rp. " . rupiah($row['harga']) . "</td>
                        <td>$row[deskripsi]</td>
                        <td>$jam Jam $menit Menit</td>
                        <td>$aktif</td>
                    </tr>";
                $no++;
            }
            ?>
            </tbody>
        </table>
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
