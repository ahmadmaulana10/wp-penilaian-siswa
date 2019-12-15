<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <?= $this->session->flashdata('message'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive table-earning">
                        <table class="table table-bordered table-data3">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">nip</th>
                                    <th class="text-center">nama guru</th>
                                    <th class="text-center">tanggal lahir</th>
                                    <th class="text-center">tempat lahir</th>
                                    <th class="text-center">Jenis kelamin</th>
                                    <th class="text-center">aksi</th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($guru as $gurus) :
                                ?>
                                <tbody>
                                    <tr>
                                        <td align="center"><?= ++$start; ?></td>
                                        <td><?= $gurus['nip']; ?></td>
                                        <td><?= ucwords($gurus['nama_guru']); ?></td>
                                        <td><?= date('d-m-Y', strtotime($gurus['tgl_lahir'])); ?></td>
                                        <td><?= ucwords($gurus['tempat_lahir']); ?></td>
                                        <td><?= $gurus['jk'] == "l" ? "Laki-Laki" : "Perempuan"; ?></td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="<?= base_url('kepsek/detail_guru/') . $gurus['nip']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-more"></i>
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