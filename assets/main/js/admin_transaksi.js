var transaksi = {}
transaksi.dataMasterTransaksi = ko.observableArray([])

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
        		return moment(tenggangWaktu).format("YYYY-MM-DD hh:mm:ss");;
        	}else{
        		return "----------------------------"
        	}
        }
    }, {
        title: 'Action',
        width: 100,
        locked: true
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
}



transaksi.init = function(){
	transaksi.getDataTransaksi(function() {
		transaksi.renderGridTransaksi("")
	});
}

$(function() {
	transaksi.init()
})