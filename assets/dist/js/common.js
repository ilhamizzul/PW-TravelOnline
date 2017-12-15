function ajaxPost(url, data, fnOk, fnNok) {
    $.ajax({
        url: url,
        type: 'POST',
        data: ko.mapping.toJSON(data),
        //data: data, 
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            if (typeof fnOk == "function") fnOk(data);
            koResult = "OK";
        },
        error: function (error) {
            if (typeof fnNok == "function") {
                fnNok(error);
            }
            else {
                alert("There was an error posting the data to the server: " + error.responseText);
            }
        }
    });
}

function ajaxFormPost(url, data, fnOk, fnNok) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data, 
        dataType: "JSON",
        success: function (data) {
            if (typeof fnOk == "function") fnOk(data);
            koResult = "OK";
        },
        error: function (error) {
            if (typeof fnNok == "function") {
                fnNok(error);
            }
            else {
                alert("There was an error posting the data to the server: " + error.responseText);
            }
        }
    });
}

function newRecordSquence(){
    var squence = {}
        squence.nama_kolom = ""
        squence.bulan = 0
        squence.tahun = 0
        squence.digit_angka = 0
    return squence
}

var recordSquence = ko.mapping.fromJS(newRecordSquence())


function squenceSetter(column_name, month, year, digit_of_number) {
    // var url = "admin_master_daerah/testSquence"
    var squence = ko.mapping.toJS(recordSquence)
    squence.nama_kolom = column_name
    squence.bulan = month
    squence.tahun = year
    squence.digit_angka = digit_of_number

    return squence;
}