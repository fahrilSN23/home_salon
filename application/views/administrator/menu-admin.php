<section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
            <?php $usr = $this->model_app->view_where('users', array('username'=> $this->session->username))->row_array();
                  if (trim($usr['foto'])==''){ $foto = 'blank.png'; }else{ $foto = $usr['foto']; } ?>
            <img src="<?php echo base_url(); ?>/asset/foto_user/<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <?php echo "<p>$usr[nama_lengkap]</p>"; ?>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style='text-transform:uppercase;'>MENU <span class='uppercase'><?php echo $this->session->tipe; ?></span></li>

            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

            <?php if($this->session->tipe=='Kasir') { ?>
            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-th-list"></i> <span>Master</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                if($this->session->tipe=='Kasir'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/terapis'><i class='fa fa-circle-o'></i> Terapis</a></li>";
                }

                if($this->session->tipe=='Kasir'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/pelanggan'><i class='fa fa-circle-o'></i> Pelanggan</a></li>";
                }

                if($this->session->tipe=='Kasir'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/jenisperawatan'><i class='fa fa-circle-o'></i> Jenis Perawatan</a></li>";
                }

                if($this->session->tipe=='Kasir'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/produkperawatan'><i class='fa fa-circle-o'></i> Produk Perawatan</a></li>";
                }
              ?>
              </ul>
            </li>
            <?php } ?>

            <?php if($this->session->tipe=='Kasir') { ?>
            <li class="treeview">
              <a href="#"><i class="fa fa-globe"></i> <span>Modul Web</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                if($this->session->tipe=='Kasir'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/identitas'><i class='fa fa-circle-o'></i> Identitas Website</a></li>";
                }

                if($this->session->tipe=='Kasir'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/tentangkami'><i class='fa fa-circle-o'></i> Tentang Kami</a></li>";
                }

                if($this->session->tipe=='Kasir'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/jamoperasional'><i class='fa fa-circle-o'></i> Jam Operasional</a></li>";
                }
              ?>
              </ul>
            </li>
            <?php } ?>

            <?php if($this->session->tipe=='Kasir') { ?>
            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/pemesanan"><i class="fa fa-shopping-cart"></i> <span>Data Pemesanan</span></a></li>
            <?php } ?>

            <?php if($this->session->tipe=='Kasir' || $this->session->tipe=='Pimpinan') { ?>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Laporan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
              <ul class="treeview-menu">
                <?php 
                  if($this->session->tipe=='Kasir' || $this->session->tipe=='Pimpinan'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/lap_produkperawatan'><i class='fa fa-circle-o'></i> Produk Perawatan</a></li>";
                  }

                  if($this->session->tipe=='Kasir' || $this->session->tipe=='Pimpinan'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/lap_pemesanan'><i class='fa fa-circle-o'></i> Pemesanan</a></li>";
                  }
                ?>
              </ul>
            </li>
            <?php } ?>

            <?php if($this->session->tipe=='Kasir') { ?>
            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/manajemenuser"><i class="fa fa-users"></i> <span>Manajemen User</span></a></li>
            <?php } ?>

            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
          </ul>
        </section>