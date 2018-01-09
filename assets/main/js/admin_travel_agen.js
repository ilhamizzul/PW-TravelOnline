var agentravel = {}

agentravel.textSearch = ko.observable("")
agentravel.dataMasterAgentravel = ko.observableArray([])
agentravel.HeaderText = ko.observable("Tambah")
agentravel.namaTravel = ko.observable()

agentravel.saveData =function() {
	console.log(agentravel.namaTravel())
}
agentravel.search = function() {
	console.log("search", agentravel.textSearch())
}

agentravel.modalClosed = function(){
    $('#addAgenTravel').on('hidden.bs.modal', function () {
        agentravel.namaTravel("")
    })
}

agentravel.init = function () {
	agentravel.modalClosed()
}
$(function () {
	agentravel.init()
})