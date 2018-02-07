var dashboard = {}
dashboard.dataMastertransaksi = ko.observableArray([])

dashboard.getAllDataTransaksi = function(callback) {
	ajaxFormPost("admin_dashboard/GetTransaksi",{},function(data){
		dashboard.dataMastertransaksi(data)
		callback()
	})
}

dashboard.renderChartTransaksi = function() {
	var data = dashboard.dataMastertransaksi()
	var series = [
		{
            name: "ORDER",
            // field: 'TOTAL'
            template: function(e) {
            	console.log(e)
            }
        }, {
            name: "WAITING",
            // field: 'TOTAL'
    	}, {
            name: "BLOCKED",
            // field: 'TOTAL'
        }, {
            name: "CONFIRMED",
            // field: 'TOTAL' 
    	}
	]

	$("#ChartTransaksi").kendoChart({
	    // dataSource: {
	    //     data: data
	    // },
	    series: series,
	    categoryAxis: {
	        // field: "MONTH"
	        cartegories : _.groupBy(data, "MONTH")
	    },
	    tooltip: {
            visible: true,
            // format: "{0}%",
            template: "#= series.name #: #= value #"
        }
	});
}

dashboard.init = function() {
	dashboard.getAllDataTransaksi(function() {
		dashboard.renderChartTransaksi()
	})
}



$(function() {
	dashboard.init()
})