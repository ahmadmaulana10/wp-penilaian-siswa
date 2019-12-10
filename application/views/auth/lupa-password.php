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
                                   <div class="form-group"><label>Email</label>
                                        <div class="input-group">
                                             <div class="input-group-addon">
                                                  <i class="fa fa-envelope"></i>
                                             </div>
                                             <input class="form-control" type="text" name="email" value="<?= set_value('email'); ?>" placeholder="ex :   Jamal@gmail.com" autocomplete="off">
                                        </div>
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