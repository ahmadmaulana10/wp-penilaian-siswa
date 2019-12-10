<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive table-earning">
                        <table class="table table-bordered table-data3">
                            <thead>
                                <tr>
                                    <th>nama</th>
                                    <th>email</th>
                                    <th>Level</th>
                                    <th>status</th>
                                    <th>gambar</th>
                                    <th class="text-center">aksi</th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($user as $users) :
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?= $users['nama']; ?></td>
                                        <td><?= $users['email']; ?></td>
                                        <td>
                                            <?php if ($users['role_id'] == 1) {
                                                    echo "<span class='role admin'>admin</span>";
                                                } elseif ($users['role_id'] == 2) {
                                                    echo "<span class='role member'>guru</span>";
                                                } elseif ($users['role_id'] == 3) {
                                                    echo "<span class='role user'>Kepala Sekolah</span>";
                                                }
                                                ?>
                                        </td>
                                        <td>
                                            <?php if ($users['is_active'] == 1) {
                                                    echo "<span class='status--process'>Aktif</span>";
                                                } elseif ($users['is_active'] == 0) {
                                                    echo "<span class='status--denied'>Nonaktif</span>";
                                                }
                                                ?>
                                        </td>
                                        <td><img src="<?= base_url('assets/img/profile/') ?><?= $users['gambar']; ?>" class="gambar rounded"></td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="<?= base_url('admin/detail/') . $users['id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-more"></i>
                                                </a>
                                                <a href="<?= base_url('admin/ubah_user/') . $users['id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Ubah">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/hapus/') . $users['id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endforeach
                                ?>
                                </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>