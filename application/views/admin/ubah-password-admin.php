<!-- MAIN CONTENT-->
<div class="main-content">
     <div class="section__content section__content--p30">
          <div class="container-fluid">
               <?= $this->session->flashdata('pesan'); ?>
               <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

               <div class="row">
                    <div class="col-lg-6">
                         <?= $this->session->flashdata('message'); ?>
                         <form action="<?= base_url('admin/ubahPassword'); ?>" method="post">
                              <div class="form-group">
                                   <label for="passwordlama">Password lama</label>
                                   <input type="password" class="form-control" id="passwordlama" name="passwordlama">
                                   <?= form_error('passwordlama', '<small class="text-danger pl-4">', '</small>'); ?>
                              </div>
                              <div class="form-group">
                                   <label for="passwordbaru1">Password baru</label>
                                   <input type="password" class="form-control" id="passwordbaru1" name="passwordbaru1">
                                   <?= form_error('passwordbaru1', '<small class="text-danger pl-4">', '</small>'); ?>
                              </div>
                              <div class="form-group">
                                   <label for="passwordbaru2">Ulangi password baru</label>
                                   <input type="password" class="form-control" id="passwordbaru2" name="passwordbaru2">
                                   <?= form_error('passwordbaru2', '<small class="text-danger pl-4">', '</small>'); ?>
                              </div>
                              <div class="form-group">
                                   <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-edit"></i> &nbsp; Ubah Password</button>
                              </div>
                         </form>
                    </div>
               </div>