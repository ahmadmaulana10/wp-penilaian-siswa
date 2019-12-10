<!-- PAGE CONTAINER-->
<div class="page-container">

     <!-- TOPBAR-->
     <header class="header-desktop">
          <div class="section__content section__content--p30">
               <div class="container-fluid">
                    <div class="header-wrap">
                         <form class="form-header" action="" method="POST"></form>
                         <div class="header-button">
                              <div class="account-wrap">
                                   <div class="account-item clearfix js-item-menu">
                                        <div class="image rounded-circle">
                                             <img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" alt="John Doe" />
                                        </div>
                                        <!-- Nama di topbar -->
                                        <div class="content">
                                             <a class="js-acc-btn" href="#">Hai, <?= ucwords($user['nama']); ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                             <div class="info clearfix">
                                                  <div class="image">
                                                       <a href="<?= base_url('assets/'); ?>#">
                                                            <img src="" alt="">
                                                            <img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" />
                                                       </a>
                                                  </div>

                                                  <!-- Detail setelah di klik -->
                                                  <div class="content">
                                                       <h5 class="name">
                                                            <a href=""><?= ucwords($user['nama']); ?></a>
                                                       </h5>
                                                       <span class="email"><?= $user['email']; ?></span>
                                                  </div>
                                             </div>
                                             <div class="account-dropdown__body">
                                                  <div class="account-dropdown__item">
                                                       <a href="<?= base_url('user'); ?>">
                                                            <i class="fas fa-fw fa-user"></i>Profil</a>
                                                  </div>
                                                  <div class="account-dropdown__item">
                                                       <a href="<?= base_url('admin/ubah_profil'); ?>">
                                                            <i class="fas fa-fw fa-user"></i>Ubah Profil</a>
                                                  </div>
                                             </div>
                                             <div class="account-dropdown__footer">
                                                  <a href="<?= base_url('auth/logout'); ?>" onclick="return confirm('Yakin ingin logout?'); ">
                                                       <i class="fas fa-fw fa-sign-out-alt"></i>Logout</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </header>
     <!-- END TOPBAR-->