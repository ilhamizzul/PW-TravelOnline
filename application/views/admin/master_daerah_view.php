<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/admin_master_daerah.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Daerah</h1>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="col-md-4 pull-right">
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#addDaerahModal" id="addButton" type="button" onclick="master_daerah.showAddModal()">Tambah <span data-bind="text: master_daerah.addButtonText"></span> <i class="fa fa-plus"></i></button>
			<button class="btn btn-success pull-right padding-right" type="button">Import from Excel <i class="fa fa-download"></i></button>
		</div>
		<div class="col-md-3 pull-right">
			<div class="form-group input-group">
			    <input id="textSearchID" type="text" class="form-control" data-bind="value: master_daerah.textSearch">
			    <span class="input-group-btn">
			    	<button class="btn btn-default" onclick="master_daerah.searchDaerah()" type="button"><i class="fa fa-search"></i></button>
			    </span>
			</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-md-12" >
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active tab1"><a href="#Provinsi" aria-controls="Provinsi" role="tab" data-toggle="tab" onclick="master_daerah.changeDaerah('Provinsi')">Provinsi</a></li>
            <li role="presentation"><a href="#Kota" class="tabTitle" aria-controls="Kota" role="tab" data-toggle="tab" onclick="master_daerah.changeDaerah('Kota')">Kota</a></li>
            <li role="presentation"><a href="#Desa" class="tabTitle" aria-controls="Desa" role="tab" data-toggle="tab" onclick="master_daerah.changeDaerah('Desa')">Desa</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="Provinsi">
                <div class="tab-pane-content">
                    <div class="row">
                        <div class="col-md-12" data-bind="visible: !model.Processing()">
                            <div id="gridProvinsi"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane " id="Kota">
                <div class="tab-pane-content">
                    <div class="row">
                        <div class="col-md-12" data-bind="visible: !model.Processing()">
                            <div id="gridKota"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane " id="Desa">
                <div class="tab-pane-content">
                    <div class="row">
                        <div class="col-md-12" data-bind="visible: !model.Processing()">
                            <div id="gridDesa"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="addDaerahModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span data-bind="text: master_daerah.HeaderText"></span> <span data-bind="text: master_daerah.addButtonText"></span></h4>
      </div>
      <div class="modal-body">
        <div class="form-group" data-bind="visible: master_daerah.showInAddKota">
            <label>Pilih Provinsi</label><br>
            <select class="form-control select-form" id="dropdownProvinsi" data-bind="kendoDropDownList: { data: master_daerah.dataMasterProvinsi, dataValueField: 'ID_PROVINSI', dataTextField: 'NAMA_PROVINSI',optionLabel:'Select one',filter: 'contains'}, value: master_daerah.recordKota.ID_PROVINSI" >
            </select>
        </div>

        <div class="form-group" data-bind="visible: master_daerah.showInAddDesa">
            <label>Pilih Kota/Kabupaten</label><br>
            <select class="form-control select-form" onchange="master_daerah.changeKeterangan()" id="dropdownKota" data-bind="kendoDropDownList: { data: master_daerah.dataMasterKota, dataValueField: 'ID_KOTA', dataTextField: 'NAMA_KOTA',optionLabel:'Select one',filter: 'contains'}, value: master_daerah.recordDesa.ID_KOTA">
            </select>
            <span data-bind="text: master_daerah.keteranganKotKab"></span>
        </div>

        <div class="form-group" data-bind="visible: master_daerah.showInAddProvinsi">
            <label>Nama Provinsi</label>
            <input class="form-control input-form" data-bind="value: master_daerah.recordProvinsi.NAMA_PROVINSI">
        </div>

        <div class="form-group" data-bind="visible: master_daerah.showInAddKota">
            <label>Nama Kota</label>
            <input class="form-control input-form" data-bind="value: master_daerah.recordKota.NAMA_KOTA">
        </div>

        <div class="form-group" data-bind="visible: master_daerah.showInAddDesa">
            <label>Nama Desa</label>
            <input class="form-control input-form" data-bind="value: master_daerah.recordDesa.NAMA_DESA">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" data-bind="visible: master_daerah.showAdd">Submit</button>
        <button type="button" class="btn btn-success" data-bind="visible: master_daerah.showEdit">Change</button>
      </div>
    </div>

  </div>
</div>
