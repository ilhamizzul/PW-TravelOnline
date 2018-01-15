var transaksi = {}
transaksi.dataMasterTransaksi = ko.observableArray([])

transaksi.getDataTransaksi = function(){
	model.Processing(true)
    var url = "admin_transaksi/GetDataTransaksi"
    ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        transaksi.dataMasterTransaksi(result.data)
        model.Processing(false)
    })
}

transaksi.renderGridTransaksi = function(textSearch) {
	var data = transaksi.dataMasterTransaksi()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.ID_JENIS_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.MERK_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.TYPE_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

    var columns = [{
        // field: 'Kode',
        title: 'Nomor',
        width: 50,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_JENIS_KENDARAAN == dataItem.ID_JENIS_KENDARAAN
            })
            // var idxs = _.findIndex(data, dataitem)
            // console.log(dataitem)
            return idxs + 1
        }
    }, {
        field: 'ID_JENIS_KENDARAAN',
        title: 'Kode Jenis Mobil',
        width: 100,
    }, {
        field: 'MERK_KENDARAAN',
        title: 'Merk Mobil',
        width: 200
    }, {
        field: 'TYPE_KENDARAAN',
        title: 'Type Mobil',
        width: 200
    }, {
        title: 'Action',
        width: 70,
        template : function (d) {
            var dsb = ""
            var tooltip = ""
            var hrefedit = "href=\"javascript:jenismobil.editJenismobil('"+d.ID_JENIS_KENDARAAN+"')\""
            var hrefdelete = "href=\"javascript:jenismobil.deleteJenismobil('"+d.ID_JENIS_KENDARAAN+"')\""
            // var subdata = _.filter(master_daerah.dataMasterKota(), ['ID_PROVINSI', d.ID_PROVINSI]);
            // if (subdata.length > 0) {
            //     dsb = "disabled = \"disabled\""
            //     hrefedit = ""
            //     hrefdelete = ""
            //     tooltip = "data-toggle=\"tooltip\" title=\"Data ini digunakan oleh data mobil travel\""
            // }
            return "<a "+hrefedit+"class=\"btn btn-xs btn-warning\" "+tooltip+dsb+"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
                   "<a "+hrefdelete+"class=\"btn btn-xs btn-danger\" "+tooltip+dsb+" ><i class=\"fa fa-trash\"></i></a>"
        }
    }]

    $('#gridTransaksi').kendoGrid({
        dataSource: {
            data: data,
        },
        sortable: true,
        height: 400,
        width: 140,
        filterable: false,
        scrollable: true,
        columns: columns,
    })
}



transaksi.init = function(){
	transaksi.getDataTransaksi();
}

$(function() {
	transaksi.init()
})