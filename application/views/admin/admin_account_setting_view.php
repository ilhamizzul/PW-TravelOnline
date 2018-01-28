<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">
<script src="<?php echo base_url(); ?>assets/main/js/admin_account_setting.js"></script>

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Account Setting</h1>
    </div>
</div>

<!-- DATA -->
<div class="row">
    <div class="col-md-12" data-bind="visible: !model.Processing(), with: accountsetting">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>My Profile</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" data-bind="with: dataAccount">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Nama :</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" data-bind="text: NAMA_USER"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Telepon :</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" data-bind="text: NOMOR_TELEPON"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Kota :</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" data-bind="text: KOTA"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Alamat :</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" data-bind="text: ALAMAT_USER"></p>
                            </div>
                        </div>
                        <?php 
                            if ($this->session->userdata('LEVEL') != 'OPERATOR') 
                            {
                         ?>
                                <hr>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Bank :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static" data-bind="text: BANK"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Rekening :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static" data-bind="text: NOMOR_REKENING"></p>
                                    </div>
                                </div>
                        <?php 
                            }
                         ?>
                    </form>
                </div> 
                <div class="panel-footer" style="text-align: right;">
                    <a href="javascript: accountsetting.editProfile()" type="button" class="btn btn-warning btn-sm" >Edit Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>My Account</h4>
                </div>
                <div class="panel-body" data-bind="with: dataAccount">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Username :</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" data-bind="text: USERNAME_ADMIN"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Password :</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">XXXXXXX</p>
                            </div>
                        </div>
                    </form>
                </div> 
                <div class="panel-footer" style="text-align: right;">
                    <a href="javascript: accountsetting.editAccount()" type="button" class="btn btn-warning btn-sm">Edit Account</a>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $this->load->view($loader);
     ?>
</div>

<!-- MODAL -->
<!-- EDIT RPOFILE MODAL -->
<div id="editProfileModal" class="modal fade" role="dialog" data-bind="with: accountsetting">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Profile</h4>
            </div>
            <div class="modal-body" data-bind="with: recordAccount">
                <fieldset>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" data-bind="value: NAMA_USER">
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="number" class="form-control" data-bind="value: NOMOR_TELEPON">
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" class="form-control" data-bind="value: KOTA">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" data-bind="value: ALAMAT_USER" rows="3"></textarea>
                </div>
                <?php 
                    if ($this->session->userdata('LEVEL') != 'OPERATOR') 
                    {
                 ?>
                        <div class="form-group">
                            <label>Bank</label>
                            <input type="text" class="form-control" data-bind="value: BANK">
                        </div>
                        <div class="form-group">
                            <label>Nomor Rekening</label>
                            <input type="number" class="form-control" data-bind="value: NOMOR_REKENING">
                        </div>
                <?php 
                    }
                 ?>
                <hr style="border-width: 5px">
                <div class="form-group">
                    <label>Your Password</label>
                    <input type="password" class="form-control" data-bind="value: PASSWORD">
                </div>
            </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="accountsetting.saveDataProvile()">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- EDIT ACCOUNT MODAL -->
<div id="editAccountModal" class="modal fade" role="dialog" data-bind="with: accountsetting">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Account</h4>
            </div>
            <div class="modal-body" data-bind="with: recordAccount">
                <fieldset>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" data-bind="value: USERNAME_ADMIN">
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" data-bind="value: PASSWORD_ADMIN" placeholder="Jika Anda tidak ingin mengubah password kosongi field ini">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control" data-bind="value: CONFIRM_PASSWORD" placeholder="Jika Anda tidak ingin mengubah password kosongi field ini">
                </div>
                <hr style="border-width: 5px">
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" class="form-control" data-bind="value: PASSWORD">
                </div>
            </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="accountsetting.saveDataProvile()">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- grid -->
<!-- <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form method="post" action="<?php echo base_url(); ?>index.php/account_setting/edit_account_submit">
            <fieldset>
                <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" class="form-control" name="nama_user" value="<?php echo $profil->NAMA_USER ?>">
                </div>
                <div class="form-group">
                    <label>Username Akun</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $profil->USERNAME_ADMIN ?>">
                </div>
                <div class="form-group">
                    <label>Password Akun</label>
                    <input type="password" id="password" name="password" class="form-control" value="<?php echo $profil->PASSWORD_ADMIN ?>">
                </div>
                <div class="form-group">
                    <input type="checkbox" onclick="showHide()" />
                    <label for="show-hide">Show password</label>
                </div>
                <script>
                    function showHide() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="number" class="form-control" name="telepon" value="<?php echo $profil->NOMOR_TELEPON ?>">
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" class="form-control" name="kota" value="<?php echo $profil->KOTA ?>">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat_user" rows="3"><?php echo $profil->ALAMAT_USER ?></textarea>
                </div>
                <div class="form-group">
                    <label>Bank</label>
                    <input type="text" class="form-control" name="bank" value="<?php echo $profil->BANK ?>">
                </div>
                <div class="form-group">
                    <label>Nomor Rekening</label>
                    <input type="number" class="form-control" name="nomor_rekening" value="<?php echo $profil->NOMOR_REKENING ?>">
                </div>
                <hr>
                <input type="submit" style="margin-bottom: 12px;" class="btn btn-success btn-block" value="Update" name="submit">
            </fieldset>
        </form>
    </div>
</div> -->