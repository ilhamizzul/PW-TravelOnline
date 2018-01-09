<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/admin_travel_agen.js"></script>

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Agen Travel</h1>
    </div>
</div>

<!-- nav -->
<div class="row">
	<div class="col-md-12">
		<div class="col-md-2 pull-right">
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#addAgenTravel" id="addButton" type="button">Tambah Agen Travel <i class="fa fa-plus"></i></button>
		</div>
		<div class="col-md-3 pull-right">
			<div class="form-group input-group">
			    <input id="textSearchID" type="text" class="form-control" data-bind="value: agentravel.textSearch">
			    <span class="input-group-btn">
			    	<button class="btn btn-default" onclick="agentravel.search()" type="button"><i class="fa fa-search"></i></button>
			    </span>
			</div>
		</div>
	</div>
</div>

<!-- Grid -->
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12" data-bind="visible: !model.Processing()">
            <div id="gridAgenTravel"></div>
        </div>
        <?php 
        	$this->load->view($loader);
    	?>
    </div>
</div>

<!-- Modal -->
<div id="addAgenTravel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span data-bind="text: agentravel.HeaderText"></span> Agen Travel</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Travel</label>
                    <input class="form-control input-form" data-bind="value: agentravel.namaTravel">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="agentravel.saveData()">Submit</button>
            </div>
        </div>

    </div>
</div>