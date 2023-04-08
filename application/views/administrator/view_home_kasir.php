<a style='color:#000' href='<?php echo base_url().$this->uri->segment(1); ?>/produkperawatan'>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Produk Perawatan</span>
        <?php $jmla = $this->model_app->view_where('produk',array('aktif'=>1))->num_rows(); ?>
        <span class="info-box-number"><?php echo $jmla; ?></span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div><!-- /.col -->
  </a>

  <a style='color:#000' href='<?php echo base_url().$this->uri->segment(1); ?>/jenisperawatan'>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-cube"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jenis Perawatan</span>
        <?php $jmlb = $this->model_app->view('jenis')->num_rows(); ?>
        <span class="info-box-number"><?php echo $jmlb; ?></span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div><!-- /.col -->
  </a>

  <a style='color:#000' href='<?php echo base_url().$this->uri->segment(1); ?>/pelanggan'>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-child"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pelanggan</span>
        <?php $jmlc = $this->model_app->view('pelanggan')->num_rows(); ?>
        <span class="info-box-number"><?php echo $jmlc; ?></span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div><!-- /.col -->
  </a>

  <a style='color:#000' href='<?php echo base_url().$this->uri->segment(1); ?>/manajemenuser'>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Users</span>
        <?php $jmld = $this->model_app->view('users')->num_rows(); ?>
        <span class="info-box-number"><?php echo $jmld; ?></span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div><!-- /.col -->
  </a>

<section class="col-lg-6 connectedSortable">

  <div class='box'>
    <div class='box-header'>
      <h3 class='box-title'>Application Buttons</h3>
    </div>
    <?php
    $jmlorder = $this->model_app->view_where('pemesanan', array('status'=>1))->num_rows(); 
    ?>
    <div class='box-body'>
      <p>Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten website anda 
          atau pilih ikon-ikon pada Control Panel di bawah ini : </p>
      <a href="<?php echo base_url().$this->uri->segment(1); ?>/pemesanan" class='btn btn-app'><span class='badge bg-green'><?= $jmlorder ?></span><i class='fa fa-shopping-cart'></i> Transaksi</a>
      <a href="<?php echo base_url().$this->uri->segment(1); ?>/identitas" class='btn btn-app'><i class='fa fa-th'></i> Identitas</a>
      <a href="<?php echo base_url().$this->uri->segment(1); ?>/tentangkami" class='btn btn-app'><i class='fa fa-circle-thin'></i> Tentang Kami</a>
      <a href="<?php echo base_url().$this->uri->segment(1); ?>/terapis" class='btn btn-app'><i class='fa fa-users'></i> Terapis</a>
    </div>
  </div>
</section><!-- /.Left col -->
