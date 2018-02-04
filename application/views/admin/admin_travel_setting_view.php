<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">
<script src="<?php echo base_url(); ?>assets/main/js/admin_travel_setting.js"></script>

<!-- Header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Travel Setting</h1>
    </div>
</div>

<!-- DATA -->
<div class="row">
    <div class="col-md-12" data-bind="visible: !model.Processing(), with: travelsetting">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Profil Travel</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" data-bind="with: dataTravelSetting">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Kode Travel:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" data-bind="text: ID_TRAVEL"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nama Travel :</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" data-bind="text: NAMA_TRAVEL"></p>
                            </div>
                        </div>
                    </form>
                </div> 
                <div class="panel-footer" style="text-align: right;">
                    <a href="javascript: travelsetting.editTravel()" type="button" class="btn btn-warning btn-sm" >Edit Travel</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Logo Travel</h4>
                </div>
                <div class="panel-body" data-bind="with: dataTravelSetting">
                    <div class="thumbnail col-md-8 col-md-offset-2">
                        <img src="" id="imageLogo" alt="can't load image">
                    </div>
                </div> 
                <div class="panel-footer" style="text-align: right;">
                    <a href="javascript: travelsetting.changeLogo()" type="button" class="btn btn-warning btn-sm">Ganti Logo</a>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $this->load->view($loader);
     ?>
</div>

<!-- MODAL -->
<!-- EDIT RPOFILE MODAL -->
<div id="editTravelModal" class="modal fade" role="dialog" data-bind="with: travelsetting">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Travel</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <div class="form-group">
                        <label>Nama Travel</label>
                        <input type="text" class="form-control" data-bind="value: namaTravel">
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="travelsetting.saveNamaTravel()">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- CHANGE LOGO MODAL -->
<div id="changeLogo" class="modal fade" role="dialog" data-bind="with: travelsetting">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ganti Logo</h4>
            </div>
            <div class="modal-body" data-bind="">
                <fieldset>
                <div class="form-group">
                    <label>Logo</label>
                    <input type="file" id="inputImage" class="form-control" onchange="travelsetting.readURL(this)">
                </div>
                <div class="thumbnail col-md-8 col-md-offset-2">
                    <img src="" id="inputLogo" alt="can't load image">
                </div>
            </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="travelsetting.saveLogo()">Submit</button>
            </div>
        </div>
    </div>
</div>