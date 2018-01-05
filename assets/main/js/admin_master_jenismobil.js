var jenismobil = {}

jenismobil.textSearch = ko.observable("")
jenismobil.dataMasterJenisMobil = ko.observableArray([])
jenismobil.showAdd = ko.observable(false)
jenismobil.showEdit = ko.observable(false)
jenismobil.HeaderText = ko.observable("Tambah")

jenismobil.newRecord = function(){
	var data = {
		ID_JENIS_KENDARAAN : "",
		MERK_KENDARAAN : "",
		TYPE_KENDARAAN : ""
	}

	return data
}
jenismobil.record = ko.mapping.fromJS(jenismobil.newRecord())

jenismobil.search = function () {
	jenismobil.renderGridJenisMobil(jenismobil.textSearch())
    // if (true) {}
}

jenismobil.textSearch.subscribe(function(e) {
    if (e == "") {
        jenismobil.renderGridJenisMobil("")
    }
})

jenismobil.saveData = function () {
	data = ko.mapping.toJS(jenismobil.record)
	var url = "admin_master_jenis_mobil/saveData"
    
    var column_name = "jenismobil"
    var month = 0
    var year = 0
    var digit_of_number = 4

    if (data.TYPE_KENDARAAN == "") {
    	return swal("Error!", "Type kendaraan belum diisi", "error")
    }

    if (data.MERK_KENDARAAN == "") {
    	return swal("Error!", "Merk kendaraan belum diisi", "error")
    }

    data.TYPE_KENDARAAN = firstLetterUpparcase(data.TYPE_KENDARAAN)
    data.MERK_KENDARAAN = firstLetterUpparcase(data.MERK_KENDARAAN)

    var param = {
        Squence : squenceSetter(column_name, month, year, digit_of_number),
        Data : data
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menambah data mobil "+data.MERK_KENDARAAN+" "+data.TYPE_KENDARAAN+"!",
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
            $('#addJenisMobilModal').modal('hide');
            // model.Processing(true)
            ajaxFormPost(url, param, function(res){
                if (res.isError) {
                    swal("Gagal", res.message, "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Data telah tersimpan!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        jenismobil.getDataJenisMobil(function(){
                            jenismobil.renderGridJenisMobil("")
                        })
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            $.when(
                swal(
                    'Dibatalkan',
                    'Data tidak diubah',
                    'error'
                )
            ).done(
                function () {
                    $('#addJenisMobilModal').modal('hide');
                }
            )
        }
    })
}

jenismobil.editData = function () {
    data = ko.mapping.toJS(jenismobil.record)
    var url = "admin_master_jenis_mobil/editData"

    if (data.TYPE_KENDARAAN == "") {
        return swal("Error!", "Type kendaraan belum diisi", "error")
    }

    if (data.MERK_KENDARAAN == "") {
        return swal("Error!", "Merk kendaraan belum diisi", "error")
    }

    data.TYPE_KENDARAAN = firstLetterUpparcase(data.TYPE_KENDARAAN)
    data.MERK_KENDARAAN = firstLetterUpparcase(data.MERK_KENDARAAN)

    var param = {
        Data : data
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan mengubah data mobil dengan kode "+data.ID_JENIS_KENDARAAN+"!",
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
            $('#addJenisMobilModal').modal('hide');
            // model.Processing(true)
            ajaxFormPost(url, param, function(res){
                if (res.isError) {
                    swal("Gagal", res.message, "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Data telah diubah!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        jenismobil.getDataJenisMobil(function(){
                            jenismobil.renderGridJenisMobil("")
                        })
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            $.when(
                swal(
                    'Dibatalkan',
                    'Data tidak diubah',
                    'error'
                )
            ).done(
                function () {
                    $('#addJenisMobilModal').modal('hide');
                }
            )
        }
    })
}

jenismobil.getDataJenisMobil = function(callback){
    model.Processing(true)
    var url = "admin_master_jenis_mobil/getDataJenisMobil"
    ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        jenismobil.dataMasterJenisMobil(result.data)
        callback()
        model.Processing(false)
    })
}

jenismobil.renderGridJenisMobil = function(textSearch){
    var data = jenismobil.dataMasterJenisMobil()

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

    $('#gridJenisMobil').kendoGrid({
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

jenismobil.editJenismobil = function (id) {
    var data = _.filter(jenismobil.dataMasterJenisMobil(), ['ID_JENIS_KENDARAAN', id]);
    jenismobil.showEditModal()
    ko.mapping.fromJS(data[0], jenismobil.record)
}

jenismobil.deleteJenismobil = function(id){
    var url = "admin_master_jenis_mobil/deleteData"
    var param ={
        Data: id
    }

    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menghapus data mobil dengan kode " + id + "!",
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
                        jenismobil.getDataJenisMobil(function(){
                            jenismobil.renderGridJenisMobil("")
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

jenismobil.modalClosed = function(){
    $('#addJenisMobilModal').on('hidden.bs.modal', function () {
        ko.mapping.fromJS(jenismobil.newRecord(), jenismobil.record)
        $(".input-form").val("")
        jenismobil.showEdit(false)
        jenismobil.showAdd(false)
    })
}

jenismobil.searchWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            jenismobil.search()
        }
    });
}

jenismobil.showAddModal = function () {
    jenismobil.showAdd(true)
    jenismobil.HeaderText("Tambah")
}

jenismobil.showEditModal = function(){
    $("#addJenisMobilModal").modal("show")
    jenismobil.HeaderText("Edit")
    jenismobil.showEdit(true)
}


jenismobil.init = function () {
	jenismobil.searchWhenEnterPressed()
	jenismobil.modalClosed()
    jenismobil.getDataJenisMobil(function(){
        jenismobil.renderGridJenisMobil("")
    })
}

$(function () {
    jenismobil.init()
})