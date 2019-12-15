<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <?= $this->session->flashdata('message'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group row justify-content-end">

                        <div class="col-sm-5">
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <div class="input-group">
                                        <input type="text" id="search_value" name="cari" placeholder="Cari berdasarkan NISN . . ." class="form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" id="search"><i class="fas fa-search"></i> Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DATA TABLE-->
                    <div class="table-responsive table-earning" id="hasil_cari">
                        <table class="table table-bordered table-data3">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">nisn</th>
                                    <th class="text-center">nama siswa</th>
                                    <th class="text-center">kelas</th>
                                    <th class="text-center">jenis kelamin</th>
                                    <th class="text-center">aksi</th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($siswa as $siswas) :
                                ?>
                                <tbody>
                                    <tr>
                                        <td align="center"><?= ++$start; ?></td>
                                        <td><?= $siswas['nisn']; ?></td>
                                        <td><?= ucwords($siswas['nama_siswa']); ?></td>
                                        <td>kelas</td>
                                        <td>jenis kelamin</td>
                                        <!-- <td><?= $siswas['kelas']; ?></td> -->
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="<?= base_url('nilai/detail_nilai/') . $siswas['nisn']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-more"></i>
                                                </a>
                                                <a href="<?= base_url('nilai/ubah_nilai/') . $siswas['nisn']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Ubah">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endforeach
                                ?>
                                </tbody>
                        </table><br>
                        <?= $this->pagination->create_links(); ?>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>