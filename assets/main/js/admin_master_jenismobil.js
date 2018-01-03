var jenismobil = {}

jenismobil.textSearch = ko.observable("")

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
	console.log(jenismobil.textSearch())
}

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

    var param = {
        Squence : squenceSetter(column_name, month, year, digit_of_number),
        Data : data
    }

	console.log(param)
}

jenismobil.modalClosed = function(){
    $('#addJenisMobilModal').on('hidden.bs.modal', function () {
        ko.mapping.fromJS(jenismobil.newRecord(), jenismobil.record)
        $(".input-form").val("")
    })
}

jenismobil.searchWhenEnterPressed = function(){
    $("#textSearchID").on('keyup', function (e) {
        if (e.keyCode == 13) {
            jenismobil.search()
        }
    });
}


jenismobil.init = function () {
	jenismobil.searchWhenEnterPressed()
	jenismobil.modalClosed()
}

$(function () {
    jenismobil.init()
})