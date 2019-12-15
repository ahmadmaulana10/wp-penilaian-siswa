<!-- PAGE CONTAINER-->
<div class="page-container">

     <!-- HEADER DESKTOP-->
     <header class="header-desktop">
          <div class="section__content section__content--p30">
               <div class="container-fluid">
                    <div class="header-wrap">
                         <form class="form-header" action="" method="POST">
                              <!-- <input class="au-input au-input--xl" type="text" name="search" placeholder="Cari sesuatu . . ." />
                              <button class="au-btn--submit" type="submit">
                                   <i class="zmdi zmdi-search"></i>
                              </button> -->
                         </form>
                         <div class="header-button">
                              <div class="noti-wrap">
                                   <div class="noti__item js-item-menu">
                                        <!-- <i class="zmdi zmdi-comment-more"></i> -->
                                        <!-- <span class="quantity">1</span> -->
                                   </div>
                                   <div class="noti__item js-item-menu">
                                        <!-- <i class="zmdi zmdi-email"></i> -->
                                        <!-- <span class="quantity">1</span> -->
                                   </div>
                                   <div class="noti__item js-item-menu">
                                        <!-- <i class="zmdi zmdi-notifications"></i> -->
                                        <!-- <span class="quantity"></span> -->
                                   </div>
                              </div>
                              <div class="account-wrap">
                                   <div class="account-item clearfix js-item-menu">
                                        <div class="image rounded-circle">
                                             <img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" />
                                        </div>
                                        <div class="content">
                                             <a class="js-acc-btn" href="#">Hai, <?= ucwords($user['nama']); ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                             <div class="info clearfix">
                                                  <div class="image rounded-circle">
                                                       <a href="#">
                                                            <img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" />
                                                       </a>
                                                  </div>
                                                  <div class="content">
                                                       <h5 class="name">
                                                            <a href="#"><?= ucwords($user['nama']); ?></a>
                                                       </h5>
                                                       <span class="email"><?= $user['email']; ?></span>
                                                  </div>
                                             </div>
                                             <!-- <div class="account-dropdown__body">
                                                  <div class="account-dropdown__item">
                                                       <a href="<?= base_url('admin/ubah_profil'); ?>">
                                                            <i class="fas fa-fw fa-user"></i>Ubah Profil</a>
                                                  </div>
                                             </div> -->
                                             <div class="account-dropdown__footer">
                                                  <a href="<?= base_url('auth/logout'); ?>" onclick="return confirm('Pilih OK jika ingin keluar dari aplikasi.'); ">
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
     <!-- HEADER DESKTOP-->