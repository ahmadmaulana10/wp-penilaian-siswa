<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9 ml-3">
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td>NISN</td>
                                <td><?= $guru['nip']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td><?= ucwords($guru['nama_guru']); ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td><?= $guru['tgl_lahir']; ?></td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td><?= ucwords($guru['tempat_lahir']); ?></td>
                            </tr>
                            <td>Jenis Kelamin</td>
                            <td><?= $guru['jk'] == "l" ? "Laki-Laki" : "Perempuan"; ?></td>
                            </tr>
                        </tbody>
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