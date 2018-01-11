<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header" style="text-align: center;">Setting Akun</h1>
    </div>
</div>



<!-- grid -->
<div class="row">
    <div class="col-md-6 col-md-offset-3">
      <?php
      $failed = $this->session->flashdata('failed');
        if(!empty($failed)){
          echo '<div class="alert alert-danger alert-dismissable" style="margin-top: 10px">';
          echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
          echo '<i class="icon fa fa-warning"></i>';
          echo $failed;
          echo '</div>';
        }

      $success = $this->session->flashdata('success');
      if(!empty($success)){
          echo '<div class="alert alert-success alert-dismissable" style="margin-top: 10px">';
          echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
          echo '<i class="icon fa fa-check"></i>';
          echo $success;
          echo '</div>';
      }
    ?>
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
              <label>Kota</label>
              <input type="text" class="form-control" name="kota" value="<?php echo $profil->KOTA ?>">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat_user" rows="3" ><?php echo $profil->ALAMAT_USER ?></textarea>
            </div>
            <div class="form-group">
              <label>Nomor Rekening BCA</label>
              <input type="number" class="form-control" name="nomor_rekening" value="<?php echo $profil->NOMOR_REKENING ?>">
            </div>
            <hr>
            <!-- <div class="form-group">
              <label>Password Baru</label>
              <input type="password" class="form-control">
            </div> -->
            <input type="submit" style="margin-bottom: 12px;" class="btn btn-success btn-block" value="Update" name="submit">
          </fieldset>
        </form>
    </div>
</div>

  </div>
</div>
 
