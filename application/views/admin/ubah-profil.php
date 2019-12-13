<!-- MAIN CONTENT-->
<div class="main-content">
     <div class="section__content section__content--p30">
          <div class="container-fluid">
               <?= $this->session->flashdata('message'); ?>
               <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

               <div class="row">
                    <div class="col-lg-11">
                         <?= form_open_multipart('admin/ubah_profil'); ?>
                         <div class="form-group row">
                              <label for="email" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                   <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                              </div>
                         </div>

                         <div class="form-group row">
                              <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                              <div class="col-sm-10">
                                   <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                                   <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                         </div>

                         <div class="form-group row">
                              <div class="col-sm-2">Gambar</div>
                              <div class="col-sm-10">
                                   <div class="row">
                                        <div class="col-sm-3">
                                             <img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" class="img-thumbnail" alt="">
                                        </div>

                                        <div class="col-sm-9">
                                             <div class="custom-file">
                                                  <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                                  <label class="custom-file-label" for="gambar">Pilih file</label>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="form-group row justify-content-end">
                              <div class="col-sm-10">
                                   <button type="submit" class="btn btn-primary pl-4 pr-4 mr-3"><i class="fas fa-edit"></i> Ubah</button>
                                   <a href="<?= base_url('admin'); ?>" class="btn btn-dark pl-3 pr-3"><i class="fa fa-arrow-left"></i> Kembali</a>
                              </div>
                         </div>
                         </form>
                    </div>
               </div>