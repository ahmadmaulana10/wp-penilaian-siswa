<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <?= $this->session->flashdata('message'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group row justify-content-end">
                        <div class="col-sm">
                            <a href="<?= base_url('admin/tambah_siswa'); ?>" class="btn btn-success mb-3">
                                <i class="fas fa-siswa-plus"></i> Tambah siswa
                            </a>
                        </div>
                    </div>
                    <!-- DATA TABLE-->
                    <div class="table-responsive table-earning">
                        <table class="table table-bordered table-data3">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">nisn</th>
                                    <th>nama siswa</th>
                                    <th class="text-center">tempat lahir</th>
                                    <th class="text-center">tanggal lahir</th>
                                    <th class="text-center">alamat</th>
                                    <th class="text-center">jk</th>
                                    <th class="text-center">gambar</th>
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
                                        <td><?= ucwords($siswas['tempat_lahir']); ?></td>
                                        <td><?= $siswas['tgl_lahir']; ?></td>
                                        <td><?= ucwords($siswas['alamat']); ?></td>
                                        <td><?= ucwords($siswas['jk']); ?></td>
                                        <td align="center"><img src="<?= base_url('assets/img/profile/') ?><?= $siswas['gambar']; ?>" class="gambar rounded"></td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="<?= base_url('admin/detail_siswa/') . $siswas['nisn']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-more"></i>
                                                </a>
                                                <a href="<?= base_url('admin/ubah_siswa/') . $siswas['nisn']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Ubah">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <button class="item" onclick="
                                                    // validasi ketika tombol hapus diklik
                                                    if (confirm('Yakin mau dihapus ?')) {
                                                        window.location.href = '<?= base_url('admin/hapus_siswa/') . $siswas['nisn']; ?>';
                                                    }
                                                    " data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
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