<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 ml-2">
                    <?= $this->session->flashdata('pesan'); ?>
                    <h1 class="h3 mb-4 text-gray-800 mb-5"><?= $title; ?></h1>
                    <div class="col-lg-11">

                        <?= form_open_multipart('admin/tambah_user'); ?>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Ketik Nama lengkap. . .">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Ketik Email. . . ">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Ketik Password. . . ">
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="role_id" name="role_id" placeholder="Ketik Role Id. . . ">
                                <?= form_error('role_id', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="is_active" name="is_active" placeholder="Ketik Status. . . ">
                                <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">Gambar</div>
                            <div class="col-sm-5">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="gambar">Pilih file</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary pl-4 pr-4 mr-3"><i class="fas fa-plus"></i> Tambah</button>
                            </div>
                            <button class="btn btn-dark pl-3 pr-3" onclick="window.history.go(-1)">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>