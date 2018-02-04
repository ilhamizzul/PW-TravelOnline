var travelsetting = {}
travelsetting.namaTravel = ko.observable()
// travelsetting.idTravel = ko.observable()
travelsetting.newDataTravelSetting  = function() {
	var data = {
		ID_TRAVEL	: "",
		NAMA_TRAVEL : "",
		LOGO 		: ""
	}
	return data
}

travelsetting.dataTravelSetting = ko.mapping.fromJS(travelsetting.newDataTravelSetting())

travelsetting.editTravel = function() {
	$("#editTravelModal").modal("show")
}
travelsetting.changeLogo = function() {
	$("#changeLogo").modal("show")
}

travelsetting.GetDataTravel = function() {
	model.Processing(true)
	var url = "travel_setting/GetDataTravel"
	var param = {}
	ajaxPost(url,param, function(res) {
        var result = JSON.parse(res)
        ko.mapping.fromJS(result[0], travelsetting.dataTravelSetting)
        var url =""
         $('#imageLogo').removeAttr("src")
         $('#inputLogo').removeAttr("src")
        if (result[0].LOGO == "") {
        	url = base_url+"assets/img/default.jpg"
        }else{
        	url = base_url+"assets/uploads/"+result[0].LOGO
        }
        $('#imageLogo').attr("src", url)
        $('#inputLogo').attr("src", url)
        model.Processing(false)
    })
}

travelsetting.readURL = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        	$('#inputLogo').removeAttr("src")
            $('#inputLogo')
                .attr('src', e.target.result)
                // .attr('style',  'max-width: 200px; max-height: 200px;');
                // .height(200);
        };

        var fsize = input.files.item(0).size;
        var kb = fsize/1024;
        if ( kb > 2048) {
        	var fix = kb.toFixed(2)
        	var $el = $('#inputImage');
			$el.wrap('<form>').closest('form').get(0).reset();
			$el.unwrap();
			$('#inputLogo').removeAttr("src")
        	return swal("Over size", 'your file size = '+fix+"KB maximum size is 2048KB",'error')
        }

        reader.readAsDataURL(input.files[0]);
    }
}

travelsetting.resetChangeLogo = function() {
	$("#inputImage").val("")
	var url = travelsetting.dataTravelSetting.LOGO()
	if (url == "") {
    	url = base_url+"assets/img/default.jpg"
    }else{
    	url = base_url+"assets/uploads/"+url
    }
	$("#inputLogo").attr("src",url)
}

travelsetting.modalClosed = function() {
	$('#editTravelModal').on('hidden.bs.modal', function () {
		travelsetting.namaTravel("")
    })
    $('#changeLogo').on('hidden.bs.modal', function () {
    	travelsetting.resetChangeLogo()
    })
}

travelsetting.saveNamaTravel = function() {
	var namaTravel = travelsetting.namaTravel()
	if (namaTravel == "") {
		return swal("Error!","Nama travel belum diisi","error")
	}
	var url = "travel_setting/UpdateNamaTravel"
	var param = {
		NAMA_TRAVEL : firstLetterUpparcase(namaTravel)
	}

	swal({
        title: "Apakah Anda yakin?",
        text: "akan mengubah nama travel!",
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
            $('#editTravelModal').modal('hide')
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
                        travelsetting.GetDataTravel();
                    });
                }
                model.Processing(false)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                '',
                'error'
            ).then(function() {
            	$('#editTravelModal').modal('hide')
            })
        }
    })
}

travelsetting.saveLogo = function() {
    var formData = new FormData()
    var attachment = document.getElementById("inputImage")
    formData.append("fileUpload", attachment.files[0]);

    if (attachment.files.length == 0) {
            return swal('Error', 'Anda belum menginputkan logo travel', 'error')
    }
    
    var url = "travel_setting/ChangeLogoTravel"

    // console.log(attachment.files[0])

    swal({
        title: "Apakah Anda yakin?",
        text: "akan mengubah logo travel!",
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
            $('#changeLogo').modal('hide')
            ajaxFilePost(url, formData, function(res) {
                if (res.isError) {
                    swal("Gagal", res.message, "error")
                }else{
                    swal({
                    title: "Berhasil!",
                    text: "Logo telah diganti!",
                    type: "success",
                    confirmButtonColor: "#3da09a"
                    }).then(() => {
                        travelsetting.GetDataTravel();
                    });
                }
                model.Processing(false)
            }, function(err) {
                console.log(err)
            })
        } else if (result.dismiss === 'cancel') {
            swal(
                'Dibatalkan',
                '',
                'error'
            ).then(function() {
                $('#changeLogo').modal('hide')
            })
        }
    })
}


travelsetting.init = function() {
	travelsetting.GetDataTravel()
	travelsetting.modalClosed()
}

$(function() {
	travelsetting.init()
})