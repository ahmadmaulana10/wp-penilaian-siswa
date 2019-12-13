<!-- MAIN CONTENT-->
<div class="main-content">
     <div class="section__content section__content--p30">
          <div class="container-fluid">
               <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
               <?= $this->session->flashdata('message'); ?>

               <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                         <div class="col-md-4">
                              <img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" class="card-img" alt="...">
                         </div>

                         <div class="col-md-8">
                              <div class="card-body">
                                   <h4 class="card-title"><?= ucwords($user['nama']); ?></h4>
                                   <p class="card-text"><?= $user['email']; ?></p>
                                   <p class="card-text"><small class="text-muted">Jadi user sejak: <br><b><?= date('d F Y', $user['tanggal_buat']); ?></b></small></p>
                                   <a href="<?= base_url('user/ubah_profil'); ?>" class="btn btn-primary btn-sm mt-2 pl-4 pr-4"><i class="fas fa-edit"></i> Ubah Profil</a>
                              </div>
                         </div>
                    </div>
               </div>