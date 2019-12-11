<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9 ml-3">
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    <table class="table table-striped table-bordered">
                        <?php
                        foreach ($user as $users) :
                            ?>
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td><?= $users['nama']; ?></td>
                                    <!-- <td rowspan="4">
                                        <img src="<?= base_url('assets/img/profile/') . $users['gambar']; ?>" class="img-thumbnail" alt="">
                                    </td> -->
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?= $users['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Level</td>
                                    <td>
                                        <?php if ($users['role_id'] == 1) {
                                                echo "<p class='text-danger'>admin</p>";
                                            } elseif ($users['role_id'] == 2) {
                                                echo "<p class='text-success'>guru</p>";
                                            } elseif ($users['role_id'] == 3) {
                                                echo "<Kepala class='text-primary'>Kepala Sekolah</span>";
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <?php if ($users['is_active'] == 1) {
                                                echo "<span class='status--process'>Aktif</span>";
                                            } elseif ($users['is_active'] == 0) {
                                                echo "<span class='status--denied'>Nonaktif</span>";
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gambar</td>
                                    <td>
                                        <img src="<?= base_url('assets/img/profile/') . $users['gambar']; ?>" class="img-thumbnail" alt="">
                                    </td>
                                </tr>
                            </tbody>
                        <?php
                        endforeach
                        ?>
                    </table>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm mt-3">
                            <button class="btn btn-dark pl-3 pr-3" onclick="window.history.go(-1)"><i class="fa fa-arrow-left"></i> Kembali</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>