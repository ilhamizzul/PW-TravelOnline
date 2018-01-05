<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css"> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/admin_master_jenismobil.js"></script>

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Jenis Mobil</h1>
    </div>
</div>

<!-- nav -->
<div class="row">
	<div class="col-md-12">
		<div class="col-md-2 pull-right">
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#addJenisMobilModal" id="addButton" type="button" onclick="jenismobil.showAddModal()">Tambah Jenis Mobil <i class="fa fa-plus"></i></button>
		</div>
		<div class="col-md-3 pull-right">
			<div class="form-group input-group">
			    <input id="textSearchID" type="text" class="form-control" data-bind="value: jenismobil.textSearch">
			    <span class="input-group-btn">
			    	<button class="btn btn-default" onclick="jenismobil.search()" type="button"><i class="fa fa-search"></i></button>
			    </span>
			</div>
		</div>
	</div>
</div>

<!-- Grid -->
<div class="row">
  <div class="col-md-12">
    <div class="col-md-12" data-bind="visible: !model.Processing()">
        <div id="gridJenisMobil"></div>
    </div>
    <?php 
        $this->load->view($loader);
     ?>
  </div>
</div>

<!-- Modal -->
<div id="addJenisMobilModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span data-bind="text: jenismobil.HeaderText"></span> Jenis Mobil</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Merk Kendaraan</label>
            <input class="form-control input-form" data-bind="value: jenismobil.record.MERK_KENDARAAN">
        </div>

        <div class="form-group">
            <label>Type Kendaraan</label>
            <input class="form-control input-form" data-bind="value: jenismobil.record.TYPE_KENDARAAN">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" onclick="jenismobil.saveData()" data-bind="visible: jenismobil.showAdd">Submit</button>
        <button type="button" class="btn btn-warning" onclick="jenismobil.editData()" data-bind="visible: jenismobil.showEdit">Change</button>
      </div>
    </div>

  </div>
</div>