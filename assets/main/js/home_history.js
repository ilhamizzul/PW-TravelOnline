var history = {}
history.dataMasterHistory = ko.observableArray([])
history.dataMasterOperatorTravel = ko.observableArray([])
history.invalidData = ko.observableArray([])
history.namaTravel = ko.observable()

history.getDataOperatorTravel = function() {
	var url = base_url+"index.php/history/GetDataOperatorTravel"
	ajaxFormPost(url, {}, function(res) {
        // var result = JSON.parse(res)
        history.dataMasterOperatorTravel(res)
        // model.Processing(false)
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

history.pushInvalidData = function() {
	if (history.invalidData().length > 0) {
		url = base_url+"index.php/history/PushBlockedData"
		param = {
			Data : history.invalidData()
		}
		ajaxFormPost(url, param , function(res) {
			console.log("success");
		}, function(err) {
			console.log(err)
			window.location.assign(base_url+"index.php/history")
		})
	}
}

history.renderGridHistory = function(textSearch, callback) {
	var data = history.dataMasterHistory()

    // if (textSearch != "") {
    //     var results = _.filter(data, function (item) {
    //         return _.includes(item.ID_JENIS_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
    //              ||_.includes(item.MERK_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
    //              ||_.includes(item.TYPE_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
    //     });
    //     data = results
    // }

    var columns = [{
        // field: 'Kode',
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
        // field: 'TYPE_KENDARAAN',
        title: 'Deadline Pembayaran',
        width: 150,
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
        		return moment(tenggangWaktu).format("YYYY-MM-DD hh:mm:ss");;
        	}else{
        		return "----------------------------"
        	}
        }
    }, {
        field: 'TANGGAL_KEBERANGKATAN',
        title: 'Tanggal Berangkat',
        width: 120
    }, {
        field: 'STATUS',
        title: 'Status',
        width: 75,
        template: function(d) {
        	var dateorder = d.TANGGAL_PEMESANAN;
        	var datedepart = d.TANGGAL_KEBERANGKATAN;
        	var time = d.JAM_PESAN;
        	if (d.STATUS == "ORDER") {
        		var tenggangWaktu = SetTenggangWaktu(dateorder, datedepart, time);
        		var tenggang = new Date(tenggangWaktu).getTime() - new Date().getTime()
        		if (tenggang < 0) {
        			history.invalidData.push(d.ID_RIWAYAT_TRANSAKSI);
        			return "BLOCKED"
        		}
        		return "ORDER";
        	}else{
        		return d.STATUS
        	}
        	
        }
    }, {
        title: 'Action',
        width: 135,
        template : function (d) {
        	// var dsb = ""
        	var btn = ""
        	var text = ""
        	var href = ""
        	if (d.STATUS == 'ORDER') {
        		btn = "btn-primary"
        		// dsb = ""
        		href = "href=\""+base_url+"index.php/transaksi/index/"+d.ID_RIWAYAT_TRANSAKSI+"\""
        		text = "Kirim Bukti Transfer"
        	}
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
        		href = ""
        		text = "&emsp;&nbsp;Terkonfirmasi&nbsp;&emsp;"
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

    callback()
}

history.whenTransactionBlocked = function(id_travel, id_transaksi) {
	// for (var i = history.dataMasterOperatorTravel().length - 1; i >= 0; i--) {
	// 	history.dataMasterOperatorTravel()[i]
	// }
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
		showCloseButton: true,
		// showConfrimButton: true,
		// showCancelButton: true,
		// focusConfirm: false,
		// confirmButtonText:
		//   '<i class="fa fa-thumbs-up"></i> Great!',
		// confirmButtonAriaLabel: 'Thumbs up, great!',
		// cancelButtonText:
		// '<i class="fa fa-thumbs-down"></i>',
		// cancelButtonAriaLabel: 'Thumbs down',
	})
	// $('#historyModal').modal('show');
}



history.init = function () {
	history.getDataOperatorTravel()
	history.getDataHistory(function() {
		history.renderGridHistory("", function() {
			history.pushInvalidData();
		})
	})
}

$(function() {
	history.init()
})