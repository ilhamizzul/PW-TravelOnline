var agentravel = {}

agentravel.textSearch = ko.observable("")
agentravel.dataMasterAgentravel = ko.observableArray([])
agentravel.HeaderText = ko.observable("Tambah")
agentravel.namaTravel = ko.observable()

agentravel.saveData =function() {
	if (agentravel.namaTravel() == undefined || agentravel.namaTravel() == "") {
		return swal('Error!','Nama travel belum diisi','error')
	}

	var namatravel = agentravel.namaTravel();

	var url = "admin_travel_agen/SaveDataAgenTravel"
	var param = {
		NAMA_TRAVEL : firstLetterUpparcase(namatravel)
	}
	swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menambah Travel "+firstLetterUpparcase(namatravel)+"!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#f5941c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#addAgenTravel').modal('hide');
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
                        agentravel.getDataAgenTravel(function() {
							agentravel.renderGridAgenTravel("")
						})
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            $.when(
                swal(
                    'Dibatalkan',
                    '',
                    'error'
                )
            ).done(
                function () {
                    $('#addAgenTravel').modal('hide');
                }
            )
        }
    })
	
}
agentravel.search = function() {
	// console.log("search", agentravel.textSearch())
    agentravel.renderGridAgenTravel(agentravel.textSearch())
}
agentravel.searchWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            agentravel.search()
        }
    });
}

agentravel.textSearch.subscribe(function (e) {
    if (e == "") {
        agentravel.renderGridAgenTravel("")
    }
})

agentravel.modalClosed = function(){
    $('#addAgenTravel').on('hidden.bs.modal', function () {
        agentravel.namaTravel("")
    })
}

agentravel.getDataAgenTravel = function(callback) {
	model.Processing(true)
    var url = "admin_travel_agen/GetDataAdminTravel"
    ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        agentravel.dataMasterAgentravel(result)
        callback()
        model.Processing(false)
    })
}

agentravel.renderGridAgenTravel = function(textSearch){
    var data = agentravel.dataMasterAgentravel()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.ID_TRAVEL.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NAMA_TRAVEL.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

    var columns = [{
        title: 'Nomor',
        width: 50,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_TRAVEL == dataItem.ID_TRAVEL
            })
            return idxs + 1
        }
    }, {
        field: 'ID_TRAVEL',
        title: 'Kode Travel',
        width: 70,
    }, {
        field: 'NAMA_TRAVEL',
        title: 'Nama Travel',
        width: 70
    }, {
        title: 'Action',
        width: 70,
        template : function (d) {
            var dsb = ""
            var tooltip = ""
            var hrefdelete = "href=\"javascript:agentravel.deleteAgentTravel('"+d.ID_TRAVEL+"')\""
            return "<a "+hrefdelete+"class=\"btn btn-xs btn-danger\" "+tooltip+dsb+" ><i class=\"fa fa-trash\"></i></a>"
        }
    }]

    $('#gridAgenTravel').kendoGrid({
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

agentravel.deleteAgentTravel = function(id) {
    var url = "admin_travel_agen/DeleteAgenTravel"
    var param ={
        ID: id
    }
    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menghapus Travel dengan kode "+id+"!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#f5941c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#addAgenTravel').modal('hide');
            ajaxFormPost(url, param, function(res){
                if (res.isError) {
                    swal("Gagal", res.message, "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Data telah dihapus!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        agentravel.getDataAgenTravel(function() {
                            agentravel.renderGridAgenTravel("")
                        })
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            $.when(
                swal(
                    'Dibatalkan',
                    '',
                    'error'
                )
            ).done(
                function () {
                    $('#addAgenTravel').modal('hide');
                }
            )
        }
    })
}

agentravel.init = function () {
	agentravel.modalClosed()
	agentravel.getDataAgenTravel(function() {
		agentravel.renderGridAgenTravel("")
	})
    agentravel.searchWhenEnterPressed()
}
$(function () {
	agentravel.init()
})