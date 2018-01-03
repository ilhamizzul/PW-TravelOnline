model.Processing(false)
var master_daerah = {}
master_daerah.addButtonText = ko.observable('Provinsi')
master_daerah.showInAddProvinsi = ko.observable(true)
master_daerah.showInAddKota = ko.observable(false)
master_daerah.showInAddDesa = ko.observable(false)
master_daerah.dataMasterProvinsi = ko.observableArray([])
master_daerah.dataMasterKota = ko.observableArray([])
master_daerah.dataMasterDesa = ko.observableArray([])
master_daerah.showAdd = ko.observable(false)
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
        KETERANGAN: "",
    }

    return data;
}
master_daerah.recordKota = ko.mapping.fromJS(master_daerah.newRecordKota())

master_daerah.newRecordDesa = function(){
    var data = {
        ID_DESA : "",
        ID_KOTA : "",
        NAMA_DESA : "",
        KODE_POS : ""
    }

    return data;
}
master_daerah.recordDesa = ko.mapping.fromJS(master_daerah.newRecordDesa())


master_daerah.getDataProvinsi = function(callback){
    model.Processing(true)
    // var url = window.location.origin+"/Project-Work/index.php/admin_master_daerah/getDataProvinsi"
    var url = "admin_master_daerah/getDataProvinsi"
    // var param = {}
    ajaxPost(url, {}, function(res) {
        var data = JSON.parse(res)
        master_daerah.dataMasterProvinsi(data)
        callback()

        model.Processing(false)
    })
}

master_daerah.getDataKota = function(callback){
    model.Processing(true)
    // var url = window.location.origin+"/Project-Work/index.php/admin_master_daerah/getDataProvinsi"
    var url = "admin_master_daerah/getDataKota"
    var param = {}
    ajaxPost(url, param, function(res) {
        var data = JSON.parse(res)
        master_daerah.dataMasterKota(data)
        callback()

        model.Processing(false)
    })
}

master_daerah.getDataDesa = function(callback){
    model.Processing(true)
    // var url = window.location.origin+"/Project-Work/index.php/admin_master_daerah/getDataProvinsi"
    var url = "admin_master_daerah/getDataDesa"
    // var param = {}
    ajaxPost(url, {}, function(res) {
        var data = JSON.parse(res)
        master_daerah.dataMasterDesa(data)
        callback()

        model.Processing(false)
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
        // template: "<a href=\"javascript:master_daerah.editProvinsi('#: ID_PROVINSI #')\" class=\"btn btn-xs btn-warning\"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
        //           "<a href=\"javascript:master_daerah.deleteProvinsi('#: ID_PROVINSI #')\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"></i></a>"
        template : function (d) {
            var dsb = ""
            var tooltip = ""
            var href = "href=\"javascript:master_daerah.deleteProvinsi('"+d.ID_PROVINSI+"')\""
            var subdata = _.filter(master_daerah.dataMasterKota(), ['ID_PROVINSI', d.ID_PROVINSI]);
            if (subdata.length > 0) {
                dsb = "disabled = \"disabled\""
                href = ""
                tooltip = "data-toggle=\"tooltip\" title=\"Data ini digunakan oleh data kota\""
            }
            return "<a href=\"javascript:master_daerah.editProvinsi('"+d.ID_PROVINSI+"')\" class=\"btn btn-xs btn-warning\"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
                   "<a "+href+"class=\"btn btn-xs btn-danger\" "+tooltip+dsb+" ><i class=\"fa fa-trash\"></i></a>"
        }
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

master_daerah.editProvinsi = function(id){
    var data = _.filter(master_daerah.dataMasterProvinsi(), ['ID_PROVINSI', id]);
    // console.log(data)
    master_daerah.showEditModal()
    ko.mapping.fromJS(data[0], master_daerah.recordProvinsi)
}
master_daerah.deleteProvinsi = function(id){
    var url = "admin_master_daerah/deleteDataProvinsi"
    var param ={
        Data: id
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menghapus data dengan kode provinsi " + id + "!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
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
                    text: "Data berhasil dihapus!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        master_daerah.getDataProvinsi(function(){
                            master_daerah.rendergridProvinsi("")
                        })
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                'Data tidak diubah',
                'info'
            )
        }
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
        field: 'KETERANGAN',
        title: 'Keterangan',
        width: 200
    },{
        title: 'Action',
        width: 70,
        // template: "<a href=\"javascript:master_daerah.editKota('#: ID_KOTA #')\" class=\"btn btn-xs btn-warning\"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
        //           "<a href=\"javascript:master_daerah.deleteKota('#: ID_KOTA #')\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"></i></a>"
        template : function (d) {
            var dsb = ""
            var tooltip = ""
            var href = "href=\"javascript:master_daerah.deleteKota('"+d.ID_KOTA+"')\""
            var subdata = _.filter(master_daerah.dataMasterDesa(), ['ID_KOTA', d.ID_KOTA]);
            if (subdata.length > 0) {
                dsb = "disabled = \"disabled\""
                href = ""
                tooltip = "data-toggle=\"tooltip\" title=\"Data ini digunakan oleh data desa\""
            }
            return "<a href=\"javascript:master_daerah.editKota('"+d.ID_KOTA+"')\" class=\"btn btn-xs btn-warning\"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
                   "<a "+href+"class=\"btn btn-xs btn-danger\" "+tooltip+dsb+" ><i class=\"fa fa-trash\"></i></a>"
        }
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

master_daerah.editKota = function(id){
    master_daerah.showEditModal()
    var data = _.filter(master_daerah.dataMasterKota(), ['ID_KOTA', id]);
    // console.log(data)
    
    ko.mapping.fromJS(data[0], master_daerah.recordKota)
    var value = data[0].KETERANGAN
    $('#dropdownProvinsi').data('kendoDropDownList').value(data[0].ID_PROVINSI);
    $("input[name=keteranganKotKab][value=" + value + "]").prop('checked', true);
    $("input:radio[name='keteranganKotKab']").prop('disabled', true);
}
master_daerah.deleteKota = function(id){
    var url = "admin_master_daerah/deleteDataKota"
    var param ={
        Data: id
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menghapus data dengan kode kota " + id + "!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
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
                    text: "Data berhasil dihapus!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        master_daerah.getDataKota(function(){
                            master_daerah.rendergridKota("")
                        })
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                'Data tidak diubah',
                'info'
            )
        }
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
            return idxs + 1
        }
    }, {
        field: 'ID_DESA',
        title: 'Kode Desa',
        width: 200,
    }, {
        field: 'NAMA_DESA',
        title: 'Nama Desa',
        width: 200
    }, {
        field: 'KODE_POS',
        title: 'Kode Pos',
        width: 200
    }, {
        title: 'Action',
        width: 70,
        template: "<a href=\"javascript:master_daerah.editDesa('#: ID_DESA #')\" class=\"btn btn-xs btn-warning\"><i class=\"fa fa-pencil\"></i></a> &nbsp;"+
                  "<a href=\"javascript:master_daerah.deleteDesa('#: ID_DESA #')\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"></i></a>"
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

master_daerah.editDesa = function(id){
    var data = _.filter(master_daerah.dataMasterDesa(), ['ID_DESA', id]);
    // console.log(data)
    master_daerah.showEditModal()
    ko.mapping.fromJS(data[0], master_daerah.recordDesa)
    $('#dropdownKota').data('kendoDropDownList').value(data[0].ID_KOTA);

}
master_daerah.deleteDesa = function(id){
    var url = "admin_master_daerah/deleteDataDesa"
    var param ={
        Data: id
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menghapus data dengan kode desa " + id + "!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
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
                    text: "Data berhasil dihapus!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        master_daerah.getDataDesa(function(){
                            master_daerah.rendergridDesa("")
                        })
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                'Data tidak diubah',
                'info'
            )
        }
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
    } else if (data == "Kota/Kab") {
        master_daerah.showInAddKota(true)
    }else if (data == "Desa") {
        master_daerah.showInAddDesa(true)
    }
    master_daerah.rendergridDesa("")
    master_daerah.rendergridKota("")
    master_daerah.rendergridProvinsi("")
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
        ko.mapping.fromJS(master_daerah.newRecordProvinsi(), master_daerah.recordProvinsi)
        ko.mapping.fromJS(master_daerah.newRecordKota(), master_daerah.recordKota)
        ko.mapping.fromJS(master_daerah.newRecordDesa(), master_daerah.recordDesa)

        $("#dropdownProvinsi").data('kendoDropDownList').value(-1)
        $("#dropdownKota").data('kendoDropDownList').value(-1)
        $(".input-form").val("")
        $('#keteranganKotKab').text("")
        $("input:radio[name='keteranganKotKab']:checked").prop("checked", false);
        $("input:radio[name='keteranganKotKab']").prop('disabled', false);

        master_daerah.showAdd(false)
        master_daerah.showEdit(false)
    })
}

master_daerah.changeKeterangan = function(){
    // var keterangan = master_daerah.recordDesa.ID_KOTA().substring(0, 3);
    console.log("change kota")
    var id = master_daerah.recordDesa.ID_KOTA()
    var keterangan = _.filter(master_daerah.dataMasterKota(), ['ID_KOTA', id]);

    console.log(keterangan)

    master_daerah.keteranganKotKab(keterangan[0].KETERANGAN)
}

master_daerah.searchDaerah = function(){
    var textSearch = master_daerah.textSearch()
    if (master_daerah.addButtonText()=='Provinsi') {
        master_daerah.rendergridProvinsi(textSearch)
    }
    if (master_daerah.addButtonText()=='Kota/Kab') {
        master_daerah.rendergridKota(textSearch)
    }
    if (master_daerah.addButtonText()=='Desa') {
        master_daerah.rendergridDesa(textSearch)
    }
}

master_daerah.saveData = function(){
    var url = ""
    var column_name = master_daerah.addButtonText()
    var month = 0
    var year = 0
    var digit_of_number = 0

    var data = ""

    var name = ""

    if (master_daerah.addButtonText()=='Provinsi') {
        url = "admin_master_daerah/saveDataProvinsi"
        digit_of_number = 2

        data = ko.mapping.toJS(master_daerah.recordProvinsi)
        name = data.NAMA_PROVINSI
        if (data.NAMA_PROVINSI == "") {
            return swal("Error!","Nama provinsi belum diisi", "error")
        }
    }
    if (master_daerah.addButtonText()=='Kota/Kab') {
        url = "admin_master_daerah/saveDataKota"
        digit_of_number = 3

        data = ko.mapping.toJS(master_daerah.recordKota)
        name = data.NAMA_KOTA
        data.KETERANGAN = $("input:radio[name='keteranganKotKab']:checked").val()
        column_name = data.KETERANGAN

        if (data.ID_PROVINSI == "") {
            return swal("Error!","Anda belum memilih provinsi","error")
        }
        if (data.KETERANGAN == undefined) {
            return swal("Error!","Anda belum memilih keterangan","error")
        }
        if (data.NAMA_KOTA == "") {
            return swal ("Error!","Nama kota belum diisi","error")
        }
    }
    if (master_daerah.addButtonText()=='Desa') {
        url = "admin_master_daerah/saveDataDesa"
        digit_of_number = 5
        data = ko.mapping.toJS(master_daerah.recordDesa)
        name = data.NAMA_DESA
        if (data.ID_KOTA == "") {
            return swal("Error!","Anda belum memilih kota/kabupaten ","error")
        }
        if (data.NAMA_DESA == "") {
            return swal("Error!","Nama desa belum diisi","error")
        }
        if (data.KODE_POS == "") {
            return swal("Error!","kode pos belum diisi","error")
        }
    }

    var param = {
        Squence : squenceSetter(column_name, month, year, digit_of_number),
        Data : data
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menyimpan data " + column_name + " " + name + "!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'No, cancel!',
        // confirmButtonClass: 'btn btn-success',
        // cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#addDaerahModal').modal('hide');
            ajaxFormPost(url, param, function(res){
                if (res.isError) {
                    swal("Gagal", res.message, "error")
                }else{
                    swal({
                    title: "Success!",
                    text: "Data telah tersimpan!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        var position = master_daerah.addButtonText()

                        if (position == "Provinsi") {
                            master_daerah.getDataProvinsi(function(){
                                master_daerah.rendergridProvinsi("")
                            })
                        }
                        if (position == "Kota/Kab") {
                            master_daerah.getDataKota(function(){
                                master_daerah.rendergridKota("")
                            })
                        }
                        if (position == "Desa") {
                            master_daerah.getDataDesa(function(){
                                master_daerah.rendergridDesa("")
                            })
                        }
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                'Data tidak disimpan',
                'error'
            )
        }
    })
}

master_daerah.updateData = function(){
    var url = ""
    var column_name = master_daerah.addButtonText()

    var data = {}

    var name = ""

    if (master_daerah.addButtonText()=='Provinsi') {
        url = "admin_master_daerah/updateDataProvinsi"
        data = ko.mapping.toJS(master_daerah.recordProvinsi)
        id = data.ID_PROVINSI
        if (data.NAMA_PROVINSI == "") {
            return swal("Error!","Nama provinsi belum diisi", "error")
        }
    }
    if (master_daerah.addButtonText()=='Kota/Kab') {
        url = "admin_master_daerah/updateDataKota"
        data = ko.mapping.toJS(master_daerah.recordKota)
        id = data.ID_KOTA
        data.KETERANGAN = $("input:radio[name='keteranganKotKab']:checked").val()
        column_name = data.KETERANGAN

        if (data.ID_PROVINSI == "") {
            return swal("Error!","Anda belum memilih provinsi","error")
        }
        if (data.KETERANGAN == undefined) {
            return swal("Error!","Anda belum memilih keterangan","error")
        }
        if (data.NAMA_KOTA == "") {
            return swal ("Error!","Nama kota belum diisi","error")
        }
    }
    if (master_daerah.addButtonText()=='Desa') {
        url = "admin_master_daerah/updateDataDesa"

        data = ko.mapping.toJS(master_daerah.recordDesa)
        id = data.ID_DESA
        if (data.ID_KOTA == "") {
            return swal("Error!","Anda belum memilih kota/kabupaten ","error")
        }
        if (data.NAMA_DESA == "") {
            return swal("Error!","Nama desa belum diisi","error")
        }
        if (data.KODE_POS == "") {
            return swal("Error!","kode pos belum diisi","error")
        }
    }

    var param = {
        Data : data
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan mengubah data dengan kode " + column_name.toLowerCase() + " " + id + "!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#addDaerahModal').modal('hide');
            ajaxFormPost(url, param, function(res){
                if (res.isError) {
                    swal("Gagal", res.message, "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Data berhasil diubah!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        var position = master_daerah.addButtonText()

                        if (position == "Provinsi") {
                            master_daerah.getDataProvinsi(function(){
                                master_daerah.rendergridProvinsi("")
                            })
                        }
                        if (position == "Kota/Kab") {
                            master_daerah.getDataKota(function(){
                                master_daerah.rendergridKota("")
                            })
                        }
                        if (position == "Desa") {
                            master_daerah.getDataDesa(function(){
                                master_daerah.rendergridDesa("")
                            })
                        }
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                'Data tidak diubah',
                'info'
            )
        }
    })
}

master_daerah.searchDaerahWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            master_daerah.searchDaerah()
        }
    });
}

master_daerah.init = function() {
    $.when(master_daerah.getDataDesa(function(){
        master_daerah.rendergridDesa("")
    })).done(
        $.when(master_daerah.getDataKota(function(){
            master_daerah.rendergridKota("")
        })).done(
            master_daerah.getDataProvinsi(function(){
                master_daerah.rendergridProvinsi("")
            })
        )
    )
    // master_daerah.getDataDesa(function(){
    //     master_daerah.rendergridDesa("")
    // })
    // master_daerah.getDataKota(function(){
    //     master_daerah.rendergridKota("")
    // })
    // master_daerah.getDataProvinsi(function(){
    //     master_daerah.rendergridProvinsi("")
    // })
    // master_daerah.rendergridDesa("")
    // master_daerah.rendergridKota("")
    // master_daerah.rendergridProvinsi("")
    master_daerah.modalClosed()
    master_daerah.searchDaerahWhenEnterPressed()
}

$(function () {
    master_daerah.init()
})