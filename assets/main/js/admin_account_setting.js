var accountsetting = {}

accountsetting.dataMasterAccount = ko.observable()

accountsetting.newRecordAccount = function() {
	var data = {
		USERNAME_ADMIN	: "",
		NAMA_USER		: "",
		PASSWORD_ADMIN	: "",
		CONFIRM_PASSWORD: "",
		NOMOR_TELEPON	: "",
		KOTA			: "",
		ALAMAT_USER		: "",
		NOMOR_REKENING	: "",
		BANK			: "",
		PASSWORD 		: ""
	}

	return data
}

accountsetting.recordAccount = ko.mapping.fromJS(accountsetting.newRecordAccount())
accountsetting.dataAccount = ko.mapping.fromJS(accountsetting.newRecordAccount())

accountsetting.getDataAccount = function() {
	model.Processing(true)
	var url = "account_setting/GetDataAccount"
	var param = {}
	ajaxPost(url,param, function(res) {
        var result = JSON.parse(res)
        ko.mapping.fromJS(result, accountsetting.dataAccount)
        accountsetting.dataMasterAccount(result)
        model.Processing(false)
    })
}

accountsetting.editProfile = function() {
	$('#editProfileModal').modal('show')
	ko.mapping.fromJS(accountsetting.dataMasterAccount(), accountsetting.recordAccount)
}
accountsetting.editAccount = function() {
	$('#editAccountModal').modal('show')
	ko.mapping.fromJS(accountsetting.dataMasterAccount(), accountsetting.recordAccount)
}

accountsetting.modalClosed = function(){
    $('#editProfileModal').on('hidden.bs.modal', function () {
        ko.mapping.fromJS(accountsetting.newRecordAccount(), accountsetting.recordAccount)
    })
    $('#editAccountModal').on('hidden.bs.modal', function () {
        ko.mapping.fromJS(accountsetting.newRecordAccount(), accountsetting.recordAccount)
    })
}

accountsetting.saveDataProvile = function() {
	var data = ko.mapping.toJS(accountsetting.recordAccount)
	if (data.NAMA_USER == "") {
		return swal("Error!","Nama belum diisi", "error")
	}
	if (data.NOMOR_TELEPON == "") {
		return swal("Error!","Nomor telepon belum diisi", "error")
	}
	if (data.KOTA == "") {
		return swal("Error!","Kota belum diisi", "error")
	}
	if (data.ALAMAT_USER == "") {
		return swal("Error!","Alamat belum diisi", "error")
	}
	if (data.BANK == "") {
		return swal("Error!","Bank belum diisi", "error")
	}
	if (data.NOMOR_REKENING == "") {
		return swal("Error!","Nomor rekening belum diisi", "error")
	}
	if (data.USERNAME_ADMIN == "") {
		return swal("Error!","Username belum diisi", "error")
	}if (data.PASSWORD_ADMIN != data.CONFIRM_PASSWORD) {
		return swal("Error!","Konfirmasi password tidak sesuai", "error")
	}if (data.PASSWORD == "") {
		return swal("Error!","Password belum diisi", "error")
	}

	var url = "account_setting/UpdateDataAccount"
	var param = {
		Data : data
	}

	swal({
        title: "Apakah Anda yakin?",
        text: "akan mengubah data pribadi Anda!",
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
            $('#editProfileModal').modal('hide')
			$('#editAccountModal').modal('hide')
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
                        accountsetting.getDataAccount()
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
            	$('#editProfileModal').modal('hide')
				$('#editAccountModal').modal('hide')
            })
        }
    })
}

accountsetting.init = function() {
	accountsetting.getDataAccount()
	accountsetting.modalClosed()
}

$(function() {
	accountsetting.init()
})