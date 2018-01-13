var history = {}
history.dataMasterHistory = ko.observable()
history.invalidData = ko.observableArray([])

// history.getDataTravel = function() {
// 	var url = base_url+"index.php/history/GetDataTravel"
// 	ajaxFormPost(url, {}, function(res) {
//         // var result = JSON.parse(res)
//         history.dataMasterHistory(res)
//         callback()
//         // model.Processing(false)
//     })
// }

history.getDataHistory = function(callback) {
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
		})
	}
	console.log("MASUK TJOY")
}

history.renderGridHistory = function(textSearch, callback) {
	history.invalidData([]);
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
        title: 'Tanggal Pemesanan',
        width: 150
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
        		if (new Date(tenggangWaktu).getTime() - new Date().getTime()<=0) {
        			return "----------------------------"
        		}
        		return tenggangWaktu;
        	}else{
        		return "----------------------------"
        	}
        }
    }, {
        field: 'TANGGAL_KEBERANGKATAN',
        title: 'Tanggal Keberangkatan',
        width: 150
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
        		if (new Date(tenggangWaktu).getTime() - new Date().getTime()<=0) {
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
        width: 75
        // template : function (d) {
        //     var dsb = ""
        //     var tooltip = ""
        //     var hrefedit = "href=\"javascript:jenismobil.editJenismobil('"+d.ID_JENIS_KENDARAAN+"')\""
        //     var hrefdelete = "href=\"javascript:jenismobil.deleteJenismobil('"+d.ID_JENIS_KENDARAAN+"')\""
        //     // var subdata = _.filter(master_daerah.dataMasterKota(), ['ID_PROVINSI', d.ID_PROVINSI]);
        //     // if (subdata.length > 0) {
        //     //     dsb = "disabled = \"disabled\""
        //     //     hrefedit = ""
        //     //     hrefdelete = ""
        //     //     tooltip = "data-toggle=\"tooltip\" title=\"Data ini digunakan oleh data mobil travel\""
        //     // }
        //     return "<a "+hrefedit+"class=\"btn btn-xs btn-warning\" "+tooltip+dsb+"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
        //            "<a "+hrefdelete+"class=\"btn btn-xs btn-danger\" "+tooltip+dsb+" ><i class=\"fa fa-trash\"></i></a>"
        // }
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



history.init = function () {
	// $.when(
		history.getDataHistory(function() {
			history.renderGridHistory("", function() {
				history.pushInvalidData();
			})
		})
	// ).done(
		// function() {
			
	// 	}
	// );
	// history.getDataHistory(function() {
	// 	history.renderGridHistory("")
	// });
}

$(function() {
	history.init()
})