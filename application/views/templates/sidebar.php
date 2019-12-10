<div class="page-wrapper">

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
                              <a href="<?= base_url('admin') ?>">
                                   <i class="fas fa-fw fa-home"></i>Dashboard</a>
                         </li>

                         <hr>

                         <li>
                              <a href="<?= base_url('admin/data_user'); ?>">
                                   <i class="fas fa-fw fa-users"></i>Data User</a>
                         </li>

                         <hr>

                         <li>
                              <a href="<?= base_url('admin/data_siswa'); ?>">
                                   <i class="fas fa-fw fa-address-card"></i>Data Siswa</a>
                         </li>
                         <li>
                              <a href="<?= base_url('admin/data_guru'); ?>">
                                   <i class="fas fa-fw fa-university"></i>Data Guru</a>
                         </li>
                         <li>
                              <a href="<?= base_url('admin/data_nilai'); ?>">
                                   <i class="fas fa-fw fa-folder"></i>Data Nilai</a>
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