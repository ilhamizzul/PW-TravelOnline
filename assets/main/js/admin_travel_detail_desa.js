var detaildesa = {}
detaildesa.dataMasterDetailDesa = ko.observableArray([])

detaildesa.getDataDetailDesa = function(callback) {
	model.Processing(true)
    var url = "admin_travel_detail_desa/GetDataDetailDesa"
    ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        detaildesa.dataMasterDetailDesa(result)
        callback()
        model.Processing(false)
    })
}

detaildesa.renderGridDetailDesa = function(textSearch) {
	var data = detaildesa.dataMasterDetailDesa()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.ID_DETAIL_DESA_TRAVEL.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NAMA_DESA.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NAMA_KOTA.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

    var columns = [{
        // field: 'Kode',
        title: 'Nomor',
        width: 50,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_DETAIL_DESA_TRAVEL == dataItem.ID_DETAIL_DESA_TRAVEL
            })
            // var idxs = _.findIndex(data, dataitem)
            // console.log(dataitem)
            return idxs + 1
        }
    }, {
        field: 'ID_DETAIL_DESA_TRAVEL',
        title: 'Kode Detail Desa',
        width: 200,
    }, {
        field: 'NAMA_DESA',
        title: 'Nama Desa',
        width: 200
    }, {
        field: 'NAMA_KOTA',
        title: 'Kota',
        width: 100
    }, {
        title: 'Action',
        width: 50,
        template : function (d) {
            var dsb = ""
            var tooltip = ""
            // var hrefedit = "href=\"javascript:jenismobil.editJenismobil('"+d.ID_JENIS_KENDARAAN+"')\""
            var hrefdelete = "href=\"javascript:detaildesa.deleteDetailDesa('"+d.ID_DETAIL_DESA_TRAVEL+"')\""
            // var subdata = _.filter(master_daerah.dataMasterKota(), ['ID_PROVINSI', d.ID_PROVINSI]);
            // if (subdata.length > 0) {
            //     dsb = "disabled = \"disabled\""
            //     hrefedit = ""
            //     hrefdelete = ""
            //     tooltip = "data-toggle=\"tooltip\" title=\"Data ini digunakan oleh data mobil travel\""
            // }
            // return "<a "+hrefedit+"class=\"btn btn-xs btn-warning\" "+tooltip+dsb+"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
            return   "<a "+hrefdelete+"class=\"btn btn-xs btn-danger\" "+tooltip+dsb+" ><i class=\"fa fa-trash\"></i></a>"
        }
    }]

    $('#gridDetailDesa').kendoGrid({
        dataSource: {
            data: data,
        },
        sortable: true,
        height: 400,
        width: 600,
        filterable: false,
        scrollable: true,
        columns: columns,
    })
}


detaildesa.init = function() {
	detaildesa.getDataDetailDesa(function() {
		detaildesa.renderGridDetailDesa("")
	})
}

$(function() {
	detaildesa.init()
})