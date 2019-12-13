<!-- MAIN CONTENT-->
<div class="main-content">
     <div class="section__content section__content--p30">
          <div class="container-fluid">
               <?= $this->session->flashdata('pesan'); ?>
               <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


               <div class="row">
                    <div class="col-lg-11">
                         <form action="" method="post">
                              <!-- <?= form_open_multipart('admin/ubah_user'); ?> -->
                              <input type="hidden" name="id" value="<?= $user['id']; ?>">

                              <div class="form-group row">
                                   <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                   </div>
                              </div>

                              <div class="form-group row">
                                   <label for="email" class="col-sm-2 col-form-label">Email</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                                   </div>
                              </div>

                              <div class="row form-group">
                                   <div class="col col-sm-2">
                                        <label class=" form-control-label">Level</label>
                                   </div>
                                   <div class="col col-sm-10">
                                        <div class="form-check-inline form-check">
                                             <label for="role_id" class="form-check-label ">
                                                  <input type="radio" id="role_id1" name="role_id" value="1" class="form-check-input">Admin
                                             </label> &nbsp;
                                             <label for="role_id" class="form-check-label ">
                                                  <input type="radio" id="role_id2" name="role_id" value="2" class="form-check-input">Guru
                                             </label> &nbsp;
                                             <label for="role_id" class="form-check-label ">
                                                  <input type="radio" id="role_id3" name="role_id" value="3" class="form-check-input">Kepala Sekolah
                                             </label>
                                             <?= form_error('role_id', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                   </div>
                              </div>

                              <div class="row form-group">
                                   <div class="col col-sm-2">
                                        <label class=" form-control-label">Status</label>
                                   </div>
                                   <div class="col col-sm-10">
                                        <div class="form-check-inline form-check">
                                             <label for="is_active" class="form-check-label ">
                                                  <input type="radio" id="is_active1" name="is_active" value="1" class="form-check-input">Aktif
                                             </label> &nbsp;
                                             <label for="is_active" class="form-check-label ">
                                                  <input type="radio" id="is_active2" name="is_active" value="0" class="form-check-input">Tidak Aktif
                                             </label> &nbsp;
                                             <?= form_error('is_active', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                   </div>
                              </div>

                              <div class="form-group row justify-content-end">
                                   <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary pl-4 pr-4 mr-3"><i class="fas fa-edit"></i> Ubah</button>
                                        <a href="<?= base_url('admin/data-user'); ?>" class="btn btn-dark pl-3 pr-3" onclick="window.history.go(-1)"><i class="fa fa-arrow-left"></i> Kembali</a>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>