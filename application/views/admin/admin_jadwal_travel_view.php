<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">
<script src="<?php echo base_url(); ?>assets/main/js/admin_jadwal_travel.js"></script>

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Jadwal Travel
      </h1>
    </div>
</div>


<!-- nav -->
<div class="row">
  <div class="col-md-12">
    <?php 
      if ($this->session->userdata('LEVEL') == 'OPERATOR' || $this->session->userdata('LEVEL') == 'OWNER') {
     ?>
    <div class="col-md-2 pull-right">
      <button class="btn btn-success pull-right" data-toggle="modal" data-target="#addJadwalModal" id="addButton" type="button" onclick="jadwaltravel.addJadwalTravel()">Tambah Jadwal <i class="fa fa-plus"></i></button>
    </div>
    <?php } ?>
    <div class="col-md-3 pull-right">
      <div class="form-group input-group">
          <input id="textSearchID" type="text" class="form-control" data-bind="value: jadwaltravel.textSearch">
          <span class="input-group-btn">
            <button class="btn btn-default" onclick="jadwaltravel.search()" type="button"><i class="fa fa-search"></i></button>
          </span>
      </div>
    </div>
  </div>
</div>
      

<!-- grid -->
<div class="row">
  <div class="col-md-12">
    <div class="col-md-12" data-bind="visible: !model.Processing()">
        <div id="gridJadwalTravel"></div>
    </div>
    <?php 
        $this->load->view($loader);
     ?>
  </div>
</div>

<!-- Modal -->
<div id="addJadwalModal" class="modal fade" role="dialog" data-bind="with: jadwaltravel">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Jadwal Travel</h4>
      </div>
      <div class="modal-body" data-bind="with: recordJadwalTravel">
        <!-- <form method="post" action="<?php echo base_url(); ?>index.php/admin_jadwal_travel/save"> -->
          <fieldset>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor Polisi Kendaraan Travel</label>
                      <input  class="form-control kendoDropdown" id="kendaraan_travel" data-bind="value: ID_KENDARAAN_TRAVEL">
                    </div>
                    <div class="form-group">
                      <label>Kota Asal</label>
                      <input class="form-control kendoDropdown" id="asal" data-bind="value: ID_KOTA_ASAL">     
                    </div>
                    <div class="form-group">
                      <label>Kota Tujuan</label>
                      <input class="form-control kendoDropdown" id="tujuan" data-bind="value: ID_KOTA_TUJUAN">     
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Waktu Berangkat</label>
                      <input type="time" name="berangkat" class="form-control input-form" data-bind="value: WAKTU_BERANGKAT">
                    </div>
                    <div class="form-group">
                      <label>Waktu Sampai</label>
                      <input type="time" name="sampai" class="form-control input-form" data-bind="value: WAKTU_SAMPAI">
                    </div>
                    <div class="form-group">
                      <label>Tarif</label>
                      <input type="text" name="tarif" class="form-control input-form currency" data-bind="value: TARIF">
                    </div>
                </div>
                
            </fieldset>
        <!-- </form> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" data-bind="visible: jadwaltravel.showInAdd" onclick="jadwaltravel.saveJadwalTravel()">Sumbmit</button>
        <button type="button" class="btn btn-warning" data-bind="visible: jadwaltravel.showInEdit" onclick="jadwaltravel.updateJadwalTravel()">Edit</button>
      </div>
    </div>
  </div>
</div> 
