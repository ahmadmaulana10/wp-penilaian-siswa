<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 ml-2">
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="h3 mb-4 text-gray-800 mb-5"><?= $title; ?></h1>
                    <div class="col-lg-11">

                        <form action="" method="post">
                            <!-- <?= form_open_multipart('admin/ubah_siswa'); ?> -->

                            <div class="form-group row">
                                <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nisn" readonly value="<?= $siswa['nisn']; ?>" placeholder="Ketik NISN. . .">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_siswa" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nama_siswa" value="<?= $siswa['nama_siswa']; ?>" placeholder="Ketik Nama lengkap. . .">
                                    <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="tempat_lahir" value="<?= $siswa['tempat_lahir']; ?>" placeholder="Ketik Tempat Lahir. . . ">
                                    <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-8">
                                    <input type="date" id="date" class="form-control" name="tgl_lahir" value="<?= $siswa['tgl_lahir']; ?>">
                                    <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role_id" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-5">
                                    <select name="agama" class="form-control form-control-user">
                                        <option value="">--Pilih Agama--</option>
                                        <option value="islam" <?= $siswa['agama'] == "islam" ? "selected='selected'" : ""  ?>>Islam</option>
                                        <option value="kristen" <?= $siswa['agama'] == "kristen" ? "selected='selected'" : ""  ?>>Kristen</option>
                                        <option value="hindu" <?= $siswa['agama'] == "hindu" ? "selected='selected'" : ""  ?>>Hindu</option>
                                        <option value="budha" <?= $siswa['agama'] == "budha" ? "selected='selected'" : ""  ?>>Budha</option>
                                        <option value="konghucu" <?= $siswa['agama'] == "konghucu" ? "selected='selected'" : ""  ?>>Konghucu</option>
                                    </select>
                                    <?= form_error('agama', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="alamat" value="<?= $siswa['alamat']; ?>" placeholder="Ketik Alamat. . . ">
                                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-8">
                                    <select name="kelas" id="" class="form-control">
                                        <option value="" <?= $siswa['kelas'] == "" ? "selected='selected'" : ""  ?>> Pilih Kelas . . . </option>
                                        <option value="I" <?= $siswa['kelas'] == "I" ? "selected='selected'" : ""  ?>> Kelas I </option>
                                        <option value="II" <?= $siswa['kelas'] == "II" ? "selected='selected'" : ""  ?>> Kelas II </option>
                                        <option value="III" <?= $siswa['kelas'] == "III" ? "selected='selected'" : ""  ?>> Kelas III </option>
                                    </select>
                                    <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-8 ml-2">
                                    <label class="col-sm-2 col-form-label">
                                        <input type="radio" name="jk" value="l" class="form-check-input" <?= set_value('jk', $siswa['jk']) == "l" ? "checked" : ""; ?>>Laki-Laki
                                    </label>
                                    <label class="col-sm-2 col-form-label">
                                        <input type="radio" name="jk" value="p" class="form-check-input" <?= set_value('jk', $siswa['jk']) == "p" ? "checked" : ""; ?>>Perempuan
                                    </label><br>
                                    <?= form_error('jk', '<small class="text-danger ml-2">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary pl-4 pr-4 mr-3">
                                        <i class="fas fa-edit"></i> Tambah
                                    </button>

                                    <a href="<?= base_url('admin/data-siswa'); ?>" class="btn btn-dark pl-3 pr-3" onclick="window.history.go(-1)">
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