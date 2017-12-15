model.Processing(false)
var master_daerah = {}
master_daerah.addButtonText = ko.observable('Provinsi')
master_daerah.showInAddProvinsi = ko.observable(true)
master_daerah.showInAddKota = ko.observable(false)
master_daerah.showInAddDesa = ko.observable(false)
master_daerah.dataMasterProvinsi = ko.observableArray([])
master_daerah.dataMasterKota = ko.observableArray([])
master_daerah.dataMasterDesa = ko.observableArray([])
master_daerah.showAdd = ko.observable(true)
master_daerah.showEdit = ko.observable(false)
master_daerah.HeaderText = ko.observable("Tambah")
master_daerah.textSearch = ko.observable("")
master_daerah.keteranganKotKab = ko.observable("")

master_daerah.newRecordProvinsi = function(){
    var data = {
        ID_PROVINSI : "",
        NAMA_PROVINSI : "",
    }

    return data;
}
master_daerah.recordProvinsi = ko.mapping.fromJS(master_daerah.newRecordProvinsi())

master_daerah.newRecordKota = function(){
    var data = {
        ID_KOTA : "",
        ID_PROVINSI: "",
        NAMA_KOTA : "",
    }

    return data;
}
master_daerah.recordKota = ko.mapping.fromJS(master_daerah.newRecordKota())

master_daerah.newRecordDesa = function(){
    var data = {
        ID_DESA : "",
        ID_KOTA : "",
        NAMA_DESA : "",
    }

    return data;
}
master_daerah.recordDesa = ko.mapping.fromJS(master_daerah.newRecordDesa())


master_daerah.getDataProvinsi = function(callback){
    // var url = window.location.origin+"/Project-Work/index.php/admin_master_daerah/getDataProvinsi"
    var url = "admin_master_daerah/getDataProvinsi"
    // var param = {}
    ajaxPost(url, {}, function(res) {
        var data = JSON.parse(res)
        master_daerah.dataMasterProvinsi(data)
        callback()
    })
}

master_daerah.getDataKota = function(callback){
    // var url = window.location.origin+"/Project-Work/index.php/admin_master_daerah/getDataProvinsi"
    var url = "admin_master_daerah/getDataKota"
    var param = {}
    ajaxPost(url, param, function(res) {
        var data = JSON.parse(res)
        master_daerah.dataMasterKota(data)
        callback()
    })
}

master_daerah.getDataDesa = function(callback){
    // var url = window.location.origin+"/Project-Work/index.php/admin_master_daerah/getDataProvinsi"
    var url = "admin_master_daerah/getDataDesa"
    // var param = {}
    ajaxPost(url, {}, function(res) {
        var data = JSON.parse(res)
        master_daerah.dataMasterDesa(data)
        callback()
    })
}

master_daerah.rendergridProvinsi = function (textSearch) {
	var data = master_daerah.dataMasterProvinsi()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.ID_PROVINSI.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NAMA_PROVINSI.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

	var columns = [{
        // field: 'Kode',
        title: 'Nomor',
        width: 50,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_PROVINSI == dataItem.ID_PROVINSI
            })
            // var idxs = _.findIndex(data, dataitem)
            // console.log(dataitem)
            return idxs + 1
        }
    }, {
        field: 'ID_PROVINSI',
        title: 'Kode Provinsi',
        width: 100,
    }, {
        field: 'NAMA_PROVINSI',
        title: 'Nama Provinsi',
        width: 200
    },{
        title: 'Action',
        width: 70,
        // template: "<a href=\"javascript:customer.editCustomer('#: _id #')\" data-target=\".EditCustomer\" data-backdrop=\"static\" class=\"btn btn-xs btn-warning\"><i class=\"fa fa-pencil\"></i></a>&nbsp;" + "#if(1==1){#" + "<a href=\"javascript:customer.delete('#: _id #', '#: Kode #')\" class=\"btn btn-xs btn-danger\"><span class='glyphicon glyphicon-trash'></span>#}#"
    }]

    $('#gridProvinsi').kendoGrid({
        dataSource: {
            data: data,
        },
        sortable: true,
        height: 350,
        width: 140,
        filterable: false,
        scrollable: true,
        columns: columns,
    })
}

master_daerah.rendergridKota = function (textSearch) {
	var data = master_daerah.dataMasterKota()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.ID_PROVINSI.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.ID_KOTA.toLowerCase(), textSearch.toLowerCase())
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
                return d.ID_KOTA == dataItem.ID_KOTA
            })
            // var idxs = _.findIndex(data, dataitem)
            // console.log(dataitem)
            return idxs + 1
        }
    }, {
        field: 'ID_KOTA',
        title: 'Kode Kota',
        width: 100,
    }, {
        field: 'NAMA_KOTA',
        title: 'Nama Kota',
        width: 200
    }, {
        // field: 'Keterangan',
        title: 'Keterangan',
        width: 200,
        template : function(dataItem){
            var keterangan = dataItem.ID_KOTA.substring(0, 3);
            if (keterangan == "KAB") {
                return "Kabupaten"
            }else{
                return "Kota"
            }
        }
    },{
        title: 'Action',
        width: 70,
        // template: "<a href=\"javascript:customer.editCustomer('#: _id #')\" data-target=\".EditCustomer\" data-backdrop=\"static\" class=\"btn btn-xs btn-warning\"><i class=\"fa fa-pencil\"></i></a>&nbsp;" + "#if(1==1){#" + "<a href=\"javascript:customer.delete('#: _id #', '#: Kode #')\" class=\"btn btn-xs btn-danger\"><span class='glyphicon glyphicon-trash'></span>#}#"
    }]

    $('#gridKota').kendoGrid({
        dataSource: {
            data: data,
        },
        sortable: true,
        height: 350,
        width: 140,
        filterable: false,
        scrollable: true,
        columns: columns,
    })
}

master_daerah.rendergridDesa = function (textSearch) {
	var data = master_daerah.dataMasterDesa()
    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.ID_DESA.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.ID_KOTA.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NAMA_DESA.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

    var columns = [{
        // field: 'Kode',
        title: 'Nomor',
        width: 50,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_DESA == dataItem.ID_DESA
            })
            // var idxs = _.findIndex(data, dataitem)
            // console.log(dataitem)
            return idxs + 1
        }
    }, {
        field: 'ID_DESA',
        title: 'Kode Provinsi',
        width: 200,
    }, {
        field: 'NAMA_DESA',
        title: 'Nama Provinsi',
        width: 200
    },{
        title: 'Action',
        width: 70,
        // template: "<a href=\"javascript:customer.editCustomer('#: _id #')\" data-target=\".EditCustomer\" data-backdrop=\"static\" class=\"btn btn-xs btn-warning\"><i class=\"fa fa-pencil\"></i></a>&nbsp;" + "#if(1==1){#" + "<a href=\"javascript:customer.delete('#: _id #', '#: Kode #')\" class=\"btn btn-xs btn-danger\"><span class='glyphicon glyphicon-trash'></span>#}#"
    }]

    $('#gridDesa').kendoGrid({
        dataSource: {
            data: data,
        },
        sortable: true,
        height: 350,
        width: 140,
        filterable: false,
        scrollable: true,
        columns: columns,
    })
}

master_daerah.changeDaerah = function(data){
    $("#textSearchID").val("")
    master_daerah.addButtonText(data)
    master_daerah.showInAddProvinsi(false)
    master_daerah.showInAddKota(false)
    master_daerah.showInAddDesa(false)
    if (data == "Provinsi") {
        master_daerah.showInAddProvinsi(true)
    } else if (data == "Kota") {
        master_daerah.showInAddKota(true)
    }else if (data == "Desa") {
        master_daerah.showInAddDesa(true)
    }
    master_daerah.rendergridProvinsi("")
    master_daerah.rendergridKota("")
    master_daerah.rendergridDesa("")
}

master_daerah.showAddModal = function () {
    master_daerah.showAdd(true)
    master_daerah.HeaderText("Tambah")
}

master_daerah.showEditModal = function(){
    $("#addDaerahModal").modal("show")
    master_daerah.HeaderText("Edit")
    master_daerah.showEdit(true)
}

master_daerah.modalClosed = function(){
    $('#addDaerahModal').on('hidden.bs.modal', function () {
        master_daerah.recordProvinsi = ko.mapping.fromJS(master_daerah.newRecordProvinsi())
        master_daerah.recordKota = ko.mapping.fromJS(master_daerah.newRecordKota())
        master_daerah.recordDesa = ko.mapping.fromJS(master_daerah.newRecordDesa())

        $("#dropdownProvinsi").data('kendoDropDownList').value(-1)
        $("#dropdownKota").data('kendoDropDownList').value(-1)
        $(".input-form").val("")

        master_daerah.showAdd(false)
        master_daerah.showEdit(false)
    })
}

master_daerah.searchDaerahWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            master_daerah.searchDaerah()
        }
    });
}

master_daerah.changeKeterangan = function(){
    var keterangan = master_daerah.recordDesa.ID_KOTA().substring(0, 3);
    if (keterangan == "KAB") {
        master_daerah.keteranganKotKab("Kabupaten")
    }else if (keterangan == "KOT") {
        master_daerah.keteranganKotKab("Kota")
    }else{
        master_daerah.keteranganKotKab("")
    }
}

master_daerah.searchDaerah = function(){
    var textSearch = master_daerah.textSearch()
    if (master_daerah.addButtonText()=='Provinsi') {
        master_daerah.rendergridProvinsi(textSearch)
    }
    if (master_daerah.addButtonText()=='Kota') {
        master_daerah.rendergridKota(textSearch)
    }
    if (master_daerah.addButtonText()=='Desa') {
        master_daerah.rendergridDesa(textSearch)
    }
}

master_daerah.saveDataProvinsi = function(){
    var url = ""
    data = ko.mapping.toJS(master_daerah.recordProvinsi)
    var param = {
        Data : data
    }
    console.log(param)
}

master_daerah.init = function() {
    master_daerah.getDataProvinsi(function(){
        master_daerah.rendergridProvinsi("")
    })
    master_daerah.getDataKota(function(){
        master_daerah.rendergridKota("")
    })
    master_daerah.getDataDesa(function(){
        master_daerah.rendergridDesa("")
    })
    master_daerah.modalClosed()
    master_daerah.searchDaerahWhenEnterPressed()
}

$(function () {
    master_daerah.init()
})