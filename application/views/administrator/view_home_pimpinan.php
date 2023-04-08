<section class="col-lg-6 connectedSortable">
<?php $usr = $this->model_app->view_where('users', array('username'=> $this->session->username))->row_array(); ?>
  <div class='box'>
    <div class='box-header'>
      <h3 class='box-title'>Selamat Datang Owner <b><?=$usr['nama_lengkap']?></b></h3>
    </div>
    <div class='box-body'>
      <p>Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten website anda</p>
    </div>
  </div>
</section><!-- /.Left col -->
