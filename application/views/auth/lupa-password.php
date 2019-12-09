<div class="page-wrapper">
     <div class="page-content--bge5">
          <div class="container">
               <div class="login-wrap">
                    <div class="login-content">
                         <div class="login-logo">
                              <h3>Lupa Password</h3>
                         </div>
                         <?= $this->session->flashdata('message'); ?>
                         <div class="login-form">
                              <form action="<?= base_url('auth/lupaPassword'); ?>" method="post">
                                   <div class="form-group">
                                        <label>Email</label>
                                        <input class="au-input au-input--full" type="text" name="email" value="<?= set_value('email'); ?>" placeholder="ex :   John@gmail.com">
                                        <?= form_error('email', '<small class="text-danger pl-4">', '</small>'); ?>
                                   </div>
                                   <button class="au-btn au-btn--block au-btn--green m-t-10" type="submit">kirim</button>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>

</div>