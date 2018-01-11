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
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label>Username Akun</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label>Password Akun</label>
              <input type="password" class="form-control">
              <div class="spacing pull-right"><a href="#" data-toggle="modal" data-target="#forget"><small> Forgot Password?</small></a><br/></div>
            </div>
            <div class="form-group">
              <label>Kota</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label>Nomor Rekening</label>
              <input type="number" class="form-control">
            </div>
            <hr>
            <div class="form-group">
              <label>Password Baru</label>
              <input type="password" class="form-control">
            </div>
            <input type="submit" style="margin-bottom: 12px;" class="btn btn-success btn-block" value="Update" name="submit">
          </fieldset>
        </form>
    </div>
</div>

  </div>
</div>

<div class="modal fade" id="forget">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Forget Password</h4>
               </div>
               <div class="modal-body">
                  <div class="container">
                     <h3 style="font-weight: 600; color: red;">Please Contact Your Administrator !</h3>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               </div>
            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>  
