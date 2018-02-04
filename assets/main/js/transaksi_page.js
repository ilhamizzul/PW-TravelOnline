var transaksi = {}

transaksi.getAdminData = function() {
	var url = base_url+"index.php/transaksi/GetAdminData"
	ajaxFormPost(url, {}, function(res) {
        // var result = JSON.parse(res)
        // transaksi.dataMasterOperatorTravel(res)
        // model.Processing(false)
        document.getElementById("BANK").innerHTML = res.BANK+": "+res.NOMOR_REKENING
        // document.getElementById("REKENING").innerHTML = 
    })
}

transaksi.uploadBuktiPembayaran = function(id) {
	var formData = new FormData()
	var attachment = document.getElementById("inputImage")
	formData.append("fileUpload", attachment.files[0]);
	formData.append("ID", id);

	if (attachment.files.length == 0) {
		return swal('Error', 'Anda belum menginputkan bukti transfer', 'error')
	}

	var url = base_url+"index.php/transaksi/UploadBuktiPembayaran"
	
	ajaxFilePost(url, formData, function(res) {
		window.location.assign(base_url+"index.php/history")
	})
}

transaksi.CountDownDeadline = function() {
	var jam = $('#jamPesan')["0"].childNodes["0"].data
	if ($('#STATUS')[0].innerHTML == "ORDER") {
		var tanggalpesan = $('#tanggalPesan')[0].innerHTML
		var tanggalberangkat = $('#tanggalBerangkat')[0].innerHTML
		var tenggang
		$.when(
			SetTenggangWaktu(tanggalpesan, tanggalberangkat, jam)
			).done(function (x) {
				countDownTime(x,'CountDown')
		}
		)
		}else{
			$('#CountDown')[0].innerHTML = "-- --  :  -- --  :  -- --"
		}
	
}

transaksi.readURL = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        	$('#imgBuktiTransfer').removeAttr("src")
            $('#imgBuktiTransfer')
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
			$('#imgBuktiTransfer').removeAttr("src")
        	return swal("Over size", 'your file size = '+fix+"KB maximum size is 2048KB",'error')
        }

        reader.readAsDataURL(input.files[0]);
    }
}

transaksi.init = function() {
	if (STATUS == "ORDER") {
		transaksi.getAdminData()
		transaksi.CountDownDeadline()
	}
	
}

$(function () {
	transaksi.init();
})