<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/home_landingpage.js"></script>

<nav class="navbar navbar-inverse navbar-fixed-top">
   <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand navbar-link" href="<?php echo base_url(); ?>index.php/home">Travel<strong>Online</strong></a>
         <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      </div>
      <div class="collapse navbar-collapse" id="navcol-1">
         <ul class="nav navbar-nav navbar-right">
            <li role="presentation"><a href="" data-toggle="modal" data-target="#search">Search</a></li>
            <?php 
               if($this->session->userdata('logged_in') == true){
                 echo '
                   <li role="presentation"><a href="'.base_url().'index.php/history/">History </a></li>
                 ';
               } 
               ?>
            <li role="presentation">
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Account </a>
               <ul class="dropdown-menu">
                  <?php 
                     if ($this->session->userdata('logged_in') == TRUE) {
                       echo '
                         <li><a href="" disabled>Welcome, '.$this->session->userdata('USERNAME').'</a></li>
                         <li><a href="'.base_url().'index.php/login/logout">Logout</a></li>
                       ';
                     } else {
                       echo '
                       <li><a href="" data-toggle="modal" data-target="#login">Login</a></li>
                       <li><a href="'.base_url().'index.php/register/">Register</a></li>
                     ';
                     }
                     
                     ?>
               </ul>
            </li>
         </ul>
      </div>
   </div>
</nav>
<!-- MODAL SEARCH -->
<div id="search" class="modal fade" role="dialog" ">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" data-bind="with:landingpage">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Search Travel</h4>
         </div>
         <div class="modal-body" style="height:255px;" data-bind="with:recordFilter">
            <!-- <form method="post" action="<?php echo base_url(); ?>index.php/home/get_data"> -->
            <form method="post" action="">
               <div class="col-md-12 col-sm-12">
                  <div class="form-group col-md-6 col-sm-6">
                     <label class="control-label">From:</label>
                     <div class="form-group">
                        <div class="input-group">
                           <div class="input-group-addon">
                              <img src="<?php echo base_url(); ?>assets/img/car(1).png" alt="">
                           </div>
                           <input type="text" name="depart" class="form-control" data-bind="value:FROM">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-6 form-group">
                     <label class="col-form-label col-form-label-sm">To:</label>
                     <input type="text" class="form-control form-control-sm" name="to" data-bind="value:TO">
                  </div>
               </div>
               <div class="col-md-12 col-sm-12">
                  <div class="form-group col-md-6 col-sm-6">
                     <label class="control-label">Departure:</label>
                     <div class="form-group">
                        <!-- <div class="input-group"> -->
                           <input style="width: 100%" type="text" name="depart" class="form-control" data-bind="value:DEPARTURE, kendoDatePicker:{value: setDateMin(), min: setDateMin() ,format:'yyyy-MM-dd'}">
                        <!-- </div> -->
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-6 form-group">
                     <label class="col-form-label col-form-label-sm">Seat:</label>
                     <input type="text" class="form-control form-control-sm Number" name="minimumseat" data-bind="value:MINIMUMSEAT">
                  </div>
               </div>
               <!-- <div class="col-md-12 col-sm-7">
                  <div class="form-group col-md-12 col-sm-12">
                     <label class="control-label">Departure:</label>
                     <div class="form-group">
                        <div class="input-group">
                           <div class="input-group-addon">
                              <img src="<?php echo base_url(); ?>assets/img/clock(1).png" alt="depart">
                           </div>
                           <input type="date" name="date" class="form-control">
                        </div>
                     </div>
                  </div>
               </div> -->
               <div class="col-md-12 col-sm-5">
               <!-- <div class="col-md-12 col-sm-5"> -->
                  <!-- <button class="btn btn-block btn-primary" id="searchButton" type="button" onclick="landingpage.filterData()">Search</button> -->
                <!-- </div> -->
                  <input type="button" class="btn btn-block btn-primary" value="Search" onclick="landingpage.filterData()">
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <img class="img img-responsive" src="<?php echo base_url(); ?>/assets/img/pexels-photo-620335-2.jpg" id="wallpaper" alt="">
</div>
<div class="container body">
   <!-- PADA TAMPILAN TABLET KEBAWAH TAMPILAN CLASS HEAD-CONTENT HILANG -->
   <div class="col-md-12 head-content">
      <div class="col-md-3 col-sm-3">
         Travel
      </div>
      <div class="col-md-3 col-sm-3">
         Depart
      </div>
      <div class="col-md-3 col-sm-3">
         Arrive
      </div>
      <div class="col-md-3 col-sm-3">
         Price per Person
      </div>
   </div>
   <?php 
      

  if($this->session->logged_in == true){
    $no = 1;
    foreach ($data_trevel as $data) {
    echo '
      <div class="col-md-12 col-sm-12 content">
        <div class="col-md-3 col-sm-4">
           <div class="col-md-3 col-sm-4">
              <img src="'.base_url().'assets/img/andro2.png" alt="">  
           </div>
           <div class="col-md-9 col-sm-8">
              <p class="agent-travel">'.$data->NAMA_TRAVEL.'</p>
           </div>
           <div class="col-sm-12">
              <p class="depart-arrive"> '.$data->WAKTU_BERANGKAT.' - '.$data->WAKTU_SAMPAI.' </p>
              <p class="destination">'.$data->KOTAT_ASAL.' - '.$data->KOTA_TUJUAN.'</p>
           </div>
        </div>
        <div class="col-md-3 depart">
           <p class="time">'.$data->WAKTU_BERANGKAT.'</p>
           <p>'.$data->KOTAT_ASAL.'</p>
        </div>
        <div class="col-md-3 arrive">
           <p class="time">'.$data->WAKTU_SAMPAI.'</p>
           <p>'.$data->KOTA_TUJUAN.'</p>
        </div>
        <div class="col-md-3 col-sm-3 pull-right">
          <p class="price">
            <b>
              Rp'.number_format($data->TARIF, 0 , '' , ',' ).',-
            </b>
          </p>';
          echo "<a href='' data-toggle='modal' data-target='#chooseTujuan'  class='btn btn-choose btn-sm' onclick=\"landingpage.showDetail('$data->ID_TRAVEL','$data->ID_KOTA_ASAL','$data->ID_KOTA_TUJUAN',$data->TARIF, $data->JML_KURSI, '$data->NAMA_TRAVEL', '$data->ID_JADWAL_TRAVEL', '$data->KOTAT_ASAL', '$data->KOTA_TUJUAN','";
          echo $this->session->flashdata('DATEDEPART');
          echo"')\">Choose</a>";
        echo '</div>

        <div class="col-md-12 col-sm-12 see">
          <button type="button" class="see" data-toggle="collapse" data-target="#demo'.$data->ID_JADWAL_TRAVEL.'">See Detail>></button>
        </div>
        <div class="col-md-12 col-sm-12">
          <div id="demo'.$data->ID_JADWAL_TRAVEL.'" class="collapse">
            <div class="col-md-4  col-sm-4">
                <p>Gambar Mobil:</p>
                <img src="'.base_url().'assets/uploads/'.$data->FOTO_KENDARAAN.'" class="carImage img-responsive" alt="">
            </div>
            <div class="col-md-4 col-sm-4">
                <p>Nama Mobil:</p>
                <p class="merk"><b>'.$data->MERK_KENDARAAN.'</b></p>
            </div>
            <div class="col-md-4 col-sm-4">
                <p>Sisa Kursi:</p>
                <p class="seat"><b>'.$data->JML_KURSI.'</b></p>
            </div>
          </div>
        </div>
      </div>

      

    ';
      $no++;
    }
  } else {
    $no = 1;
    foreach ($data_trevel as $data) {
    echo '
      <div class="col-md-12 col-sm-12 content">
        <div class="col-md-3 col-sm-4">
           <div class="col-md-3 col-sm-4">
              <img src="'.base_url().'assets/img/andro2.png" alt="">  
           </div>
           <div class="col-md-9 col-sm-8">
              <p class="agent-travel">'.$data->NAMA_TRAVEL.'</p>
           </div>
           <div class="col-sm-12">
              <p class="depart-arrive"> '.$data->WAKTU_BERANGKAT.' - '.$data->WAKTU_SAMPAI.' </p>
              <p class="destination">'.$data->KOTAT_ASAL.' - '.$data->KOTA_TUJUAN.'</p>
           </div>
        </div>
        <div class="col-md-3 depart">
           <p class="time">'.$data->WAKTU_BERANGKAT.'</p>
           <p>'.$data->KOTAT_ASAL.'</p>
        </div>
        <div class="col-md-3 arrive">
           <p class="time">'.$data->WAKTU_SAMPAI.'</p>
           <p>'.$data->KOTA_TUJUAN.'</p>
        </div>
        <div class="col-md-3 col-sm-3 pull-right">
          <p class="price">
            <b>
              Rp.'.$data->TARIF.',-
            </b>
          </p>
          <a href="" data-toggle="modal" data-target="#choose"  class="btn btn-choose btn-sm">Choose</a>
        </div>
        <div class="col-md-12 col-sm-12 see">
          <button type="button" class="see" data-toggle="collapse" data-target="#demo'.$data->ID_JADWAL_TRAVEL.'">See Detail>></button>
        </div>
        <div class="col-md-12 col-sm-12">
          <div id="demo'.$data->ID_JADWAL_TRAVEL.'" class="collapse">
            <div class="col-md-4  col-sm-4">
                <p>Gambar Mobil:</p>
                <img src="'.base_url().'assets/uploads/'.$data->FOTO_KENDARAAN.'" class="carImage img-responsive" alt="">
            </div>
            <div class="col-md-4 col-sm-4">
                <p>Nama Mobil:</p>
                <p class="merk"><b>'.$data->MERK_KENDARAAN.'</b></p>
            </div>
            <div class="col-md-4 col-sm-4">
                <p>Sisa Kursi:</p>
                <p class="seat"><b>'.$data->JML_KURSI.'</b></p>
            </div>
          </div>
        </div>
      </div>

      
    ';
      $no++;
    }

  }

    ?>


    <?php 
      if ($this->session->logged_in == true) {
        echo '
        <div id="chooseTujuan" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" data-bind="text: landingpage.namaTravel"></h4>
         </div>
         <div class="modal-body modal-seat2">
            <!-- <form> -->
               <div class="col-md-5 col-sm-5">
                  <img class="img img-responsive" src="'.base_url().'assets/img/3lex.png" alt="">  
               </div>
               <div class="col-md-7 col-sm-7">
                  <div class="form-group">
                     <label>Desa Penjemputan</label>
                     <select class="form-control" name="desa_asal" id="desaAsal" data-bind="value: landingpage.recordTransaksi.DESA_ASAL">
                      <option value="" >-- Pilih Desa Penjemputan --</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Detail Penjemputan</label>
                     <textarea class="form-control" rows="3" id="alamatpenjemputan" data-bind="text: landingpage.recordTransaksi.ALAMAT_PENJEMPUTAN, value: landingpage.recordTransaksi.ALAMAT_PENJEMPUTAN"></textarea>
                  </div>
                  <div class="form-group">
                     <label>Desa Tujuan</label>
                     <select class="form-control" name="desa_tujuan" id="desaTujuan" data-bind="value: landingpage.recordTransaksi.DESA_TUJUAN">
                      <option value="" >-- Pilih Desa Tujuan --</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Detail Penjemputan</label>
                     <textarea class="form-control" rows="3" id="alamatpenurunan" data-bind="text: landingpage.recordTransaksi.ALAMAT_PENURUNAN, value: landingpage.recordTransaksi.ALAMAT_PENURUNAN"></textarea>
                  </div>
                  <div class="form-group">
                     <label>Jumlah</label>
                     <input type="text" class="form-control Number" name="" data-bind="value: landingpage.recordTransaksi.JUMLAH_KURSI">   
                  </div>
                  <div class="col-md-12 col-sm-12">
                     <center>
                        <p class="price2">
                           <b>
                           Rp <span data-bind="text: landingpage.recordTransaksi.TOTAL_BAYAR"></span>,-
                           </b>
                        </p>
                     </center>
                  </div>
                  <div class="col-md-12 col-sm-12">
                     <button class="btn btn-sm btn-primary search" onclick="landingpage.saveTransaction()">Purchase</button>
                  </div>
               </div>
            <!-- </form> -->
         </div>
          </div>
        </div>
      </div>
        ';
      } else {
        echo '
          <div id="choose" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">3Lex Travel</h4>
               </div>
               <div class="modal-body modal-seat">
                 <center><h3>Masih Belum Punya Akun?</h3></center>
                 <a href="" class="btn btn-lg btn-success btn-block" onclick="landingpage.closeModal()" id="BtnLogin" data-toggle="modal" data-target="#login">Login</a>
                 <center><h4>Atau</h4></center>
                 <a href="'.base_url().'index.php/register/" class="btn btn-lg btn-info btn-block">Register</a>
               </div>
            </div>
         </div>
         </div>
        ';
      }
      
    ?>

    <?php
      if ($this->session->userdata('logged_in') == TRUE) {
      $success = $this->session->flashdata('success');
       if ($success == 'success') {
         echo '
          <script types="text/javascript\">
              $(document).ready(function(){
                  swal(
                    "Login Berhasil!",
                    "Selamat Datang '.$this->session->userdata('USERNAME').'!",
                    "success"
                  )
              });
            </script>
         ';
       } 
      } else {
        $failed = $this->session->flashdata('failed');
       if ($failed == 'failed') {
         echo '
          <script types="text/javascript\">
              $(document).ready(function(){
                  swal(
                    "Login Gagal!",
                    "Silahkan Cek Lagi Input Form Anda!",
                    "error"
                  )
              });
            </script>
         ';
       } 
      }



   ?> 


   <div>
      <center>
        <?php echo $pagination;  ?>
         <!-- <ul class="pagination">
            <li class="page-item disabled">
               <a class="page-link" href="#">&laquo;</a>
            </li>
            <li class="page-item active">
               <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
               <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
               <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
               <a class="page-link" href="#">4</a>
            </li>
            <li class="page-item">
               <a class="page-link" href="#">5</a>
            </li>
            <li class="page-item">
               <a class="page-link" href="#">&raquo;</a>
            </li>
            </ul> -->
      </center>
   </div>
</div>


