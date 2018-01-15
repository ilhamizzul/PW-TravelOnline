<nav class="navbar navbar-inverse navbar-fixed-top">
         <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="<?php echo base_url(); ?>index.php/home">Travel<strong>Online</strong></a>
               <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
               <ul class="nav navbar-nav navbar-right">
                  <li role="presentation">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Account </a>
                     <ul class="dropdown-menu">
                        <li><a href="" data-toggle="modal" data-target="#login">Login</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/register/">Register</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
      </nav>


<div class="container regist">
         <div class="col-md-8">

            <div class="col-md-12 jumbotron">
              <h2 style="text-align: center;">A greatest way to find your comfortable travel</h2>
              <div class="col-md-4">
                 <div class="col-md-12 icon">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                 </div>
                 <div class="text col-md-12">
                     <h3 style="text-align: center;">Terpercaya</h3>
                    <p>Tempat berkumpulnya para agen travel yang terpercaya.</p>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="col-md-12 icon">
                    <i class="fa fa-car" aria-hidden="true"></i>
                 </div>
                 <div class="text col-md-12">
                     <h3 style="text-align: center;">Mobil Nyaman</h3>
                    <p>Menyediakan beragam jenis mobil yang dijamin kenyamannya. </p>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="col-md-12 icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                 </div>
                 <div class="text col-md-12">
                     <h3 style="text-align: center;">Professional</h3>
                    <p>Supir yang berpengalaman dan bertanggung jawab.</p>
                 </div>
              </div> 
            </div>

            <div class="col-md-12 step">
              <div class="col-md-3">
                <center>
                  <img src="<?php echo base_url(); ?>assets/img/register&login.png" class="img img-responsive img-step" alt="">
                  <h5>Login & Register</h5>
                </center>
              </div>
              <div class="col-md-3">
                <center>
                  <img src="<?php echo base_url(); ?>assets/img/rute.png" class="img img-responsive img-step" alt="">
                  <h5>Pilih Rute</h5>  
                </center>
              </div>
              <div class="col-md-3">
                <center>
                  <img src="<?php echo base_url(); ?>assets/img/transfer.png" class="img img-responsive img-step" alt="">
                  <h5>Transfer Biaya Travel</h5>  
                </center>
              </div>
              <div class="col-md-3">
                <center>
                  <img src="<?php echo base_url(); ?>assets/img/tiket.png" class="img img-responsive img-step" alt="">
                  <h5>Dapatkan Tiket Anda!</h5>  
                </center>
              </div>
              <div class="col-md-12">
                <center>
                  <img src="<?php echo base_url(); ?>assets/img/arrow.png" class="img img-responsive arrow" alt="">  
                </center>
                
              </div>
            </div>
         </div>
         <div class="col-md-4 register">
            <h3 class="header">Pendaftaran User Baru</h3>
            <form method="post" id="form-pendaftaran" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/register/simpan">
              <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control form-control-sm" name="name" placeholder="Masukkan Nama Akun Anda(Minimal 5 digit)">
               </div>
               <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control form-control-sm" name="username" placeholder="Masukkan Username Akun Anda(Minimal 5 digit)">
               </div>
               <div class="form-group">
                  <label>Password</label>
                  <input type="Password" class="form-control form-control-sm" name="password" placeholder="Masukkan Password Akun Anda(Minimal 5 digit)">
               </div>
               <div class="form-group">
                 <label>Jenis Identitas</label>
                  <select class="form-control" name="jenis_identitas">
                    <option value="KTP">KTP</option>
                    <option value="SIM">SIM</option>
                    <option value="Kartu Pelajar/KTM">Kartu Pelajar/KTM</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Nomor Identitas</label>
                  <input type="number" class="form-control form-control-sm" name="no_identitas">
               </div>
               <div class="form-group">
                  <label>Nomor Telepon</label>
                  <input type="number" class="form-control form-control-sm" name="telepon">
               </div>
               <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 55px;"></textarea>
               </div>
               <input type="submit" class="btn btn-block btn-primary" value="Submit" name="submit">
            </form>
         </div>
      </div>

       <?php
         $success = $this->session->flashdata('success');
         if ($success == 'success') {
           echo '
            <script types="text/javascript\">
                $(document).ready(function(){
                    swal(
                      "Registrasi Berhasil!",
                      "Silahkan Login",
                      "success"
                    ).then((x)=>{
                      $("#login").modal("show");
                    })
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
                      "Registrasi Gagal!",
                      "Silahkan Cek Lagi Input Form Anda!",
                      "error"
                    )
                });
              </script>
           ';
         } 



       ?>