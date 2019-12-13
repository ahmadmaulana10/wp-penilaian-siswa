<div class="page-wrapper">
     <div class="page-content--bge5">
          <div class="container">
               <div class="login-wrap">
                    <div class="login-content">
                         <div class="login-logo">
                              <h3>Login</h3>
                         </div>
                         <?= $this->session->flashdata('message'); ?>
                         <div class="login-form">
                              <form action="" method="post">
                                   <div class="form-group"><label>Email</label>
                                        <div class="input-group">
                                             <div class="input-group-addon">
                                                  <i class="fa fa-envelope"></i>
                                             </div>
                                             <input class="form-control" type="text" name="email" value="<?= set_value('email'); ?>" placeholder="ex :   Jamal@gmail.com">
                                        </div>
                                        <?= form_error('email', '<small class="text-danger pl-4">', '</small>'); ?>
                                   </div>
                                   <div class="form-group"><label>Password</label>
                                        <div class="input-group">
                                             <div class="input-group-addon">
                                                  <i class="fa fa-asterisk"></i>
                                             </div>
                                             <input class="form-control" type="password" name="password" placeholder="Ketik Password Disini . . .">
                                        </div>
                                        <?= form_error('password', '<small class="text-danger pl-4">', '</small>'); ?>
                                   </div>
                                   <div class="login-checkbox">
                                        <label>
                                             <a href="<?= base_url('auth/lupaPassword') ?>#">Lupa Password ?</a>
                                        </label>
                                   </div>
                                   <button class="au-btn au-btn--block au-btn--green m-t-5" type="submit">Login</button>
                              </form>
                              <div class="register-link">
                                   <p>
                                        Belum punya akun?
                                        <a href="<?= base_url('auth/registration') ?>"> Daftar</a>
                                   </p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

</div>