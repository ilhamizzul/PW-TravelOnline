<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/transaksi_page.js"></script>
<script type="text/javascript">
   var STATUS = '<?php echo($data_transaksi[0]->STATUS); ?>'
</script>

<div class="container">
    <div class="col-md-12 transaction-box">
        <div class="col-md-12">
            <center>
                <h2>Transaksi Pembayaran</h2>
            </center>
        </div>
        <div class="col-md-6">
         <?php if ($data_transaksi[0]->STATUS == "ORDER") { ?>
            <h5>Kirim pembayaran ke nomor rekening dibawah</h5>
            <div class="rekening col-md-12 col-sm-12">
                <p id="BANK"></p>
            </div>
         <?php } ?>
            <h5>Detail</h5>
            <div class="col-md-12 col-sm-12 panel panel-default detail">
               <form class="form-horizontal">
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">ID Transaksi :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static"><?php echo $data_transaksi[0]->ID_RIWAYAT_TRANSAKSI; ?></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Tanggal Pemesanan :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static" id="tanggalPesan"><?php echo $data_transaksi[0]->TANGGAL_PEMESANAN;?></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Waktu Pemesanan :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static" id="jamPesan"><?php echo $data_transaksi[0]->JAM_PESAN;?><span> WIB</span></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Tanggal Keberangkatan :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static" id="tanggalBerangkat"><?php echo $data_transaksi[0]->TANGGAL_KEBERANGKATAN;?></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Jam Keberangkatan :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static"><?php echo $data_transaksi[0]->WAKTU_BERANGKAT;?><span> WIB</span></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Lokasi Penjemputan :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static"><?php echo $data_transaksi[0]->ALAMAT_PENJEMPUTAN;?></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Lokasi Dropout :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static"><?php echo $data_transaksi[0]->ALAMAT_PENURUNAN;?></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Nama Travel :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static"><?php echo $data_transaksi[0]->NAMA_TRAVEL;?></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Jumlah Kursi :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static"><?php echo $data_transaksi[0]->JUMLAH_KURSI;?></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Harga per Kursi :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static"><?php echo 'Rp'.number_format( $data_transaksi[0]->TARIF, 0 , '' , ',' ).',-';?></p>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-5 col-sm-5" for="email">Total Bayar :</label>
                     <div class="col-md-7 col-sm-7">
                     <p class="form-control-static"><?php echo 'Rp'.number_format( $data_transaksi[0]->TOTAL_BAYAR, 0 , '' , ',' ).',-';?></p>
                     </div>
                  </div>
               </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 col-sm-12">
            <?php if ($data_transaksi[0]->STATUS == "ORDER") { ?>
               <h5>Deadline Pengiriman Bukti Bayar</h5>
               <div class="col-md-12 col-sm-12 DeadlinePembayaran">
                  <p id="STATUS" hidden="hidden"><?php echo $data_transaksi[0]->STATUS; ?></p>
                  <p id="CountDown"></p>
               </div>
            <?php } ?>
            </div>
            <div class="col-md-12 col-sm-12">
               <h5>Bukti Pembayaran</h5>
               <?php if ($data_transaksi[0]->STATUS == "ORDER") {
                  echo "<input  type=\"file\" id=\"inputImage\" name=\"img\" onchange=\"transaksi.readURL(this)\">";
               } ?>
               <!-- <form> -->
                  <div class="thumbnail col-md-6 col-md-offset-3" style="margin-top: 12px;">
                     <?php if ($data_transaksi[0]->BUKTI_BAYAR == "") { ?>
                       <img style="width: 95%; height: auto;" id="imgBuktiTransfer" class="img img-responsive" src="<?php echo base_url(); ?>assets/img/default.jpg" alt="">
                     <?php } else { ?>
                        <img style="width: 95%; height: auto;" id="imgBuktiTransfer" class="img img-responsive" src="<?php echo base_url(); ?>assets/uploads/<?php echo($data_transaksi[0]->BUKTI_BAYAR); ?>" alt="">
                     <?php } ?>
                  </div>
                  <?php if ($data_transaksi[0]->STATUS == "ORDER") { ?>
                     <button style="margin-bottom: 8px;" class="btn btn-primary col-md-12 col-sm-12" onclick="transaksi.uploadBuktiPembayaran('<?php echo $data_transaksi[0]->ID_RIWAYAT_TRANSAKSI; ?>')">Submit</button>
                  <?php } ?>
            </div>
        </div>
    </div>
</div>
