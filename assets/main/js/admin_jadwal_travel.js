var jadwaltravel = {}
jadwaltravel.dataMasterJadwalTravel = ko.observable()
jadwaltravel.dataMasterKendaraanTravel = ko.observable()
jadwaltravel.dataMasterKota = ko.observable()
jadwaltravel.textSearch = ko.observable('')
jadwaltravel.showInEdit = ko.observable(false)
jadwaltravel.showInAdd = ko.observable(false)

jadwaltravel.newRecordJadwalTravel = function() {
    var data = {
        ID_JADWAL_TRAVEL : "",
        ID_KENDARAAN_TRAVEL : "",
        ID_KOTA_ASAL : "",
        KOTAT_ASAL : "",
        ID_KOTA_TUJUAN : "",
        KOTA_TUJUAN : "",
        WAKTU_BERANGKAT : "",
        WAKTU_SAMPAI : "",
        TARIF : 0
    }

    return data
}

jadwaltravel.recordJadwalTravel = ko.mapping.fromJS(jadwaltravel.newRecordJadwalTravel())

jadwaltravel.getDataJadwalTravel = function(callback) {
	model.Processing(true)
    var url = "admin_jadwal_travel/GetDataJadwalTravel"
    ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        jadwaltravel.dataMasterJadwalTravel(result)
        callback()
        model.Processing(false)
    })
}

jadwaltravel.renderGridJadwalTravel = function(textSearch){
    var data = jadwaltravel.dataMasterJadwalTravel()

    if (textSearch != "") {
        var results = _.filter(data, function (item) {
            return _.includes(item.ID_JADWAL_TRAVEL.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.WARNA_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.TYPE_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.NO_POL_KENDARAAN.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.WAKTU_BERANGKAT.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.WAKTU_SAMPAI.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.KOTAT_ASAL.toLowerCase(), textSearch.toLowerCase())
                 ||_.includes(item.KOTA_TUJUAN.toLowerCase(), textSearch.toLowerCase())
        });
        data = results
    }

    var columns = [{
        // field: 'Kode',
        title: 'No',
        width: 30,
        template : function(dataItem){
            var idxs = _.findIndex(data, function (d) {
                return d.ID_JADWAL_TRAVEL == dataItem.ID_JADWAL_TRAVEL
            })
            // var idxs = _.findIndex(data, dataitem)
            // console.log(dataitem)
            return idxs + 1
        }
    }, {
        field: 'ID_JADWAL_TRAVEL',
        title: 'Kode Jadwal',
        width: 110,
    }, {
        title: 'Mobil - Nomor Polisi',
        width: 190,
        template: function(d) {
        	return d.TYPE_KENDARAAN + " - " + d.WARNA_KENDARAAN + " - " + d.NO_POL_KENDARAAN
        }
    }, {
        field: 'KOTAT_ASAL',
        title: 'Kota Asal',
        width: 95,
        template: function(res) {
            if (res.ID_KOTA_ASAL.substr(0, 3) == "KOT") {
                return res.KOTAT_ASAL
            }else{
                return res.KOTAT_ASAL+" (KAB)"
            }
        }
    }, {
        field: 'KOTA_TUJUAN',
        title: 'Kota Tujuan',
        width: 95,
        template: function(res) {
            if (res.ID_KOTA_TUJUAN.substr(0, 3) == "KOT") {
                return res.KOTA_TUJUAN
            }else{
                return res.KOTA_TUJUAN+" (KAB)"
            }
        }
    }, {
        field: 'WAKTU_BERANGKAT',
        title: 'Berangkat',
        width: 70
    }, {
        field: 'WAKTU_SAMPAI',
        title: 'Sampai',
        width: 70
    }, {
        // field: 'TARIF',
        title: 'Tarif',
        width: 80,
        template: function(d) {
            return ChangeToRupiah(parseFloat(d.TARIF))
        }
    }, {
        title: 'Action',
        width: 60,
        template : function (d) {
            var dsb = ""
            var tooltip = ""
            var hrefedit = "href=\"javascript:jadwaltravel.editJadwalTravel('"+d.ID_JADWAL_TRAVEL+"')\""
            var hrefdelete = "href=\"javascript:jadwaltravel.deleteJadwalTravel('"+d.ID_JADWAL_TRAVEL+"')\""
            if (model.Role() == "ADMIN") {
                dsb = "disabled = \"disabled\""
                hrefedit = ""
                hrefdelete = ""
                tooltip = "data-toggle=\"tooltip\" title=\"Anda tidak memiliki akses untuk kegiatan ini\""
            }
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

    $('#gridJadwalTravel').kendoGrid({
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

jadwaltravel.search = function() {
    textSearch = jadwaltravel.textSearch()
    jadwaltravel.renderGridJadwalTravel(textSearch)
}

jadwaltravel.searchWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            jadwaltravel.search()
        }
    });
}

jadwaltravel.textSearch.subscribe(function(x) {
    if (x == "") {
        jadwaltravel.renderGridJadwalTravel("")
    }
})

jadwaltravel.renderDropdownKendaraanTravel = function() {
    dataX = jadwaltravel.dataMasterKendaraanTravel()
    $("#kendaraan_travel").kendoDropDownList({
        filter: "contains",
        autoBind: false,
        optionLabel: "Pilih kendaraan...",
        dataTextField: "KETERANGAN",
        dataValueField: "ID_KENDARAAN_TRAVEL",
        dataSource: {
            data: dataX,
            schema: {
                parse: function(response) {
                  var length = response.length;
                  var dataItem;
                  var idx = 0;
            
                  for (; idx < length; idx++) {
                     dataItem = response[idx];
                     dataItem.KETERANGAN = dataItem.TYPE_KENDARAAN + " - " + dataItem.NO_POL_KENDARAAN;
                  }

                  return response;
                }
            }
        }
    });
}

jadwaltravel.getDataKendaraanTravel = function(callback) {
	// model.Processing(true)
    var url = "admin_jadwal_travel/GetDataKendaraanTravel"
    ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        jadwaltravel.dataMasterKendaraanTravel(result)
        callback()
        // model.Processing(false)
    })
}

jadwaltravel.renderDropdownKota = function() {
    data = jadwaltravel.dataMasterKota()
    $("#asal").kendoDropDownList({
        filter: "contains",
        autoBind: false,
        optionLabel: "Pilih kota asal...",
        dataTextField: "NAMA_KOTA",
        dataValueField: "ID_KOTA",
        dataSource: data,
        template: function(res) {
            if (res.KETERANGAN == "Kota") {
                return res.NAMA_KOTA+"("+res.KETERANGAN+")"
            }else{
                return res.NAMA_KOTA
            }
        }
    });

    $("#tujuan").kendoDropDownList({
        filter: "contains",
        autoBind: false,
        optionLabel: "Pilih kota tujuan...",
        dataTextField: "NAMA_KOTA",
        dataValueField: "ID_KOTA",
        dataSource: data,
        template: function(res) {
            if (res.KETERANGAN == "Kota") {
                return res.NAMA_KOTA+"("+res.KETERANGAN+")"
            }else{
                return res.NAMA_KOTA
            }
        }
    });
}

jadwaltravel.resetForm = function() {
    ko.mapping.fromJS(jadwaltravel.newRecordJadwalTravel(), jadwaltravel.recordJadwalTravel)
    $('#kendaraan_travel').data('kendoDropDownList').value(-1)
    $('#asal').data('kendoDropDownList').value(-1)
    $('#tujuan').data('kendoDropDownList').value(-1)
    $(".input-form").val("")
    jadwaltravel.showInAdd(false)
    jadwaltravel.showInEdit(false)
}

jadwaltravel.getDataKota = function(callback) {
	// model.Processing(true)
    var url = "admin_jadwal_travel/GetDataKota"
    ajaxPost(url, {}, function(res) {
        var result = JSON.parse(res)
        jadwaltravel.dataMasterKota(result)
        callback()
        // model.Processing(false)
    })
}

jadwaltravel.ModalClosed = function() {
    $('#addJadwalModal').on('hidden.bs.modal', function () {
        jadwaltravel.resetForm()
    })
}

jadwaltravel.maskingMoney = function () {
    $('.currency').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,
        rightAlign: false,
        allowMinus: false
    });
}

jadwaltravel.validate = function(data) {
    // body...
}

jadwaltravel.saveJadwalTravel = function() {
    data = ko.mapping.toJS(jadwaltravel.recordJadwalTravel)
    data.TARIF = FormatCurrency(data.TARIF)
    if (data.ID_KENDARAAN_TRAVEL == "") {
        return swal("Error!","Anda belum memilih kendaraan", "error");
    }
    if (data.ID_KOTA_ASAL == "") {
        return swal("Error!","Anda belum memilih kota asal", "error");
    }
    if (data.ID_KOTA_TUJUAN == "") {
        return swal("Error!","Anda belum memilih kota tujuan", "error");
    }
    if (data.WAKTU_BERANGKAT == "") {
        return swal("Error!","Anda belum mengisi waktu keberangkatan", "error");
    }
    if (data.WAKTU_SAMPAI == "") {
        return swal("Error!","Anda belum mengisi waktu sampai", "error");
    }
    if (data.TARIF == 0) {
        return swal("Error!","Tarif tidak valid", "error");
    }
    if (data.ID_KOTA_ASAL == data.ID_KOTA_TUJUAN) {
        return swal("Error!","Kota asal dan kota tujuan sama", "error");
    }
    if (data.WAKTU_BERANGKAT == data.WAKTU_SAMPAI) {
        return swal("Error!","Waktu bernagkat dan waktu sampai tidak valid", "error");
    }
    data.KOTAT_ASAL = _.filter(jadwaltravel.dataMasterKota(), { 'ID_KOTA': data.ID_KOTA_ASAL})[0].NAMA_KOTA
    data.KOTA_TUJUAN = _.filter(jadwaltravel.dataMasterKota() ,{'ID_KOTA' : data.ID_KOTA_TUJUAN})[0].NAMA_KOTA

    var url = "admin_jadwal_travel/InsertJadwalTravel"
    var param = {
        Data : data
    }
    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menyimpan jadwal travel "+data.KOTAT_ASAL+" - "+data.KOTA_TUJUAN+"!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#eea236',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, submit it!',
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
                    text: "Data berhasil disimpan!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        $('#addJadwalModal').modal('hide')
                        jadwaltravel.getDataJadwalTravel(function() {
                            jadwaltravel.renderGridJadwalTravel("")
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

jadwaltravel.addJadwalTravel = function() {
    jadwaltravel.showInAdd(true)
}

jadwaltravel.editJadwalTravel = function(id) {
    data = _.filter(jadwaltravel.dataMasterJadwalTravel(), {'ID_JADWAL_TRAVEL': id})
    ko.mapping.fromJS(data[0], jadwaltravel.recordJadwalTravel)
    $('#kendaraan_travel').data('kendoDropDownList').value(data[0].ID_KENDARAAN_TRAVEL);
    $('#asal').data('kendoDropDownList').value(data[0].ID_KOTA_ASAL);
    $('#tujuan').data('kendoDropDownList').value(data[0].ID_KOTA_TUJUAN);
    $('#addJadwalModal').modal('show')
    jadwaltravel.showInEdit(true)
}

jadwaltravel.updateJadwalTravel = function() {
    data = ko.mapping.toJS(jadwaltravel.recordJadwalTravel)
    data.TARIF = FormatCurrency(data.TARIF)
    if (data.ID_KENDARAAN_TRAVEL == "") {
        return swal("Error!","Anda belum memilih kendaraan", "error");
    }
    if (data.ID_KOTA_ASAL == "") {
        return swal("Error!","Anda belum memilih kota asal", "error");
    }
    if (data.ID_KOTA_TUJUAN == "") {
        return swal("Error!","Anda belum memilih kota tujuan", "error");
    }
    if (data.WAKTU_BERANGKAT == "") {
        return swal("Error!","Anda belum mengisi waktu keberangkatan", "error");
    }
    if (data.WAKTU_SAMPAI == "") {
        return swal("Error!","Anda belum mengisi waktu sampai", "error");
    }
    if (data.TARIF == 0) {
        return swal("Error!","Tarif tidak valid", "error");
    }
    if (data.ID_KOTA_ASAL == data.ID_KOTA_TUJUAN) {
        return swal("Error!","Kota asal dan kota tujuan sama", "error");
    }
    if (data.WAKTU_BERANGKAT == data.WAKTU_SAMPAI) {
        return swal("Error!","Waktu bernagkat dan waktu sampai tidak valid", "error");
    }
    data.KOTAT_ASAL = _.filter(jadwaltravel.dataMasterKota(), { 'ID_KOTA': data.ID_KOTA_ASAL})[0].NAMA_KOTA
    data.KOTA_TUJUAN = _.filter(jadwaltravel.dataMasterKota() ,{'ID_KOTA' : data.ID_KOTA_TUJUAN})[0].NAMA_KOTA

    var url = "admin_jadwal_travel/UpdateJadwalTravel"
    var param = {
        Data : data
    }
    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan mengubah jadwal travel dengan kode "+data.ID_JADWAL_TRAVEL+"!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#eea236',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, submit it!',
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
                    text: "Data berhasil diubah!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        $('#addJadwalModal').modal('hide')
                        jadwaltravel.getDataJadwalTravel(function() {
                            jadwaltravel.renderGridJadwalTravel("")
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

jadwaltravel.deleteJadwalTravel = function(id) {
    var url = "admin_jadwal_travel/DeleteJadwalTravel"
    var param = {
        Id : id
    }
    swal({
        title: "Apakah Anda yakin?",
        text: "Anda akan menghapus jadwal travel dengan kode "+id+"!",
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
                        jadwaltravel.getDataJadwalTravel(function() {
                            jadwaltravel.renderGridJadwalTravel("")
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

jadwaltravel.init = function() {
    jadwaltravel.getDataKendaraanTravel(function() {
        jadwaltravel.renderDropdownKendaraanTravel()
    })
    jadwaltravel.getDataKota(function() {
        jadwaltravel.renderDropdownKota()
    })
	jadwaltravel.getDataJadwalTravel(function() {
		jadwaltravel.renderGridJadwalTravel("")
	})

    jadwaltravel.maskingMoney()
    jadwaltravel.searchWhenEnterPressed()
    jadwaltravel.ModalClosed()
}

$(function() {
	jadwaltravel.init()
})