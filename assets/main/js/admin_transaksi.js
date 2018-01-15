var transaksi = {}
transaksi.dataMasterTransaksi = ko.observableArray([])
transaksi.showButton = ko.observable(false)

transaksi.newRecordTransakai = function() {
	var data = {
		ALAMAT_MEMBER:"",
		ALAMAT_PENJEMPUTAN:"",
		ALAMAT_PENURUNAN:"",
		BUKTI_BAYAR:"",
		FOTO_KENDARAAN:"",
		ID_JADWAL_TRAVEL:"",
		ID_JENIS_KENDARAAN:"",
		ID_KENDARAAN_TRAVEL:"",
		ID_KOTA_ASAL:"",
		ID_KOTA_TUJUAN:"",
		ID_MEMBER:"",
		ID_RIWAYAT_TRANSAKSI:"",
		ID_TRAVEL:"",
		JAM_PESAN:"",
		JENIS_IDENTITAS:"",
		JML_KURSI:"",
		JUMLAH_KURSI:"",
		KOTAT_ASAL:"",
		KOTA_TUJUAN:"",
		LOGO:"",
		NAMA_MEMBER:"",
		NAMA_TRAVEL:"",
		NOMOR_TELEPON:"",
		NO_IDENTITAS:"",
		NO_POL_KENDARAAN:"",
		PASSWORD:"",
		STATUS:"",
		TANGGAL_KEBERANGKATAN:"",
		TANGGAL_PEMESANAN:"",
		TARIF:0,
		TOTAL_BAYAR:0,
		USERNAME:"",
		WAKTU_BERANGKAT:"",
		WAKTU_SAMPAI:"",
		WARNA_KENDARAAN:""
	}

	return data
}

transaksi.recordTransaksi = ko.mapping.fromJS(transaksi.newRecordTransakai())

transaksi.getDataTransaksi = function(callback){
	model.Processing(true)
    var url = "admin_transaksi/GetDataTransaksi"
    ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        transaksi.dataMasterTransaksi(result.data)
        model.Processing(false)
        callback()
    })
}

transaksi.renderGridTransaksi = function(textSearch) {
	var data = transaksi.dataMasterTransaksi()

    // if (textSearch != "") {
    //     var results = _.filter(data, function (item) {
    //         return _.includes(item.ID_JENIS_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
    //              ||_.includes(item.MERK_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
    //              ||_.includes(item.TYPE_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
    //     });
    //     data = results
    // }

    var columns = [{
        field: 'ID_RIWAYAT_TRANSAKSI',
        title: 'Id Riwayat Transaksi',
        width: 150,
        locked: true
    }, {
        field: 'ID_JADWAL_TRAVEL',
        title: 'Id Jadwal Travel',
        width: 150,
        locked: true
    }, {
        field: 'NAMA_MEMBER',
        title: 'Nama Member',
        width: 150
    }, {
        field: 'NOMOR_TELEPON',
        title: 'Nomor Telepon',
        width: 150
    }, {
        field: 'TANGGAL_PEMESANAN',
        title: 'Tanggal Pesan',
        width: 120
    }, {
        field: 'TANGGAL_KEBERANGKATAN',
        title: 'Tanggal Berangkat',
        width: 120
    }, {
        field: 'JUMLAH_KURSI',
        title: 'Kursi',
        width: 50
    }, {
        field: 'STATUS',
        title: 'Status',
        width: 120,
        locked: true,
    }, {
        // field: 'STATUS',
        title: 'Tenggang Bayar',
        width: 150,
        locked: true,
        template: function(d) {
        	var dateorder = d.TANGGAL_PEMESANAN;
        	var datedepart = d.TANGGAL_KEBERANGKATAN;
        	var time = d.JAM_PESAN;
        	if (d.STATUS == "ORDER") {
        		var tenggangWaktu = SetTenggangWaktu(dateorder, datedepart, time);
        		var tenggang = new Date(tenggangWaktu).getTime() - new Date().getTime()
        		if (tenggang < 0) {
        			return "----------------------------"
        		}
        		return moment(tenggangWaktu).format("YYYY-MM-DD hh:mm:ss")
        	}else{
        		return "----------------------------"
        	}
        }
    }, {
        title: 'Action',
        width: 100,
        locked: true,
        template : function (d) {
            var dsb = ""
            var tooltip = ""
            var hrefdetail = "href=\"javascript:transaksi.showDetailTransaksi('"+d.ID_RIWAYAT_TRANSAKSI+"')\""
            return "<a "+hrefdetail+"class=\"btn btn-xs btn-primary\" "+tooltip+dsb+">Detail</a>"
        }
    }]

    $('#gridTransaksi').kendoGrid({
        dataSource: {
            data: data,
            pageSize: 20
        },
        sortable: true,
        height: 450,
        width: 800,
        filterable: false,
        scrollable: true,
        columns: columns,
        mobile : true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        }
    })
}

transaksi.blokTransaksi = function() {
	var data = {}
	data.ID_RIWAYAT_TRANSAKSI = transaksi.recordTransaksi.ID_RIWAYAT_TRANSAKSI()
	data.STATUS = 'BLOCKED'

	var url = "admin_transaksi/SetStatusTransaksi"
    var param ={
        Data: data
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan memblokir transaksi dengan kode " + data.ID_RIWAYAT_TRANSAKSI + "!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, block it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            ajaxFormPost(url, param, function(res){
                if (res.isError) {
                    swal("Gagal", res.message, "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Transaksi telah terblokir!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        transaksi.getDataTransaksi(function() {
							transaksi.renderGridTransaksi("")
						});
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                '',
                'info'
            )
        }
    })
}

transaksi.konfirmasiTransaksi = function() {
	var data = {}
	data.ID_RIWAYAT_TRANSAKSI = transaksi.recordTransaksi.ID_RIWAYAT_TRANSAKSI()
	data.STATUS = 'CONFIRMED'

	var url = "admin_transaksi/SetStatusTransaksi"
    var param ={
        Data: data
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan mengkonfirmasi transaksi dengan kode " + data.ID_RIWAYAT_TRANSAKSI + "!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: 'rgb(245, 138, 45)',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, confirm it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            ajaxFormPost(url, param, function(res){
                if (res.isError) {
                    swal("Gagal", res.message, "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Transaksi telah terkonfirmasi!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        transaksi.getDataTransaksi(function() {
							transaksi.renderGridTransaksi("")
						});
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                '',
                'info'
            )
        }
    })
}

transaksi.showDetailTransaksi = function(Id) {
	var dataArr = _.filter(transaksi.dataMasterTransaksi(), {'ID_RIWAYAT_TRANSAKSI': Id});

	ko.mapping.fromJS(dataArr[0], transaksi.recordTransaksi)

	var tarifRupiah = ChangeToRupiah(parseFloat(dataArr[0].TARIF))
	var totalRupiah = ChangeToRupiah(parseFloat(dataArr[0].TOTAL_BAYAR))

	transaksi.recordTransaksi.TARIF(tarifRupiah)
	transaksi.recordTransaksi.TOTAL_BAYAR(totalRupiah)
	
	$("#imgLocation").removeAttr("src");
	var src = base_url+"assets/img/default.jpg"
	if (transaksi.recordTransaksi.BUKTI_BAYAR() != "") {
		src = base_url+"assets/uploads/"+transaksi.recordTransaksi.BUKTI_BAYAR()
	}

	$('#detailTansaksiModal').modal('show');
	$("#imgLocation").attr("src",src);
	
}



transaksi.init = function(){
	transaksi.getDataTransaksi(function() {
		transaksi.renderGridTransaksi("")
	});
	if (model.Role() != "ADMIN") {
		transaksi.showButton(true)
	}
}

$(function() {
	transaksi.init()
})