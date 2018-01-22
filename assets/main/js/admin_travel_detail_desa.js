var detaildesa = {}
detaildesa.dataMasterDetailDesa = ko.observableArray([])
detaildesa.textSearch = ko.observable()
detaildesa.dataMasterKota = ko.observableArray([])
detaildesa.dataMasterDesa = ko.observableArray([])
detaildesa.selectedKota = ko.observable()
detaildesa.selectedDesa = ko.observableArray([])
detaildesa.visibleDropDownDesa = ko.observable(false)
detaildesa.dataMultiSelectDesa = ko.observableArray([])
detaildesa.textKeterangan = ko.observable("")

detaildesa.ID_DETAIL_DESA_TRAVEL = ko.observable()

detaildesa.getDataDropdown = function() {
	var url = "admin_travel_detail_desa/GetDataDropdown"
	ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        detaildesa.dataMasterDesa(result.DATA_DESA)
        detaildesa.dataMasterKota(result.DATA_KOTA)
    })
}



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

detaildesa.selectedKota.subscribe(function(e) {
	var data = detaildesa.dataMasterDesa()
	if (e != "") {
		detaildesa.visibleDropDownDesa(true)
		data = _.filter(detaildesa.dataMasterDesa(), {"ID_KOTA" : e})
	}else{
		detaildesa.visibleDropDownDesa(false)
	}
	
	detaildesa.dataMultiSelectDesa(data);
})

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
        title: 'Nomor',
        width: 50,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_DETAIL_DESA_TRAVEL == dataItem.ID_DETAIL_DESA_TRAVEL
            })
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
        // field: 'NAMA_KOTA',
        title: 'Kota',
        width: 150,
        template: function(d) {
            if (d.KETERANGAN == "Kota") {
                return d.NAMA_KOTA
            }else{
                return d.NAMA_KOTA+" (KAB)"
            }
        }
    }, {
        title: 'Action',
        width: 50,
        template : function (d) {
            var dsb = ""
            var tooltip = ""
            var hrefdelete = "href=\"javascript:detaildesa.deleteDetailDesa('"+d.ID_DETAIL_DESA_TRAVEL+"')\""
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

detaildesa.modalClosed = function(){
    $('#addDetailDesaModal').on('hidden.bs.modal', function () {
        $("#dropdownKota").data('kendoDropDownList').value(-1)
        detaildesa.selectedKota("")
        detaildesa.selectedDesa([])
    })
}

detaildesa.saveDetailDesa = function() {
	var data = ko.mapping.toJS(detaildesa.selectedDesa)
	if (data.length == 0) {
		return swal('Error !', "Anda belum memilih desa", "error")
	}

	var textDesa = ""
	var multiselect = $("#multiselectDesa").data("kendoMultiSelect");
	var dataDropDown = multiselect.dataItems();
	_.each(dataDropDown, function(value, key){
		textDesa += (value.NAMA_DESA+", ")
	})

	textDesa = textDesa.slice(0, -2);
	var url = "admin_travel_detail_desa/SaveDetailDesa"
	var param ={
		Data : data
	}

	swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menambah desa "+textDesa+" kedalam cakupan travel Anda!",
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
            $('#addDetailDesaModal').modal('hide');
            // model.Processing(true)
            ajaxFormPost(url, param, function(res){
                if (res.isError) {
                	if (res.data.length != 0) {
                		var textAlert = "Desa "
                		_.each(res.data, function(value, key){
							textAlert += (value+", ")
						})
						textAlert = textAlert.slice(0, -2);
						textAlert += " sudah terdaftar!"

						swal("Gagal", textAlert, "error")
                	}else{
                		swal("Gagal", res.message, "error")
                	}
                }else{
                	var textAlert = "Data telah tersimpan!"
                	if (res.data.length != 0) {
                		textAlert = "Desa "
                		_.each(res.data, function(value, key){
							textAlert += (value+", ")
						})
						textAlert = textAlert.slice(0, -2);
						textAlert += " sudah terdaftar!"
                	}
                    swal({
                    title: "Berhasil!",
                    text: textAlert,
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        detaildesa.getDataDetailDesa(function() {
                        	detaildesa.renderGridDetailDesa("")
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

detaildesa.selectedKota.subscribe(function(d) {
    if (d == "") {
        detaildesa.textKeterangan("")
    }else{
        var data = _.filter(detaildesa.dataMasterKota(),{'ID_KOTA':d})
        detaildesa.textKeterangan(data[0].KETERANGAN)
    }
})

detaildesa.search = function () {
	detaildesa.renderGridDetailDesa(detaildesa.textSearch())
}

detaildesa.searchWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            detaildesa.search()
        }
    });
}

detaildesa.textSearch.subscribe(function(e) {
	if (e == "") {
		detaildesa.renderGridDetailDesa("")
	}
})


detaildesa.init = function() {
	detaildesa.getDataDetailDesa(function() {
		detaildesa.renderGridDetailDesa("")
	})
	detaildesa.getDataDropdown()
	detaildesa.searchWhenEnterPressed()
	detaildesa.modalClosed()
}

$(function() {
	detaildesa.init()
})