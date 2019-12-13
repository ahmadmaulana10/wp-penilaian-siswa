<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <?= $this->session->flashdata('message'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group row justify-content-end">
                        <div class="col-sm">
                            <a href="<?= base_url('admin/tambah_user'); ?>" class="btn btn-success mb-3">
                                <i class="fas fa-user-plus"></i> Tambah User
                            </a>
                        </div>
                    </div>
                    <!-- DATA TABLE-->
                    <div class="table-responsive table-earning">
                        <table class="table table-bordered table-data3">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>nama</th>
                                    <th>email</th>
                                    <th class="text-center">Level</th>
                                    <th class="text-center">status</th>
                                    <th class="text-center">gambar</th>
                                    <th class="text-center">aksi</th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($user as $users) :
                                ?>
                                <tbody>
                                    <tr>
                                        <td align="center"><?= ++$start; ?></td>
                                        <td><?= ucwords($users['nama']); ?></td>
                                        <td><?= $users['email']; ?></td>
                                        <td align="center">
                                            <?php if ($users['role_id'] == 1) {
                                                    echo "<span class='role admin'>admin</span>";
                                                } elseif ($users['role_id'] == 2) {
                                                    echo "<span class='role member'>guru</span>";
                                                } elseif ($users['role_id'] == 3) {
                                                    echo "<span class='role user'>Kepala Sekolah</span>";
                                                }
                                                ?>
                                        </td>
                                        <td align="center">
                                            <?php if ($users['is_active'] == 1) {
                                                    echo "<span class='status--process'>Aktif</span>";
                                                } elseif ($users['is_active'] == 0) {
                                                    echo "<span class='status--denied'>Nonaktif</span>";
                                                }
                                                ?>
                                        </td>
                                        <td align="center"><img src="<?= base_url('assets/img/profile/') ?><?= $users['gambar']; ?>" class="gambar rounded"></td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="<?= base_url('admin/detail_user/') . $users['id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-more"></i>
                                                </a>
                                                <a href="<?= base_url('admin/ubah_user/') . $users['id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Ubah">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <button class="item" onclick="
                                                    // validasi ketika tombol hapus diklik
                                                    if (confirm('Yakin mau dihapus ?')) {
                                                        window.location.href = '<?= base_url('admin/hapus_user/') . $users['id']; ?>';
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