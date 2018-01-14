<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Mobil Travel
      </h1>
    </div>
</div>

<?php
  if ($this->session->userdata('LEVEL') == 'OPERATOR' || $this->session->userdata('LEVEL') == 'OWNER') {
     # code...
    
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

<!-- header button and filter -->
    

<!-- grid -->
<div class="row">
    <div class="col-md-12">
        <table  class="table table-hover table-striped table-bordered col-md-12" style="margin-top: 12px; overflow-x: auto;">
           <thead>
              <tr>
                 <th>ID Kendaraan Travel</th>
                 <th>Nama Travel</th>
                 <th>Merk Kendaraan</th>
                 <th>Plat Nomor Kendaraan</th>
                 <th>Warna Kendaraan</th>
                 <th>Foto Kendaraan</th>
                 <th>Jumlah Kursi</th>
                 <?php 
                  if ($this->session->userdata('LEVEL') == 'OPERATOR' || $this->session->userdata('LEVEL') == 'OWNER') {
                    echo '
                      <th>Aksi</th>
                    ';
                  }
                 ?>
                 
                 
              </tr>
           </thead>
           <tbody>
                <?php 
                    foreach ($mobil_travel as $data) {
                        echo '
                            <tr class="table-active">
                                 <td>'.$data->ID_KENDARAAN_TRAVEL.'</td>
                                 <td>'.$data->NAMA_TRAVEL.'</td>
                                 <td>'.$data->MERK_KENDARAAN.'</td>
                                 <td>'.$data->NO_POL_KENDARAAN.'</td>
                                 <td>'.$data->WARNA_KENDARAAN.'</td>
                                 <td><img src="'.base_url().'assets/uploads/'.$data->FOTO_KENDARAAN.'" class="img img-responsive" style="max-width:150px;height:auto;" alt=""></td>
                                 <td>'.$data->JML_KURSI.'</td>';

                                 if ($this->session->userdata('LEVEL') == 'OPERATOR' || $this->session->userdata('LEVEL') == 'OWNER') {
                                  echo '
                                    <td>
                                     <a class="btn btn-warning" href="" data-toggle="modal" data-target="#edit'.$data->ID_KENDARAAN_TRAVEL.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                     <a class="btn btn-danger" href="'.base_url().'index.php/admin_mobil_travel/delete/'.$data->ID_KENDARAAN_TRAVEL.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                   </td>
                                  ';
                                  }

                                 echo'
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

        <form method="post" action="<?php echo base_url(); ?>index.php/admin_mobil_travel/save" enctype="multipart/form-data">
        
          <fieldset>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Tipe Kendaraan</label>
                      <select class="form-control" name="tipe_kendaraan">
                        <?php 
                            foreach ($merk as $data) {
                                echo '
                                    <option value="'.$data->ID_JENIS_KENDARAAN.'">'.$data->TYPE_KENDARAAN.'</option>
                                ';
                            }
                        ?>      
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Plat Nomor Kendaraan</label>
                      <input type="text" name="plat_nomor" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                  
                    <div class="form-group">
                      <label>Warna Kendaraan</label>
                      <input type="text" name="warna_kendaraan" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Foto Kendaraan</label>
                      <input type="file" name="foto_kendaraan" id="foto_kendaraan" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Jumlah Kursi</label>
                      <input type="number" name="jumlah_kursi" class="form-control">
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
  foreach ($mobil_travel as $data) {
    echo '
      <div id="edit'.$data->ID_KENDARAAN_TRAVEL.'" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Jadwal Travel</h4>
            </div>
            <div class="modal-body">

              <form method="post" action="'.base_url().'index.php/edit/'.$data->ID_KENDARAAN_TRAVEL.'" enctype="multipart/form-data">
              
                <fieldset>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Tipe Kendaraan</label>
                            <select class="form-control" name="tipe_kendaraan">';
                              
                                  foreach ($merk as $data) {
                                      echo '
                                          <option value="'.$data->ID_JENIS_KENDARAAN.'">'.$data->TYPE_KENDARAAN.'</option> 
                                      ';
                                  }
                                  echo '</select> </div>';
                              }

                            foreach ($mobil_travel as $data) {

                            echo '
                          
                          <div class="form-group">
                            <label>Plat Nomor Kendaraan</label>
                            <input type="text" name="plat_nomor" class="form-control" value="'.$data->NO_POL_KENDARAAN.'">
                          </div>
                      </div>
                      <div class="col-md-6">
                        
                          <div class="form-group">
                            <label>Warna Kendaraan</label>
                            <input type="text" name="warna_kendaraan" class="form-control" value="'.$data->WARNA_KENDARAAN.'">
                          </div>
                          <div class="form-group">
                            <label>Foto Kendaraan</label>
                            <input type="file" name="foto_kendaraan" id="foto_kendaraan" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Jumlah Kursi</label>
                            <input type="number" name="jumlah_kursi" class="form-control" value="'.$data->JML_KURSI.'">
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
    ';
  }
?>

<?php
         $success = $this->session->flashdata('success');
         if ($success == 'success') {
           echo '
            <script types="text/javascript\">
                $(document).ready(function(){
                    swal(
                      "Tambah Mobil Travel Berhasil!",
                      "Data Mobil Travel Berhasil ditambah!",
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
                      "Tambah Mobil Travel Gagal!",
                      "Silahkan Cek Lagi Input Form Anda!",
                      "error"
                    )
                });
              </script>
           ';
         } 

         $delsuccess = $this->session->flashdata('delsuccess');
         if ($delsuccess == 'delsuccess') {
           echo '
            <script types="text/javascript\">
                $(document).ready(function(){
                    swal(
                      "Hapus Berhasil!",
                      "Data Mobil Travel Berhasil dihapus!",
                      "success"
                    )
                });
              </script>
           ';
         } 





       ?> 
      