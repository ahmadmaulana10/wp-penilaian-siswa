<div class="page-wrapper">

     <!-- HEADER MOBILE-->
     <header class="header-mobile d-block d-lg-none">
          <div class="header-mobile__bar">
               <div class="container-fluid">
                    <div class="header-mobile-inner">
                         <div class="logo">
                              <span class="fa fa-graduation-cap"></span> &nbsp;
                              <p>Web Penilaian Siswa</p>
                         </div>
                         <button class="hamburger hamburger--slider" type="button">
                              <span class="hamburger-box">
                                   <span class="hamburger-inner"></span>
                              </span>
                         </button>
                    </div>
               </div>
          </div>
          <nav class="navbar-mobile">
               <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                         <li>
                              <a href="<?= base_url('user') ?>">
                                   <i class="fas fa-fw fa-home"></i>Dashboard</a>
                         </li>

                         <hr>

                         <li>
                              <a href="<?= base_url('user/ubah_profil'); ?>">
                                   <i class="fas fa-fw fa-user"></i>Ubah Profil</a>
                         </li>
                         <li>
                              <a href="<?= base_url('user/ubahPassword'); ?>">
                                   <i class="fas fa-fw fa-gears"></i>Ubah Password</a>
                         </li>

                         <hr>

                         <li>
                              <a href="<?= base_url('nilai/data_nilaiguru'); ?>">
                                   <i class="fas fa-fw fa-folder"></i>Data Nilai Siswa</a>
                         </li>

                         <hr>

                         <li>
                              <a href="#" data-toggle="modal" data-target="#logoutModal">
                                   <i class="fas fa-fw fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                         </li>
                    </ul>
               </div>
          </nav>
     </header>
     <!-- END HEADER MOBILE-->

     <!-- MENU SIDEBAR-->
     <aside class="menu-sidebar d-none d-lg-block">
          <div class="logo">
               <span class="fa fa-graduation-cap"></span> &nbsp;
               <p>Web Penilaian Siswa</p>
          </div>
          <div class="menu-sidebar__content js-scrollbar1">
               <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                         <li>
                              <a href="<?= base_url('user') ?>">
                                   <i class="fas fa-fw fa-home"></i>Dashboard</a>
                         </li>

                         <hr>

                         <li>
                              <a href="<?= base_url('user/ubah_profil'); ?>">
                                   <i class="fas fa-fw fa-user"></i>Ubah Profil</a>
                         </li>
                         <li>
                              <a href="<?= base_url('user/ubahPassword'); ?>">
                                   <i class="fas fa-fw fa-gears"></i>Ubah Password</a>
                         </li>

                         <hr>

                         <li>
                              <a href="<?= base_url('nilai/data_nilaiguru'); ?>">
                                   <i class="fas fa-fw fa-folder"></i>Data Nilai Siswa</a>
                         </li>

                         <hr>

                         <li>
                              <a href="#" data-toggle="modal" data-target="#logoutModal">
                                   <i class="fas fa-fw fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                         </li>
                    </ul>
               </nav>
          </div>


     </aside>
     <!-- END MENU SIDEBAR-->