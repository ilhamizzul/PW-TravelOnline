<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/home_history.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/history_page.css">

<nav class="navbar navbar-inverse navbar-fixed-top">
         <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="<?php echo base_url(); ?>index.php/home">Travel<strong>Online</strong></a>
               <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
               <ul class="nav navbar-nav navbar-right">
                  <li role="presentation"><a href="<?php echo base_url(); ?>index.php/history/">History </a></li>
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


      <div class="container">
         <div class="col-md-12 history-box">
            <div class="col-md-12">
               <center><h2>History Transaksi</h2></center>
            </div>
            <dir class="row">
               <div class="col-md-12">
                  <div id="gridTransaksi"></div>
               </div>
            </dir>
         </div>
      </div>

      <div id="historyModal" class="modal fade">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Transaksi (<span data-bind="text:history.namaTravel"></span>) terblokkir</h4>
                 </div>
                 <div class="modal-body">
                     <p>Transaksi yang Anda lakukan telah terblokir oleh sistem kami dikarenakan Anda tidak megirim bukti pembayaran sesuai ketentuan</p>
                     <p>Untuk lebih detail mohon menghubungi narahubung dibawah</p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                     <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                 </div>
             </div>
         </div>
      </div>