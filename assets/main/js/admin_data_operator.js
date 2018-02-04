var dataoperator = {}
dataoperator.textSearch = ko.observable("")
dataoperator.dataMasterDataOperator = ko.observableArray([])

dataoperator.search = function() {
	console.log(dataoperator.textSearch())
}

dataoperator.newRecordDataOperator = function() {
	var data = {
		ID_USER			:"",
		NAMA_USER		:"",
		USERNAME_ADMIN	:"",
		PASSWORD_ADMIN	:"",
		KOTA 			:"",
		ALAMAT_USER 	:"",
		NOMOR_TELEPON	:""
	}

	return data
}


dataoperator.recordDataOperator = ko.mapping.fromJS(dataoperator.newRecordDataOperator())

dataoperator.getDataOperator = function(callback) {
	model.Processing(true)
	var url = "admin_data_operator/GetDataOperator"
	var param = {}
	ajaxPost(url,param, function(res) {
        var result = JSON.parse(res)
        dataoperator.dataMasterDataOperator(result)
        callback()
        model.Processing(false)
    })
}

dataoperator.renderGridDataOperator = function(textSearch) {
	var data = dataoperator.dataMasterDataOperator()

	if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.ID_USER.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NAMA_USER.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NOMOR_TELEPON.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.KOTA.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.ALAMAT_USER.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

    var columns = [{
        // field: 'Kode',
        title: 'Nomor',
        width: 75,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_USER == dataItem.ID_USER
            })
            // var idxs = _.findIndex(data, dataitem)
            // console.log(dataitem)
            return idxs + 1
        }
    }, {
        field: 'ID_USER',
        title: 'Kode Operator',
        width: 150
    }, {
        field: 'NAMA_USER',
        title: 'Nama Operator',
        width: 150
    }, {
        field: 'NOMOR_TELEPON',
        title: 'Nomor Telepon',
        width: 150
    },{
        field: 'KOTA',
        title: 'Kota',
        width: 100
    },{
        field: 'ALAMAT_USER',
        title: 'Alamat',
        width: 200
    }, {
        title: 'Action',
        width: 75,
        template : function (d) {
            var dsb = ""
            var tooltip = ""
            // var hrefedit = "href=\"javascript:dataoperator.editOperator('"+d.ID_USER+"')\""
            var hrefdelete = "href=\"javascript:dataoperator.deleteOperator('"+d.ID_USER+"')\""
            // var subdata = _.filter(master_daerah.dataMasterKota(), ['ID_PROVINSI', d.ID_PROVINSI]);
            // if (subdata.length > 0) {
            //     dsb = "disabled = \"disabled\""
            //     hrefedit = ""
            //     hrefdelete = ""
            //     tooltip = "data-toggle=\"tooltip\" title=\"Data ini digunakan oleh data mobil travel\""
            // }
            return "<a "+hrefdelete+"class=\"btn btn-xs btn-danger\" "+tooltip+dsb+" ><i class=\"fa fa-trash\"></i></a>"
        }
    }]

    if (model.Role() == "ADMIN") {
        columns.splice(-1,1)
    }

    $('#gridDataOperator').kendoGrid({
        dataSource: {
            data: data,
        },
        sortable: true,
        height: 400,
        width: 800,
        filterable: false,
        scrollable: true,
        columns: columns,
    }) 
}

dataoperator.saveDataOperator = function() {
	var data = ko.mapping.toJS(dataoperator.recordDataOperator)
	if (data.NAMA_USER == "") {
		return swal("Error!","Nama operator belum diisi","error")
	}
	if (data.USERNAME_ADMIN == "") {
		return swal("Error!","Username operator belum diisi","error")
	}
	if (data.PASSWORD_ADMIN == "") {
		return swal("Error!","Password operator belum diisi","error")
	}
	if (data.NOMOR_TELEPON == "") {
		return swal("Error!","Nomor telepon operator belum diisi","error")
	}
	if (data.KOTA == "") {
		return swal("Error!","Kota kerja operator belum diisi","error")
	}
	if (data.ALAMAT_USER == "") {
		return swal("Error!","Alamat operator belum diisi","error")
	}

	var url = "admin_data_operator/SaveDataOperator"
	var param = {
		Data : data
	}
	swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menambah operator dengan nama"+data.NAMA_USER,
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
            $('#addOperator').modal('hide');
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
                        dataoperator.getDataOperator(function() {
							dataoperator.renderGridDataOperator("")
						})
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
	        swal(
	            'Dibatalkan',
	            '',
	            'error'
	        )
        }
    })
}

dataoperator.deleteOperator = function(id) {
	var url = "admin_data_operator/DeleteDataOperator"
    var param = {
        Id : id
    }
    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan data operator dengan kode "+id+"!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Delete it!',
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
                        dataoperator.getDataOperator(function() {
							dataoperator.renderGridDataOperator("")
						})
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                '',
                'info'
            )
        }
    })
}

dataoperator.search = function() {
	var textSearch = dataoperator.textSearch()
	dataoperator.renderGridDataOperator(textSearch)
}

dataoperator.searchWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            dataoperator.search()
        }
    });
}

dataoperator.textSearch.subscribe(function(d) {
	if (d == "") {
		dataoperator.renderGridDataOperator("")
	}
})

dataoperator.init = function() {
	dataoperator.getDataOperator(function() {
		dataoperator.renderGridDataOperator("")
	})
	dataoperator.searchWhenEnterPressed()
}


$(function() {
	dataoperator.init()
})