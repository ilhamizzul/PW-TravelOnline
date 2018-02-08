var dashboard = {}
var monthName = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "juli", "Agustus", "September", "Oktober", "November", "Desember"]
// console.log(monthName)

dashboard.dataMastertransaksi = ko.observableArray([])
dashboard.dataMasterRevenue = ko.observableArray([])

dashboard.getAllDataTransaksi = function(callback) {
	model.Processing(true)
	ajaxFormPost("admin_dashboard/GetTransaksi",{},function(data){
		dashboard.dataMastertransaksi(data)
		callback()
		model.Processing(false)
	})
}

dashboard.renderChartTransaksi = function() {
	var data = dashboard.dataMastertransaksi()

	var month = []
	var blockeddata = []
	var waitingdata = []
	var orderdata = []
	var confirmeddata = []
	_.forEach(_.groupBy(dashboard.dataMastertransaksi(), "MONTH"),function(value, key) {
		month.push(key)
		blockeddata.push([])
		waitingdata.push([])
		orderdata.push([])
		confirmeddata.push([])
	})

	for(i=0;i<blockeddata.length;i++){
		var x =_.filter(dashboard.dataMastertransaksi(), {'MONTH':month[i]})
		_.each(x, function(v, k){

			if (v.STATUS == "ORDER") {
				orderdata[i].push(v.QTY)
			}
			if (v.STATUS == "WAITING") {
				waitingdata[i].push(v.QTY)
			}
			if (v.STATUS == "BLOCKED") {
				blockeddata[i].push(v.QTY)
			}
			if (v.STATUS == "CONFIRMED") {
				confirmeddata[i].push(v.QTY)
			}
		})
	}

	for (var i = 0; i < month.length; i++) {
		var idx = parseInt(month[i])
		month[i] = monthName[idx - 1]
	}


	var series = [
		{
            name: "ORDER",
            overlay: { gradient: "none" },
            data : orderdata,
        }, {
            name: "WAITING",
            overlay: { gradient: "none" },
            data: waitingdata
    	}, {
            name: "BLOCKED",
            overlay: { gradient: "none" },
            data: blockeddata
        }, {
            name: "CONFIRMED",
            overlay: { gradient: "none" },
            data: confirmeddata
    	}
	]

	$("#ChartTransaksi").kendoChart({
		legend: {
        position: "bottom"
    	},
	    series: series,
	    categoryAxis: {
	        categories: month,
	        majorGridLines: {
                visible: false
            },
            minorGridLines: {
                visible: false
            },
	    },
	    seriesColors: ["#337ab7", "#f0ad4e", "#d9534f", "#5cb85c"],
	    tooltip: {
            visible: true,
            template: "#= series.name #: #= value #"
        },
        chartArea: {
            height: 220
        },
	});
}

dashboard.getAllDataRevenue = function(callback) {
	model.Processing(true)
	ajaxFormPost("admin_dashboard/GetRevenue",{},function(data){
		dashboard.dataMasterRevenue(data)
		callback()
		model.Processing(false)
	})
}

dashboard.renderChartRevenue = function() {
	var data = dashboard.dataMasterRevenue()
	var total = _.map(dashboard.dataMasterRevenue(),"TOTAL")
	var month = _.map(dashboard.dataMasterRevenue(),"MONTH")
	$("#ChartRevenew").kendoChart({
	    dataSource: {
	        data: data
	    },
	    legend: {
        position: "bottom"
	    },
	    seriesDefaults: {
	        type: "line"
	    },
	    series: [{
	        field: "TOTAL",
	        overlay: { gradient: "none" },
	        name: "Pendapatan"
	    }],
	    categoryAxis: {
	        field: "MONTH"
	    },
	    valueAxis: {
            labels: {
                format: "Rp{0},-"
            },
            line: {
                visible: false
            }
        },
	    seriesColors: ["#337ab7"],
	    tooltip: {
            visible: true,
            template: "#= series.name #:Rp #= value #"
        },
        chartArea: {
            height: 220
        },
	});
}

dashboard.getHeaderData = function() {
	model.Processing(true)
	ajaxFormPost("admin_dashboard/GetHeaderData",{},function(data){
		dashboard.setHeaderText(data)
		model.Processing(false)
	})
}

dashboard.setHeaderText = function(data) {
	$("#jumlahTransaksi").text(data.TRANSAKSI)
	$("#jumlahMobil").text(data.MOBIL)
	$("#jumlahCakupanDaerah").text(data.CAKUPANDAERAH)
	$("#jumlahPelanggan").text(data.PELANGGAN)
}

dashboard.init = function() {
	dashboard.getHeaderData()
	
	dashboard.getAllDataTransaksi(function() {
		dashboard.renderChartTransaksi()
	})

	dashboard.getAllDataRevenue(function() {
		dashboard.renderChartRevenue()
	})
}



$(function() {
	dashboard.init()
})

$(window).resize(function()
{
    kendo.resize($("div.k-chart[data-role='chart']"));
});