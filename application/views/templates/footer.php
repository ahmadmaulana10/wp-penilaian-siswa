<!-- Copyright -->
<div class="row">
     <div class="col-md-12">
          <div class="copyright">
               <p>Copyright © Web Penilaian Siswa <?= date('Y'); ?>.</p>
          </div>
     </div>
</div>
</div>
</div>
</div>
<!-- END MAIN CONTENT-->

<!-- END PAGE CONTAINER-->
</div>

</div>


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                    </button>
               </div>
               <div class="modal-body">Pilih "Logout" jika ingin keluar aplikasi.</div>
               <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><span class="fa fa-ban"></span> Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>"><i class="fa fa-sign-out-alt"></i> Logout</a>
               </div>
          </div>
     </div>
</div>


<!-- Jquery JS-->

<script src="<?= base_url('assets/') ?>vendor/jquery-3.4.1.js"></script>
<!-- Bootstrap JS-->
<script src="<?= base_url('assets/') ?>vendor/bootstrap-4.1/popper.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="<?= base_url('assets/') ?>vendor/slick/slick.min.js">
</script>
<script src="<?= base_url('assets/') ?>vendor/wow/wow.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/animsition/animsition.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="<?= base_url('assets/') ?>vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="<?= base_url('assets/') ?>vendor/circle-progress/circle-progress.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?= base_url('assets/') ?>vendor/chartjs/Chart.bundle.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="<?= base_url('assets/') ?>js/main.js"></script>
<script>
     // Agar cari gambar bisa menampilkan url direktori
     $('.custom-file-input').on('change', function() {
          let fileName = $(this).val().split('\\').pop();
          $(this).next('.custom-file-label').addClass("selected").html(fileName);
     });
</script>

<script>
     // event ketika tombol Cari di klik
     $('#search').on('click', function() {
          let nisn = $('#search_value').val();
          $.ajax({
               url: `<?= base_url('admin/siswa'); ?>` + '/' + nisn,
               type: 'post',
               dataType: 'json',


               success: function(data) {
                    let siswa = data.siswa;
                    if (siswa.jk == 'l') {
                         siswa.jk = 'Laki-Laki';
                    } else if (siswa.jk == 'p') {
                         siswa.jk = 'Perempuan';

                    }

                    //membuat huruf pertama kapital
                    const capitalize = (s) => {
                         if (typeof s !== 'string') return ''
                         return s.charAt(0).toUpperCase() + s.slice(1)
                    }

                    //mengubah format string pada tgl agar menjadi format dd-mm-yyyy
                    const format = (s) => {
                         if (typeof s !== 'string') return ''
                         let tahun = s.substring(0, 4)
                         let bulan = s.substring(5, 7)
                         let tgl = s.substring(8, 10)
                         return tgl + '-' + bulan + '-' + tahun
                    }

                    $('#hasil_cari').html(`
                    <table class="table table-bordered table-data3">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">nisn</th>
                                    <th class="text-center">nama siswa</th>
                                    <th class="text-center">tanggal lahir</th>
                                    <th class="text-center">alamat</th>
                                    <th class="text-center">jenis kelamin</th>
                                    <th class="text-center">aksi</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <tr>
                                        <td align="center">1</td>
                                        <td>` + siswa.nisn + `</td>
                                        <td>` + capitalize(siswa.nama_siswa) + `</td>
                                        <td>` + format(siswa.tgl_lahir) + `</td>
                                        <td>` + capitalize(siswa.alamat) + `</td>
                                        <td>` + siswa.jk + `</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="<?= base_url('admin/detail_siswa/'); ?>` + siswa.nisn + `" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-more"></i>
                                                </a>
                                                <a href="<?= base_url('admin/ubah_siswa/'); ?>` + siswa.nisn + `" class="item" data-toggle="tooltip" data-placement="top" title="Ubah">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <button class="item" onclick="
                                                    // validasi ketika tombol hapus diklik
                                                    if (confirm('Yakin mau dihapus ?')) {
                                                        window.location.href = '<?= base_url('admin/hapus_siswa/'); ?>` + siswa.nisn + `';
                                                    }
                                                    " data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                
                                </tbody>
                        </table>
                    `);

               }

               // error: function() {
               //      return;
               // }



          });
     });
</script>
</body>

</html>
<!-- end document-->