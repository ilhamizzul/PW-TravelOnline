var landingpage = {}
landingpage.dataMasterKota = []

landingpage.tarif = ko.observable()

landingpage.newRecordTransaksi = function(){
	var data = {
		ID_RIWAYAT_TRANSAKSI : "",
		ID_MEMBER : "",
		ID_JADWAL_TRAVEL : "",
		JAM_PESAN : "",
		TANGGAL_PEMESANAN : "",
		TANGGAL_KEBERANGKATAN : "",
		BUKTI_BAYAR : "",
		STATUS : "",
		ALAMAT_PENJEMPUTAN : "",
		ALAMAT_PENURUNAN : "",
		JUMLAH_KURSI : 1,
		TOTAL_BAYAR : 0
	}

	return data
}

landingpage.recordTransaksi = ko.mapping.fromJS(landingpage.newRecordTransaksi())

landingpage.getDataKota = function(){
	var url = "home/GetDataKota"
	var param = {}
    ajaxPost(url, param, function(res) {
        var data = JSON.parse(res)
        landingpage.dataMasterKota = data
    })
}

landingpage.init = function() {
	landingpage.getDataKota()
}

landingpage.showDetail = function(id, asal, tujuan, tarif) {
	landingpage.tarif(tarif)
	var myselectAsal = $('<select>');
	$('#desaAsal').children('option:not(:first)').remove();
    $.each(landingpage.dataMasterKota, function(index, key) {
		myselectAsal.append( $('<option></option>').val(key.NAMA_DESA).html(key.NAMA_DESA) );
    });
    $('#desaAsal').append(myselectAsal.html());

    var myselectTujuan = $('<select>');
    $('#desaTujuan').children('option:not(:first)').remove();
    $.each(landingpage.dataMasterKota, function(index, key) {
		myselectTujuan.append( $('<option></option>').val(key.NAMA_DESA).html(key.NAMA_DESA) );
    });
    $('#desaTujuan').append(myselectTujuan.html());
}

landingpage.tarif.subscribe(function(x) {
	var totbayar = x*landingpage.recordTransaksi.JUMLAH_KURSI()
	landingpage.recordTransaksi.TOTAL_BAYAR(totbayar)
})

landingpage.recordTransaksi.JUMLAH_KURSI.subscribe(function(x) {
	console.log(x)
	var totbayar = x* landingpage.tarif()
	landingpage.recordTransaksi.TOTAL_BAYAR(totbayar)
})

$(function () {
	landingpage.init()
})