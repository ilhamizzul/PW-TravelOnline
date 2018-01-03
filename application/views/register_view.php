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
            <?php 
                        $notif = $this->session->flashdata('notif');
                        if (!empty($notif)) {
                            echo ' <div style="margin-top:75px;" class="alert alert-success"> ';
                            echo $notif;
                            echo '</div>';
                        }
                        ?>
            <div class="col-md-12 jumbotron">
              <h2 style="text-align: center;">A greatest way to find your comfortable travel</h2>
              <div class="col-md-4">
                 <div class="col-md-12 icon">
                    <i class="fa fa-car" aria-hidden="true"></i>
                 </div>
                 <div class="text col-md-12">
                     <h3 style="text-align: center;">High Quality Travel</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="col-md-12 icon">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                 </div>
                 <div class="text col-md-12">
                     <h3 style="text-align: center;">High Quality Travel</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="col-md-12 icon">
                    <i class="fa fa-car" aria-hidden="true"></i>
                 </div>
                 <div class="text col-md-12">
                     <h3 style="text-align: center;">High Quality Travel</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                 </div>
              </div> 
            </div>
         </div>
         <div class="col-md-4 register">
            <h3 class="header">Pendaftaran User Baru</h3>
            <form method="post" id="form-pendaftaran" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/register/simpan">
                <input type="text" hidden="true" name="id_member" value="5435326">
              <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control form-control-sm" name="name">
               </div>
               <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control form-control-sm" name="username">
               </div>
               <div class="form-group">
                  <label>Password</label>
                  <input type="Password" class="form-control form-control-sm" name="password">
               </div>
               <div class="form-group">
                 <label>Jenis Identitas</label>
                  <select class="form-control" name="jenis_identitas">
                    <option>KTP</option>
                    <option>SIM</option>
                    <option>Kartu Pelajar/KTM</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Nomor Identitas</label>
                  <input type="number" value="Submit" class="form-control form-control-sm" name="no_identitas">
               </div>
               <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 55px;"></textarea>
               </div>
               <input type="submit" class="btn btn-block btn-primary" value="Submit" name="submit">
            </form>
         </div>
      </div>