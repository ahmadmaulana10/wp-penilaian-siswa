<div class="page-wrapper">
     <div class="page-content--bge5">
          <div class="container">
               <div class="login-wrap">
                    <div class="login-content">
                         <div class="login-logo">
                              <h3>Login</h3>
                         </div>
                         <div class="login-form">
                              <form action="" method="post">
                                   <div class="form-group">
                                        <label>Email</label>
                                        <input class="au-input au-input--full" type="email" name="email" placeholder="ex :   John@gmail.com" autocomplete="off">
                                   </div>
                                   <div class="form-group">
                                        <label>Password</label>
                                        <input class="au-input au-input--full" type="password" name="password" placeholder="Ketik Password Disini . . .">
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