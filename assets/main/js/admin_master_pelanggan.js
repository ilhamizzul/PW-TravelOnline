var  pelanggan = {}
pelanggan.textSearch = ko.observable("")
pelanggan.dataMasterPelanggan = ko.observableArray([])

pelanggan.search = function () {
	pelanggan.renderGridPelanggan(pelanggan.textSearch())
}

pelanggan.searchWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            pelanggan.search()
        }
    });
}

pelanggan.textSearch.subscribe(function(data) {
	if (data == "") {
		pelanggan.renderGridPelanggan("")
	}
})

pelanggan.getDataPelanggan = function(callback){
    model.Processing(true)
    var url = "admin_master_pelanggan/getDataPelanggan"
    ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        pelanggan.dataMasterPelanggan(result.data)
        callback()
        model.Processing(false)
    })
}

pelanggan.renderGridPelanggan = function(textSearch){
    var data = pelanggan.dataMasterPelanggan()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.ID_MEMBER.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NO_IDENTITAS.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.JENIS_IDENTITAS.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NAMA_MEMBER.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.ALAMAT_MEMBER.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NOMOR_TELEPON.toLowerCase(), textSearch.toLowerCase())
                 // ||_.includes(item.NOMOR_TELEPON.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

    var columns = [{
        title: 'Nomor',
        width: 50,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_MEMBER == dataItem.ID_MEMBER
            })
            return idxs + 1
        }
    }, {
        field: 'ID_MEMBER',
        title: 'Kode Pelanggan',
        width: 100,
    }, {
        field: 'NO_IDENTITAS',
        title: 'Nomor Identitas',
        width: 100
    }, {
        field: 'JENIS_IDENTITAS',
        title: 'Jenis Identitas',
        width: 50
    }, {
        field: 'NAMA_MEMBER',
        title: 'Nama Pelanggan',
        width: 100
    }, {
        field: 'NOMOR_TELEPON',
        title: 'Nomor Telepon',
        width: 100
    }, {
        field: 'ALAMAT_MEMBER',
        title: 'Alamat Pelanggan',
        width: 200
    // }, {
    //     title: 'Action',
    //     width: 70,
    //     template : function (d) {
    //         var dsb = ""
    //         var tooltip = ""
    //         var hrefedit = "href=\"javascript:jenismobil.editJenismobil('"+d.ID_JENIS_KENDARAAN+"')\""
    //         var hrefdelete = "href=\"javascript:jenismobil.deleteJenismobil('"+d.ID_JENIS_KENDARAAN+"')\""
    //         // var subdata = _.filter(master_daerah.dataMasterKota(), ['ID_PROVINSI', d.ID_PROVINSI]);
    //         // if (subdata.length > 0) {
    //         //     dsb = "disabled = \"disabled\""
    //         //     hrefedit = ""
    //         //     hrefdelete = ""
    //         //     tooltip = "data-toggle=\"tooltip\" title=\"Data ini digunakan oleh data mobil travel\""
    //         // }
    //         return "<a "+hrefedit+"class=\"btn btn-xs btn-warning\" "+tooltip+dsb+"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
    //                "<a "+hrefdelete+"class=\"btn btn-xs btn-danger\" "+tooltip+dsb+" ><i class=\"fa fa-trash\"></i></a>"
    //     }
    }]

    $('#gridPelanggan').kendoGrid({
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

pelanggan.init = function() {
	pelanggan.getDataPelanggan(function() {
		pelanggan.renderGridPelanggan("")
	})
	pelanggan.searchWhenEnterPressed()
}

$(function() {
	pelanggan.init()
})