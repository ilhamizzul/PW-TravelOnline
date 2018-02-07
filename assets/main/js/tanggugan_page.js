var history = {}
history.dataMasterHistory = ko.observableArray([])
history.dataMasterOperatorTravel = ko.observableArray([])
history.invalidData = ko.observableArray([])
history.namaTravel = ko.observable()

// history.getDataOperatorTravel = function() {
// 	var url = base_url+"index.php/history/GetDataOperatorTravel"
// 	ajaxFormPost(url, {}, function(res) {
//         // var result = JSON.parse(res)
//         history.dataMasterOperatorTravel(res)
//         // model.Processing(false)
//     })
// }

history.getDataHistory = function(callback) {
	history.invalidData([])
	var url = base_url+"index.php/history/GetDataTransactionCharges"
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
			// console.log("success");
		}, function(err) {
			// console.log(err)
			window.location.assign(base_url+"index.php/history")
		})
	}
}

history.renderGridHistory = function(textSearch, callback) {
	var data = history.dataMasterHistory()

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
        title: 'Deadline Pembayaran',
        width: 150,
        template: function(d) {
        	var dateorder = d.TANGGAL_PEMESANAN;
        	var datedepart = d.TANGGAL_KEBERANGKATAN;
        	var time = d.JAM_PESAN;
    		var tenggangWaktu = SetTenggangWaktu(dateorder, datedepart, time);
    		var tenggang = new Date(tenggangWaktu).getTime() - new Date().getTime()
    		if (tenggang < 0) {
    			return "----------------------------"
    		}
    		return moment(tenggangWaktu).format("YYYY-MM-DD hh:mm:ss");
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
    		var tenggangWaktu = SetTenggangWaktu(dateorder, datedepart, time);
    		var tenggang = new Date(tenggangWaktu).getTime() - new Date().getTime()
    		if (tenggang < 0) {
    			history.invalidData.push(d.ID_RIWAYAT_TRANSAKSI);
    			return "BLOCKED"
    		}
    		return "ORDER";
        	
        }
    }, {
        title: 'Action',
        width: 135,
        template : function (d) {
    		var btn = "btn-primary"
    		var href = "href=\""+base_url+"index.php/transaksi/index/"+d.ID_RIWAYAT_TRANSAKSI+"\""
    		var text = "Kirim Bukti Transfer"
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
        mobile : true
    })

    callback()
}


history.init = function () {
	// history.getDataOperatorTravel()
	history.getDataHistory(function() {
		history.renderGridHistory("", function() {
			history.pushInvalidData();
		})
	})
}

$(function() {
	history.init()
})