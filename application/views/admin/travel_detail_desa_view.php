<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css"> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/admin_travel_detail_desa.js"></script>

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detail Desa Travel</h1>
    </div>
</div>

<!-- nav -->
<div class="row">
	<div class="col-md-12">
		<div class="col-md-2 pull-right">
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#addDetailDesaModal" id="addButton" type="button">Tambah Detail Desa <i class="fa fa-plus"></i></button>
		</div>
		<div class="col-md-3 pull-right">
			<div class="form-group input-group">
			    <input id="textSearchID" type="text" class="form-control" data-bind="value: detaildesa.textSearch">
			    <span class="input-group-btn">
			    	<button class="btn btn-default" onclick="detaildesa.search()" type="button"><i class="fa fa-search"></i></button>
			    </span>
			</div>
		</div>
	</div>
</div>

<!-- Grid -->
<div class="row">
  <div class="col-md-12">
    <div class="col-md-12" data-bind="visible: !model.Processing()">
        <div id="gridDetailDesa"></div>
    </div>
    <?php 
        $this->load->view($loader);
     ?>
  </div>
</div>

<!-- Modal -->
<div id="addDetailDesaModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content -->
    <div class="modal-content" data-bind="with:detaildesa">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Cakupan Desa</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Kota</label></br>
              <select style="width: 70%" class="form-control select-form" id="dropdownKota" data-bind="kendoDropDownList: { data:dataMasterKota, dataValueField: 'ID_KOTA', dataTextField: 'NAMA_KOTA', optionLabel:'Select one',filter: 'contains'}, value: selectedKota" >
              </select>
              <span data-bind="text: textKeterangan"></span>
        </div>

        <div class="form-group" data-bind="visible: visibleDropDownDesa">
            <label>Desa</label>
            <select style="width: 100%" class="form-control select-form" id="multiselectDesa" data-bind="kendoMultiSelect:{ placeholder: 'Pilih Desa...', dataTextField: 'NAMA_DESA', dataValueField: 'ID_DESA', data: dataMultiSelectDesa, value: selectedDesa, search: search}">
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" onclick="detaildesa.saveDetailDesa()">Submit</button>
        <!-- <button type="button" class="btn btn-warning" onclick="jenismobil.editData()" data-bind="visible: jenismobil.showEdit">Change</button> -->
      </div>
    </div>

  </div>
</div>