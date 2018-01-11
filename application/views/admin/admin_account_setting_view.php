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
        <form>
          <fieldset>
            <div class="form-group">
              <label>Nama User</label>
              <input type="text" class="form-control" value="<?php echo $profil->NAMA_USER ?>">
            </div>
            <div class="form-group">
              <label>Username Akun</label>
              <input type="text" class="form-control" value="<?php echo $profil->USERNAME_ADMIN ?>">
            </div>
            <div class="form-group">
              <label>Password Akun</label>
              <input type="password" id="password" class="form-control" value="<?php echo $profil->PASSWORD_ADMIN ?>">
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
              <input type="text" class="form-control" value="<?php echo $profil->KOTA ?>">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat" rows="3" ><?php echo $profil->ALAMAT_USER ?></textarea>
            </div>
            <div class="form-group">
              <label>Nomor Rekening</label>
              <input type="number" class="form-control" value="<?php echo $profil->NOMOR_REKENING ?>">
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
 
