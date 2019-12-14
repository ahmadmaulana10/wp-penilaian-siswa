<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 ml-2">
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="h3 mb-4 text-gray-800 mb-5"><?= $title; ?></h1>
                    <div class="col-lg-11">

                        <?= form_open_multipart('admin/tambah_siswa'); ?>

                        <div class="form-group row">
                            <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nisn" name="nisn" value="<?= set_value('nisn'); ?>" placeholder="Ketik NISN. . .">
                                <?= form_error('nisn', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_siswa" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= set_value('nama_siswa'); ?>" placeholder="Ketik Nama lengkap. . .">
                                <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= set_value('tempat_lahir'); ?>" placeholder="Ketik Tempat Lahir. . . ">
                                <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                                <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= set_value('alamat'); ?>" placeholder="Ketik Alamat. . . ">
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jk" class="col-sm-2 col-form-label">JK</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="jk" name="jk" value="<?= set_value('jk'); ?>" placeholder="Ketik Jenis Kelamin. . . ">
                                <?= form_error('jk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">Gambar</div>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="gambar">Pilih file</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary pl-4 pr-4 mr-3">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>

                                <a href="<?= base_url('admin/data-user'); ?>" class="btn btn-dark pl-3 pr-3" onclick="window.history.go(-1)">
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