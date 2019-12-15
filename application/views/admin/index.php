<!-- MAIN CONTENT-->
<div class="main-content">
     <div class="section__content section__content--p30">
          <div class="container-fluid">
               <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
               <?= $this->session->flashdata('message'); ?>

               <div class="row">
                    <!-- Jumlah guru -->
                    <div class="col-xl-4 col-md-6 mb-4">
                         <div class="card border-left-danger">
                              <div class="card-body">
                                   <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                             <div class="text-md font-weight-bold text-uppercase mb-1">Jumlah Guru</div>
                                             <div class="h1 mb-0 font-weight-bold">
                                                  <?= $this->ModelUser->getUserWhere(['role_id' => 2])->num_rows(); ?>
                                             </div>
                                        </div>

                                        <div class="col-auto">
                                             <a href="<?= base_url('admin/data_guru'); ?>"><i class="fas fa-fw fa-university fa-3x text-warning"></i></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <!-- Jumlah siswa -->
                    <div class="col-xl-4 col-md-6 mb-4">
                         <div class="card border-left-primary shadow">
                              <div class="card-body">
                                   <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                             <div class="text-md font-weight-bold text-uppercase mb-1">Jumlah Siswa</div>
                                             <div class="h1 mb-0 font-weight-bold">
                                                  <?= $this->ModelSiswa->totalRows(); ?>
                                             </div>
                                        </div>

                                        <div class="col-auto">
                                             <a href="<?= base_url('admin/data_siswa'); ?>"><i class="fas fa-user fa-3x text-primary"></i></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>