<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main/css/admin_master_daerah.css">

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
                foreach ($travel as $data) {
                    echo '
                        <tr class="table-active">
                             <td>'.$data->ID_RIWAYAT_TRANSAKSI.'</td>
                             <td>'.$data->ID_JADWAL_TRAVEL.'</td>
                             <td>'.$data->NAMA_MEMBER.'</td>
                             <td>'.$data->JAM_PESAN.'</td>
                             <td>'.$data->TANGGAL_PEMESANAN.'</td>
                             <td>'.$data->TANGGAL_KEBERANGKATAN.'</td>
                             <td>'.$data->ALAMAT_PENJEMPUTAN.'</td>
                             <td>'.$data->ALAMAT_PENURUNAN.'</td>
                             <td>'.$data->JUMLAH_KURSI.'</td>
                             <td>'.$data->TOTAL_BAYAR.'</td>
                             <td>'.$data->BUKTI_BAYAR.'</td>
                             <td>'.$data->STATUS.'</td>
                             <td>
                                <a class="btn btn-warning" href="" data-toggle="modal" data-target="#edit'.$data->ID_RIWAYAT_TRANSAKSI.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                             </td>
                          </tr>
                    ';
                }
            ?>
           </tbody>
        </table>

    </div>
</div>

<?php 
  foreach ($travel as $data) {
    echo '
      <div id="edit'.$data->ID_RIWAYAT_TRANSAKSI.'" class="modal fade" role="dialog">
           <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Status Transaksi</h4>
                 </div>
                 <div class="modal-body">
                    <form method="post" action="'.base_url().'index.php/admin_transaksi/edit/'.$data->ID_RIWAYAT_TRANSAKSI.'" enctype="multipart/form-data">

                      <input type="text" name="id_riwayat_transaksi" value="'.$data->ID_RIWAYAT_TRANSAKSI.'" hidden>
                      <input type="text" name="id_member" value="'.$data->ID_MEMBER.'" hidden>
                      <input type="text" name="jam_pesan" value="'.$data->JAM_PESAN.'" hidden>
                      <input type="text" name="tanggal_pemesanan" value="'.$data->TANGGAL_PEMESANAN.'" hidden>
                      <input type="text" name="tanggal_keberangkatan" value="'.$data->TANGGAL_KEBERANGKATAN.'" hidden>
                      <input type="text" name="bukti_bayar" value="'.$data->BUKTI_BAYAR.'" hidden>
                      <input type="text" name="alamat_penjemputan" value="'.$data->ALAMAT_PENJEMPUTAN.'" hidden>
                      <input type="text" name="alamat_penurunan" value="'.$data->ALAMAT_PENURUNAN.'" hidden>
                      <input type="text" name="jumlah_kursi" value="'.$data->JUMLAH_KURSI.'" hidden>
                      <input type="text" name="total_bayar" value="'.$data->TOTAL_BAYAR.'" hidden>

                        <h2 style="text-align:center">Update Status Transaksi</h2>
                              <div class="form-check col-md-3">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="status" value="ORDER" checked="">
                                  ORDER
                                </label>
                              </div>
                              <div class="form-check col-md-3">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="status" value="BLOCKED">
                                  BLOCKED
                                </label>
                              </div>
                              <div class="form-check col-md-3">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="status" value="WAITING">
                                  WAITING
                                </label>
                              </div>
                              <div class="form-check col-md-3">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="status" value="CONFIRMED">
                                  CONFIRMED
                                </label>
                              </div>
                       <input type="submit" style="margin-bottom: 12px;" class="btn btn-success btn-block" value="Submit" name="submit">
                    </form>
                 </div>
              </div>
           </div>
        </div>
      ';
  } 

    ?>




