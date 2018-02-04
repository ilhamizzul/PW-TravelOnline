var landingpage = {}
landingpage.dataMasterKota = ko.observableArray([])

landingpage.tarif = ko.observable()
landingpage.namaTravel = ko.observable()
landingpage.namaKotaAS = ko.observable()
landingpage.namaKotaTJ = ko.observable()
var tmpKursi = 0

landingpage.newRecordFilter = function() {
	var data = {
		FROM : "",
		TO : "",
		DEPARTURE : moment(setDateMin()).format('YYYY-MM-DD'),
		MINIMUMSEAT : 1
	}
	return data
}
landingpage.recordFilter = ko.mapping.fromJS(landingpage.newRecordFilter())

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
		DESA_ASAL : "",
		ALAMAT_PENJEMPUTAN : "",
		DESA_TUJUAN : "",
		ALAMAT_PENURUNAN : "",
		JUMLAH_KURSI : 1,
		TOTAL_BAYAR : 0
	}

	return data
}

landingpage.filterData = function() {
	data = ko.mapping.toJS(landingpage.recordFilter);
	// var url = "home/get_data"
	// param = {
	// 	Data : data
	// }
	if (data.FROM == "") {
		data.FROM = 'default'
	}

	if (data.TO == "") {
		data.TO = 'default'
	}
	 // console.log()
	location.href = base_url+'index.php/home/setFilteredData/'+data.FROM+'/'+data.TO+'/'+data.DEPARTURE+'/'+data.MINIMUMSEAT
}

landingpage.recordTransaksi = ko.mapping.fromJS(landingpage.newRecordTransaksi())

landingpage.getDataKota = function(){
	var url = base_url+'index.php/home/GetDataKota'
	var param = {}
    ajaxPost(url, param, function(res) {
        var data = res
        var data = JSON.parse(res)
        landingpage.dataMasterKota(data)
    })
}

landingpage.init = function() {
	landingpage.getDataKota()
}

landingpage.showDetail = function(id_travel, asal, tujuan, tarif, kursi, namatravel, id_jadwal_travel, kotaasal, kotatujuan, datedepart, srcLogo) {
	if ($("#Tanggugan").text() > 5) {
		return swal('Forbidden!',
				'Anda masih memiliki 5 tanggungan transaksi, untuk melakukan pemesanan, silakan melakukan pembayaran dan mengirim bukti tranfer',
				'error').then((result) => {
					window.location.assign(base_url+"index.php/tanggungan")
				})
		
	}
	$("#chooseTujuan").modal('show')

	ko.mapping.fromJS(landingpage.newRecordTransaksi(), landingpage.recordTransaksi)
	landingpage.namaKotaAS(kotaasal)
	landingpage.namaKotaTJ(kotatujuan)
	if (datedepart != "") {
		landingpage.recordFilter.DEPARTURE(datedepart)
	}
	// console.log(srcLogo)
	$("#imageDetail").attr("src", srcLogo)

	tmpKursi = kursi
	landingpage.namaTravel(namatravel)
	landingpage.recordTransaksi.TOTAL_BAYAR(ChangeToRupiah(tarif))
	landingpage.tarif(tarif)
	landingpage.recordTransaksi.JUMLAH_KURSI(1)
	// landingpage.recordTransaksi.ID_TRAVEL(id)
	landingpage.recordTransaksi.ID_JADWAL_TRAVEL(id_jadwal_travel)

	var dataasal = _.filter(landingpage.dataMasterKota(), {'ID_KOTA': asal, 'ID_TRAVEL': id_travel});
	var myselectAsal = $('<select>');
	$('#desaAsal').children('option:not(:first)').remove();
    $.each(dataasal, function(index, key) {
		myselectAsal.append( $('<option></option>').val(key.NAMA_DESA).html(key.NAMA_DESA) );
    });
    $('#desaAsal').append(myselectAsal.html());

    var datatujuan = _.filter(landingpage.dataMasterKota(), {'ID_KOTA': tujuan, 'ID_TRAVEL': id_travel});
    var myselectTujuan = $('<select>');
    $('#desaTujuan').children('option:not(:first)').remove();
    $.each(datatujuan, function(index, key) {
		myselectTujuan.append( $('<option></option>').val(key.NAMA_DESA).html(key.NAMA_DESA) );
    });
    $('#desaTujuan').append(myselectTujuan.html());
}

landingpage.saveTransaction = function () {
	var data = ko.mapping.toJS(landingpage.recordTransaksi)
	data.TANGGAL_PEMESANAN = moment(new Date()).format('YYYY-MM-DD')
	data.TANGGAL_KEBERANGKATAN = landingpage.recordFilter.DEPARTURE()
	data.JAM_PESAN = moment(new Date()).format('HH:mm:ss')
	data.TOTAL_BAYAR = FormatCurrency(data.TOTAL_BAYAR)

	var url = base_url+"index.php/home/SaveTransaction"
	var param = {
		Data : data
	}

	swal({
        title: "Apakah Anda yakin?",
        text: "Membeli tiket "+landingpage.namaTravel()+" "+landingpage.namaKotaAS()+"-"+landingpage.namaKotaTJ()+"!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#chooseTujuan').modal('hide');
            ajaxFormPost(url, param, function(res){
                if (res.isError) {
                    swal("Gagal", res.message, "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Transaksi telah tersimpan!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                    	window.location.assign(base_url+'index.php/transaksi/index/'+res.data)
                    	// location.href = base_url+'index.php/transaksi/index/'+res.data
                    });
                }
            })
        } else if (result.dismiss === 'cancel') {
            $.when(
                swal(
                    'Dibatalkan',
                    '',
                    'error'
                )
            ).done(
                function () {
                    $('#chooseTujuan').modal('hide');
                }
            )
        }
    })
}

landingpage.closeModal = function() {
	$('#choose').modal("hide")
}

landingpage.maskingNumber = function() {
	$(".Number").inputmask('Regex', { regex: "^[1-9][0-9]?$|^100$" });
}

landingpage.tarif.subscribe(function(x) {
	var totbayar = x*landingpage.recordTransaksi.JUMLAH_KURSI()
	landingpage.recordTransaksi.TOTAL_BAYAR(ChangeToRupiah(totbayar))
})

landingpage.recordTransaksi.JUMLAH_KURSI.subscribe(function(x) {
	if (tmpKursi < x) {
		swal("Mohon maaf!","hanya tersisa "+tmpKursi+" kursi", "warning")
		landingpage.recordTransaksi.JUMLAH_KURSI(tmpKursi)
		return
	}
	var totbayar = x* landingpage.tarif()
	landingpage.recordTransaksi.TOTAL_BAYAR(ChangeToRupiah(totbayar))
})

$(function () {
	landingpage.init()
	landingpage.maskingNumber()
})