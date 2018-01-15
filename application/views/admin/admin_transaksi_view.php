<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/admin_transaksi.js"></script>

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Transaksi
      </h1>
    </div>
</div>

<!-- header button and filter -->
<!-- <div class="row">
	<div class="col-md-12">
		<div class="col-md-4 pull-right">
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#addDaerahModal" id="addButton" type="button" onclick="">Tambah <i class="fa fa-plus"></i></button>
		</div>
	</div>
</div> -->

<!-- grid -->
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12" data-bind="visible: !model.Processing()">
            <div id="gridTransaksi"></div>
        </div>
        <?php 
            $this->load->view($loader);
         ?>
    </div>
</div>

<!-- Modal -->
<div id="detailTansaksiModal" class="modal fade" role="dialog" data-bind="with:transaksi">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-body" data-bind="with:recordTransaksi">
            <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class=" panel panel-default col-md-12 col-sm-12">
                    <!-- FORM -->
                    <form class="form-horizontal">
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">ID Transaksi :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" data-bind="text:ID_RIWAYAT_TRANSAKSI"></p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Tanggal Pemesanan :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" id="tanggalPesan" data-bind="text:TANGGAL_PEMESANAN"></p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Waktu Pemesanan :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" id="jamPesan" data-bind="text:JAM_PESAN"><span> WIB</span></p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Tanggal Keberangkatan :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" id="tanggalBerangkat" data-bind="text:TANGGAL_KEBERANGKATAN">
                                </p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Jam Keberangkatan :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" data-bind="text:WAKTU_BERANGKAT"><span> WIB</span></p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Kota Asal :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" data-bind="text: KOTAT_ASAL">
                                </p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Alamat Asal :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" data-bind="text: ALAMAT_PENJEMPUTAN">
                                </p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Kota Tujuan :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" data-bind="text: KOTA_TUJUAN">
                                </p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Alamat Tujuan :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" data-bind="text: ALAMAT_PENURUNAN">
                                </p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Nama Travel :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" data-bind="text: NAMA_TRAVEL"></p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Jumlah Kursi :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static" data-bind="text:JUMLAH_KURSI"></p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Harga per Kursi :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static">Rp<span data-bind="text:TARIF"></span></p>
                            </div>
                        </div>
                        <div class="form-group no-buttom-margin">
                            <label class="control-label col-md-5 col-sm-5" for="email">Total Bayar :</label>
                            <div class="col-md-7 col-sm-7">
                                <p class="form-control-static">Rp<span data-bind="text: TOTAL_BAYAR"></span></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class=" panel panel-default col-md-12 col-sm-12">
                <!-- IMAGE -->
                    <center>
                        <img class="img-style" id="imgLocation" />
                    </center>
                </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default col-sm-2 pull-right" data-dismiss="modal" style="margin-left:5px;">Close</button>
            <button type="button" class="btn btn-success col-sm-2 pull-right" data-bind="visible: transaksi.showButton" onclick="transaksi.konfirmasiTransaksi()">Konfirmasi</button>
            <button type="button" class="btn btn-danger col-sm-2 pull-right" data-bind="visible: transaksi.showButton" onclick="transaksi.blokTransaksi()">Blok</button>
        </div>
    </div>

  </div>
</div>