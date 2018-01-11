<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Pemilik</h1>
    </div>
</div>

<!-- header button and filter -->
<div class="row">
	<div class="col-md-12">
		<div class="col-md-4 pull-right">
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#addDaerahModal" id="addButton" type="button" onclick="">Tambah <i class="fa fa-plus"></i></button>
		</div>
	</div>
</div>

<!-- grid -->
<div class="row">
    <div class="col-md-12">
        <table class="table table-hover table-striped table-bordered col-md-12" style="margin-top: 12px;">
           <thead>
              <tr>
                 <th>Nama User</th>
                 <th>Username</th>
                 <th>ID TRAVEL</th>
                 <th>Kota</th>
                 <th>Alamat</th>
                 <th>Bank</th>
                 <th>Nomor Rekening</th>
              </tr>
           </thead>
           <tbody>
                <?php 
                    foreach ($owner as $data) {
                        echo '
                            <tr class="table-active">
                                 <td>'.$data->NAMA_USER.'</td>
                                 <td>'.$data->USERNAME_ADMIN.'</td>
                                 <td>'.$data->ID_TRAVEL.'</td>
                                 <td>'.$data->KOTA.'</td>
                                 <td>'.$data->ALAMAT_USER.'</td>
                                 <td>'.$data->BANK.'</td>
                                 <td>'.$data->NOMOR_REKENING.'</td>
                              </tr>
                        ';
                    }
                ?>
           </tbody>
        </table>

    </div>
</div>

<!-- Modal -->
<div id="addDaerahModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah User Pemilik</h4>
      </div>
      <div class="modal-body">
        <form method="post">
          <fieldset>
                <input type="text" hidden="true" name="level" value="OWNER">
                <input type="text" hidden="true" name="bank" value="BCA">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama User</label>
                      <input type="text" name="nama_user" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Nama Travel</label>
                      <select class="form-control" id="exampleSelect1">
                        <?php 
                            foreach ($travel as $data) {
                                echo '
                                    <option>'.$data->NAMA_TRAVEL.'</option>
                                ';
                            }
                        ?>      
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Kota</label>
                      <input type="text" name="kota" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea class="form-control" name="alamat" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Nomor Rekening BCA</label>
                      <input type="number" name="no_rekening" class="form-control">
                    </div>
                    <input type="submit" style="margin-bottom: 12px;" class="btn btn-success btn-block" value="Submit" name="submit">
                </div>
                
            </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
