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
<!-- <div class="row">
    <div style="overflow-x: auto;">
        <table class="table table-hover table-striped table-bordered" style="margin-top: 12px;">
           <thead>
              <tr>
                 <th>ID Riwayat Transaksi</th>
                 <th>ID Jadwal Travel</th>
                 <th>Nama Member</th>
                 <th>Jam Pesan</th>
                 <th>Tanggal Pemesanan</th>
                 <th>Tanggal Keberangkatan</th>
                 <th>Alamat Penjemputan</th>
                 <th>Alamat Penurunan</th>
                 <th>Jumlah Kursi</th>
                 <th>Total Biaya</th>
                 <th>Bukti Bayar</th>
                 <th>Status</th>
                 <th>Aksi</th>
              </tr>
           </thead>
           <tbody>
             <?php 
                // foreach ($travel as $data) {
                //     echo '
                //         <tr class="table-active">
                //              <td>'.$data->ID_RIWAYAT_TRANSAKSI.'</td>
                //              <td>'.$data->ID_JADWAL_TRAVEL.'</td>
                //              <td>'.$data->NAMA_MEMBER.'</td>
                //              <td>'.$data->JAM_PESAN.'</td>
                //              <td>'.$data->TANGGAL_PEMESANAN.'</td>
                //              <td>'.$data->TANGGAL_KEBERANGKATAN.'</td>
                //              <td>'.$data->ALAMAT_PENJEMPUTAN.'</td>
                //              <td>'.$data->ALAMAT_PENURUNAN.'</td>
                //              <td>'.$data->JUMLAH_KURSI.'</td>
                //              <td>'.$data->TOTAL_BAYAR.'</td>
                //              <td>'.$data->BUKTI_BAYAR.'</td>
                //              <td>'.$data->STATUS.'</td>
                //              <td>
                //                 <a class="btn btn-warning" href="" data-toggle="modal" data-target="#edit'.$data->ID_RIWAYAT_TRANSAKSI.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                //              </td>
                //           </tr>
                //     ';
                // }
            ?>
           </tbody>
        </table>

    </div>
</div>
-->
