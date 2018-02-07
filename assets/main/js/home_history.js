var history = {}
history.dataMasterHistory = ko.observableArray([])
history.dataMasterOperatorTravel = ko.observableArray([])
history.invalidData = ko.observableArray([])
history.namaTravel = ko.observable()

history.newDataTiket = function() {
    var data = {
        KOTAT_ASAL              : "",
        KOTA_TUJUAN             : "",
        NAMA_TRAVEL             : "",
        WAKTU_BERANGKAT         : "",
        WAKTU_SAMPAI            : "",
        APPROVAL                : "",
        CONTACT                 : "",
        FULL                    : "",
        ALAMAT_PENJEMPUTAN      : "",
        ALAMAT_PENURUNAN        : "",
        ID_RIWAYAT_TRANSAKSI    : "",
        NAMA_OPERATOR           : ""       
    }
    return data
}

history.dataTiket = ko.mapping.fromJS(history.newDataTiket())


history.getDataOperatorTravel = function() {
	var url = base_url+"index.php/history/GetDataOperatorTravel"
	ajaxFormPost(url, {}, function(res) {
        history.dataMasterOperatorTravel(res)
    })
}

history.getDataHistory = function(callback) {
    history.invalidData([])
    var url = base_url+"index.php/history/GetDataHistory"
    ajaxFormPost(url, {}, function(res) {
        history.dataMasterHistory(res)
        callback()
    })
}

history.renderGridHistory = function(textSearch) {
	var data = history.dataMasterHistory()

    var columns = [{
        title: 'Nomor',
        width: 50,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_RIWAYAT_TRANSAKSI == dataItem.ID_RIWAYAT_TRANSAKSI
            })
            return idxs + 1
        }
    }, {
        field: 'NAMA_TRAVEL',
        title: 'Nama Travel',
        width: 150,
    }, {
        field: 'TANGGAL_PEMESANAN',
        title: 'Tanggal Pesan',
        width: 120
    }, {
        field: 'TANGGAL_KEBERANGKATAN',
        title: 'Tanggal Berangkat',
        width: 120
    }, {
        field: 'STATUS',
        title: 'Status',
        width: 75
    }, {
        title: 'Action',
        width: 135,
        template : function (d) {
        	// var dsb = ""
        	var btn = ""
        	var text = ""
        	var href = ""
        	if (d.STATUS == 'BLOCKED') {
        		btn = "btn-danger"
        		// dsb = "disabled=\"disabled\""
        		text = "&nbsp;Transaksi terblokir&nbsp;"
        		href = "href=\"javascript:history.whenTransactionBlocked('"+d.ID_TRAVEL+"','"+d.ID_RIWAYAT_TRANSAKSI+"')\""
        	}
        	if (d.STATUS == 'WAITING') {
        		btn = 'btn-warning'
        		href = "href=\""+base_url+"index.php/transaksi/index/"+d.ID_RIWAYAT_TRANSAKSI+"\""
        		text = "&nbsp;Proses Konfirmasi&nbsp;"
        		// dsb = ""
        	}
        	if (d.STATUS == 'CONFIRMED') {
        		btn = "btn-success"
        		// dsb = ""
                href = "href=\"javascript:history.ShowModalTicket('"+d.ID_RIWAYAT_TRANSAKSI+"')\""
        		text = "&emsp;&nbsp;Terkonfirmasi&nbsp; &emsp;"
        	}

            return "<a class=\" btn btn-sm "+btn+"\""+href+">"+text+"</a>"
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

history.whenTransactionBlocked = function(id_travel, id_transaksi) {
	operatorText = ""
	for (var i = 0; i < history.dataMasterOperatorTravel().length; i++) {
		if (history.dataMasterOperatorTravel()[i].ID_TRAVEL == id_travel) {
		operatorText += history.dataMasterOperatorTravel()[i].NAMA_USER+
						"/"+history.dataMasterOperatorTravel()[i].NOMOR_TELEPON+
						"/"+history.dataMasterOperatorTravel()[i].KOTA+"</br>"
		}
	}
	

	swal({
		title: 'Transaksi</br>('+id_transaksi+') terblokir',
		type: 'warning',
		html:
		  '<b>Hubungi operator dibawah</b></br> '+
		  operatorText,
		showCloseButton: true
	})
}

history.ShowModalTicket = function(id_transaksi) {
    var data = _.filter(history.dataMasterHistory(),{'ID_RIWAYAT_TRANSAKSI':id_transaksi})[0]
    var operator = _.filter(history.dataMasterOperatorTravel(),{'ID_USER':data.APPROVAL})[0]
    // console.log(operator)
    data.FULL = data.JUMLAH_KURSI+" : Rp"+ChangeToRupiah(parseInt(data.TOTAL_BAYAR))
    data.CONTACT = operator.NOMOR_TELEPON
    data.NAMA_OPERATOR = operator.NAMA_USER
    ko.mapping.fromJS(data, history.dataTiket)
    $("#ModalTiket").modal("show")
}

history.printTiket = function(selector) {
    var date = moment(new Date()).format('DD-MMM-YYYY-HH-mm')
    kendo.drawing.drawDOM($(selector)).then(function(group){
        kendo.drawing.pdf.saveAs(group, "Transaksi"+date+".pdf");
    });
}


history.init = function () {
	history.getDataOperatorTravel()
	history.getDataHistory(function() {
		history.renderGridHistory("")
	})
}

$(function() {
	history.init()
})