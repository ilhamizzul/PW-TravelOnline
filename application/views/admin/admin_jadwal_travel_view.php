<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Jadwal Travel
      </h1>
    </div>
</div>


<?php 
  if ($this->session->userdata('LEVEL') == 'OPERATOR' || $this->session->userdata('LEVEL') == 'OWNER') {
    echo '
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-4 pull-right">
            <button class="btn btn-success pull-right" data-toggle="modal" data-target="#addDaerahModal" id="addButton" type="button" onclick="">Tambah <i class="fa fa-plus"></i></button>
          </div>
        </div>
      </div>
    ';
  }
?>
      

<!-- grid -->
<div class="row">
    <div class="col-md-12">
        <table class="table table-hover table-striped table-bordered col-md-12" style="margin-top: 12px;">
           <thead>
              <tr>
                 <th>ID Jadwal Travel</th>
                 <th>Kendaraan Travel</th>
                 <th>Kota Asal</th>
                 <th>Kota Tujuan</th>
                 <th>Waktu Berangkat</th>
                 <th>Waktu Sampai</th>
                 <th>Tarif</th>
              </tr>
           </thead>
           <tbody>
                <?php 
                    foreach ($jadwal as $data) {
                        echo '
                            <tr class="table-active">
                                 <td>'.$data->ID_JADWAL_TRAVEL.'</td>
                                 <td>'.$data->TYPE_KENDARAAN.'</td>
                                 <td>'.$data->KOTAT_ASAL.'</td>
                                 <td>'.$data->KOTA_TUJUAN.'</td>
                                 <td>'.$data->WAKTU_BERANGKAT.'</td>
                                 <td>'.$data->WAKTU_SAMPAI.'</td>
                                 <td>'.$data->TARIF.'</td>
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
        <h4 class="modal-title">Tambah Jadwal Travel</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url(); ?>index.php/admin_jadwal_travel/save">
          <fieldset>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Kendaraan Travel</label>
                      <select class="form-control" name="kendaraan_travel">
                        <?php 
                            foreach ($kendaraan as $data) {
                                echo '
                                    <option value="'.$data->ID_KENDARAAN_TRAVEL.'">'.$data->TYPE_KENDARAAN.'</option>
                                ';
                            }
                        ?>      
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Kota Asal</label>
                      <select class="form-control" name="asal">
                        <?php 
                            foreach ($kota as $data) {
                                echo '
                                    <option value="'.$data->NAMA_KOTA.'">'.$data->NAMA_KOTA.'</option>
                                ';
                            }
                        ?>      
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Kota Tujuan</label>
                      <select class="form-control" name="tujuan">
                        <?php 
                            foreach ($kota as $data) {
                                echo '
                                    <option value="'.$data->NAMA_KOTA.'">'.$data->NAMA_KOTA.'</option>
                                ';
                            }
                        ?>      
                      </select>
                    </div>
                    
                    
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Waktu Berangkat</label>
                      <input type="time" name="berangkat" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Waktu Sampai</label>
                      <input type="time" name="sampai" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Tarif</label>
                      <input type="number" name="tarif" class="form-control">
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

<?php
         $success = $this->session->flashdata('success');
         if ($success == 'success') {
           echo '
            <script types="text/javascript\">
                $(document).ready(function(){
                    swal(
                      "Tambah Jadwal Berhasil!",
                      "Data Jadwal Travel Berhasil ditambah!",
                      "success"
                    )
                });
              </script>
           ';
         } 

         $failed = $this->session->flashdata('failed');
         if ($failed == 'failed') {
           echo '
            <script types="text/javascript\">
                $(document).ready(function(){
                    swal(
                      "Tambah Jadwal Gagal!",
                      "Silahkan Cek Lagi Input Form Anda!",
                      "error"
                    )
                });
              </script>
           ';
         } 


       ?> 
