<nav class="navbar navbar-inverse navbar-fixed-top">
         <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="<?php echo base_url(); ?>index.php/home"><strong>Travel</strong></a>
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
            <table class="table table-striped table-hover table-bordered">
               <thead class="thead-dark">
                  <tr>
                     <th class="col-md-1 col-sm-1">No</th>
                     <th class="col-md-3 col-sm-3">Nama Travel</th>
                     <th class="col-md-3 col-sm-3">Tanggal Pesan</th>
                     <th class="col-md-3 col-sm-3">Jadwal Keberangkatan</th>
                     <th class="col-md-2 col-sm-2">Status</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>1</td>
                     <td>
                        <a href="transaction.html" class="travel-link">
                           <div class="col-md-3 col-sm-3">
                              <img src="<?php echo base_url(); ?>/assets/img/andro2.png" alt="">   
                           </div>
                           <div class="col-md-9 col-sm-9">
                              <p class="travel-agent">3Lex Travel</p>   
                           </div>
                        </a>
                     </td>
                     <td>18-september-2017</td>
                     <td>25-september-2017</td>
                     <td>
                        <a class="col-md-12 btn btn-md btn-warning" href="<?php echo base_url(); ?>index.php/transaksi">
                           Menunggu Konfirmasi
                        </a>
                     </td>
                  </tr>
                  <tr>
                     <td>2</td>
                     <td>
                        <a href="transaction.html" class="travel-link">
                           <div class="col-md-3">
                              <img src="<?php echo base_url(); ?>/assets/img/andro2.png" alt="">   
                           </div>
                           <div class="col-md-9">
                              <p class="travel-agent">3Lex Travel</p>   
                           </div>
                        </a>
                     </td>
                     <td>18-september-2017</td>
                     <td>25-september-2017</td>
                     <td>
                        <a class="col-md-12 btn btn-md btn-success" href="transaction.html">
                           Telah Konfirmasi
                        </a>
                     </td>
                  </tr>
                  
               </tbody>
            </table>
         </div>
      </div>