<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/home_history.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/history_page.css">

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
                 </div>
             </div>
         </div>
      </div>