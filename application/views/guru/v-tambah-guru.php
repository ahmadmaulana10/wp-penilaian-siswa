<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 ml-2">
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="h3 mb-4 text-gray-800 mb-5"><?= $title; ?></h1>
                    <div class="col-lg-11">

                        <?= form_open_multipart('admin/tambah_guru'); ?>

                        <div class="form-group row">
                            <label for="nisn" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nip" value="<?= set_value('nip'); ?>" placeholder="Ketik NIP . . .">
                                <?= form_error('nisn', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_siswa" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_guru" value="<?= set_value('nama_guru'); ?>" placeholder="Ketik Nama lengkap . . .">
                                <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input type="date" id="date" class="form-control" name="tgl_lahir" value="<?= date("Y-m-d"); ?>">
                                <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tempat_lahir" value="<?= set_value('tempat_lahir'); ?>" placeholder="Ketik Tempat Lahir . . . ">
                                <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-8 ml-2">
                                <label class="col-sm-2 col-form-label">
                                    <input type="radio" name="jk" value="l" class="form-check-input" <?= set_radio('jk', 'l'); ?>>Laki-Laki
                                </label>
                                <label class="col-sm-2 col-form-label">
                                    <input type="radio" name="jk" value="p" class="form-check-input" <?= set_radio('jk', 'p'); ?>>Perempuan
                                </label><br>
                                <?= form_error('jk', '<small class="text-danger ml-2">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary pl-4 pr-4 mr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>

                                <a href="<?= base_url('admin/data-guru'); ?>" class="btn btn-dark pl-3 pr-3" onclick="window.history.go(-1)">
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