<div class="page-wrapper">
     <div class="page-content--bge5">
          <div class="container">
               <div class="login-wrap">
                    <div class="login-content">
                         <div class="login-logo">
                              <h3>Registrasi</h3>
                         </div>
                         <div class="login-form">
                              <form action="<?= base_url('auth/registration'); ?>" method="post">
                                   <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input class="au-input au-input--full" type="text" name="nama" value="<?= set_value('nama'); ?>" placeholder="ex :   John Connor">
                                        <?= form_error('nama', '<small class="text-danger pl-4">', '</small>'); ?>
                                   </div>
                                   <div class="form-group">
                                        <label>Email</label>
                                        <input class="au-input au-input--full" type="text" name="email" value="<?= set_value('email'); ?>" placeholder="ex :   John@gmail.com">
                                        <?= form_error('email', '<small class="text-danger pl-4">', '</small>'); ?>
                                   </div>
                                   <div class="form-group">
                                        <label>Password</label>
                                        <input class="au-input au-input--full" type="password" name="password1" placeholder="Ketik Password . . .">
                                        <?= form_error('password1', '<small class="text-danger pl-4">', '</small>'); ?>
                                   </div>
                                   <div class="form-group">
                                        <label>Ulangi Password</label>
                                        <input class="au-input au-input--full" type="password" name="password2" placeholder="Ketik Ulang Password . . .">
                                        <?= form_error('password2', '<small class="text-danger pl-4">', '</small>'); ?>
                                   </div>
                                   <button class="au-btn au-btn--block au-btn--green m-t-10" type="submit">registrasi</button>
                              </form>
                              <div class="register-link">
                                   <p>
                                        Sudah punya akun?
                                        <a href="<?= base_url('auth'); ?>">Login</a>
                                   </p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

</div>