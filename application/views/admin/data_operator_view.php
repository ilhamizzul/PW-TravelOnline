<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">
<script src="<?php echo base_url(); ?>assets/main/js/admin_data_operator.js"></script>

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Operator</h1>
    </div>
</div>

<!-- nav -->
<div class="row">
    <div class="col-md-12">
        <?php 
            if ($this->session->userdata('LEVEL') == 'OWNER') {
        ?>
            <div class="col-md-2 pull-right">
                <button class="btn btn-success pull-right" data-toggle="modal" data-target="#addOperator" id="addButton" type="button" onclick="">Tambah Operator <i class="fa fa-plus"></i></button>
            </div>
        <?php 
            } 
        ?>
        <div class="col-md-3 pull-right">
            <div class="form-group input-group">
                <input id="textSearchID" type="text" class="form-control" data-bind="value: dataoperator.textSearch">
                <span class="input-group-btn">
                    <button class="btn btn-default" onclick="dataoperator.search()" type="button"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Grid -->
<div class="row">
  <div class="col-md-12">
    <div class="col-md-12" data-bind="visible: !model.Processing()">
        <div id="gridDataOperator"></div>
    </div>
    <?php 
        $this->load->view($loader);
    ?>
  </div>
</div>

<!-- Modal -->
<div id="addOperator" class="modal fade" role="dialog" data-bind="with: dataoperator">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Operator</h4>
            </div>
            <div class="modal-body" data-bind="with: recordDataOperator">
                <fieldset>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Operator" required data-bind="value: NAMA_USER">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Masukkan Username Akun Operator" required data-bind="value: USERNAME_ADMIN">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Masukkan Password Akun Operator" required data-bind="value: PASSWORD_ADMIN">
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="number" class="form-control" placeholder="Masukkan Nomor Telepon Operator" data-bind="value: NOMOR_TELEPON">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" class="form-control" placeholder="Masukkan Kota Kerja Operator" required data-bind="value: KOTA">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="8" placeholder="Masukkan Alamat Detail Operator" required data-bind="value: ALAMAT_USER"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="dataoperator.saveDataOperator()">Submit</button>
            </div>
        </div>

    </div>
</div>