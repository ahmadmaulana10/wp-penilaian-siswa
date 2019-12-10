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
                         <li>
                              <a href="<?= base_url('user/ubahProfile'); ?>">
                                   <i class="fas fa-fw fa-user"></i>Ubah Profile</a>
                         </li>
                         <li>
                              <a href="#" data-toggle="modal" data-target="#logoutModal">
                                   <i class="fas fa-fw fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                         </li>
                    </ul>
               </nav>
          </div>


     </aside>
     <!-- END MENU SIDEBAR-->