<nav class="navbar navbar-inverse navbar-fixed-top">
         <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="<?php echo base_url(); ?>index.php/home"><strong>Travel</strong></a>
               <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
               <ul class="nav navbar-nav navbar-right">
                  <li role="presentation"><a href="" data-toggle="modal" data-target="#search">Search</a></li>
                  <li role="presentation"><a href="<?php echo base_url(); ?>index.php/history/">History </a></li>
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

      <!-- MODAL SEARCH -->
      <div id="search" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Search Travel</h4>
               </div>
               <div class="modal-body" style="height:255px;">
                  <form>
                     <div class="col-md-12 col-sm-12">
                        <div class="form-group col-md-6 col-sm-6">
                           <label class="control-label">From:</label>
                           <div class="form-group">
                              <div class="input-group">
                                 <div class="input-group-addon">
                                    <img src="<?php echo base_url(); ?>assets/img/car(1).png" alt="">
                                 </div>
                                 <input type="text" class="form-control">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 form-group">
                           <label class="col-form-label col-form-label-sm">To:</label>
                           <input type="text" class="form-control form-control-sm" name="">
                        </div>
                     </div>
                     <div class="col-md-12 col-sm-7">
                        <div class="form-group col-md-12 col-sm-12">
                           <label class="control-label">Departure:</label>
                           <div class="form-group">
                              <div class="input-group">
                                 <div class="input-group-addon">
                                    <img src="<?php echo base_url(); ?>assets/img/clock(1).png" alt="">
                                 </div>
                                 <input type="date" class="form-control">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-sm-5">
                        <button class="btn btn-sm btn-primary search">Search</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <div class="container">
         <div class="col-md-12 transaction-box">
            <div class="col-md-12">
               <center><h2>Transaksi Pembayaran</h2></center>
            </div>
            <div class="col-md-6">
               <h5>Nomor Rekening</h5>
               <div class="col-md-4 col-sm-4">
                  <img src="<?php echo base_url(); ?>assets/img/BCA.png" class="img img-responsive" alt="">
               </div>
               <div class="rekening col-md-8 col-sm-8">
                  <p>82791498241970842</p>   
               </div>
               <h5>Detail</h5>
               <div class="col-md-12 col-sm-12 panel panel-default detail">
                  <div class="col-md-6 col-sm-6 detail-text">
                     <p>ID Transaksi</p>
                     <p>Waktu Pemesanan</p>
                     <p>Tanggal Pemesanan</p>
                     <p>Jam Keberangkatan</p>
                     <p>Tanggal Keberangkatan</p>
                     <p>Lokasi Penjemputan</p>
                     <p>Lokasi Dropout</p>
                     <p>Nama Travel</p>
                     <p>Jumlah Kursi</p>
                     <p>Harga per Kursi</p>
                     <p>Total</p>
                  </div>
                  <div class="col-md-6 col-sm-6 detail-text-2">
                     <p>#230985712085292704</p>
                     <p>18:45 WIB</p>
                     <p>18-september-2017</p>
                     <p>14:15 WIB</p>
                     <p>25-september-2017</p>
                     <p>Jakarta Utara</p>
                     <p>Denpasar</p>
                     <p>3Lex Travel</p>
                     <p>4</p>
                     <p>Rp.125.000.00,-</p>
                     <p>Rp.500.000.00,-</p>
                  </div>
               </div>
               
            </div>
            <div class="col-md-6">
               <h5>Bukti Pembayaran</h5>
               <form>
                  <input type="file" name="">
                  <div class="thumbnail col-md-6 col-md-offset-3" style="margin-top: 12px;">
                     <img style="width: 95%; height: auto;" class="img img-responsive" src="<?php echo base_url(); ?>assets/img/IMG20170913101740.jpg" alt="">
                  </div>
                  <button style="margin-bottom: 8px;" class="btn btn-primary col-md-12 col-sm-12">Submit</button>
               </form>
            </div>
         </div>
      </div>