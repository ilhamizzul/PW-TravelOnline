<script type="text/javascript" src="<?php echo base_url(); ?>assets/main/js/admin_master_pelanggan.js"></script>

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pelanggan</h1>
    </div>
</div>

<!-- nav -->
<div class="row">
	<div class="col-md-12">
		<div class="col-md-3 pull-right">
			<div class="form-group input-group">
			    <input id="textSearchID" type="text" class="form-control" data-bind="value: pelanggan.textSearch">
			    <span class="input-group-btn">
			    	<button class="btn btn-default" onclick="pelanggan.search()" type="button"><i class="fa fa-search"></i></button>
			    </span>
			</div>
		</div>
	</div>
</div>

<!-- grid -->
<div class="row">
  <div class="col-md-12">
    <div class="col-md-12" data-bind="visible: !model.Processing()">
        <div id="gridPelanggan"></div>
    </div>
    <?php 
        $this->load->view($loader);
     ?>
  </div>
</div>