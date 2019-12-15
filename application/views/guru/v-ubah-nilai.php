<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 ml-2">
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="h3 mb-4 text-gray-800 mb-5"><?= $title; ?></h1>
                    <div class="col-lg-11">

                        <form action="" method="post">
                            <?= form_open_multipart('nilai/ubah_nilai'); ?>
                            <input type="hidden" name="nisn" value="<?= $siswa['nisn']; ?>">
                            <div class="form-group row">
                                <label for="indonesia" class="col-sm-3 col-form-label">Bahasa Indonesia</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="indonesia" value="<?= $siswa['indonesia']; ?>" placeholder="Ketik nilai. . .">
                                    <?= form_error('indonesia', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="matematika" class="col-sm-3 col-form-label">Matematika</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="matematika" value="<?= $siswa['matematika']; ?>" placeholder="Ketik nilai. . .">
                                    <?= form_error('matematika', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ipa" class="col-sm-3 col-form-label">IPA</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="ipa" value="<?= $siswa['ipa']; ?>" placeholder="Ketik nilai. . .">
                                    <?= form_error('ipa', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary pl-4 pr-4 mr-3">
                                        <i class="fas fa-edit"></i> Ubah
                                    </button>

                                    <a href="<?= base_url('nilai'); ?>" class="btn btn-dark pl-3 pr-3" onclick="window.history.go(-1)">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>