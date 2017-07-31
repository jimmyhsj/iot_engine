app.controller('ReportsController', function ReportsController($scope, $http) {
	var t = loadChrno($http);
	// var r = loadProd();
	// var g = loadGoogleCalendarChart();
});

function loadChrno($http) {

    $http({
        method: 'GET',
        url: '/loadDyno'
    }).then(function successCallback(response) {
        var prodchartData = [];
        var chartData = [{
            "category": "Uptime",
            "segments": []
        },{
            "category": "Downtime",
            "segments": []
        }];
        var u = 0;
        var d = 0;
        
        var prod = angular.fromJson(response.data.prod);
        var status = angular.fromJson(response.data.status);
        angular.forEach(prod, function(line) {
            // Production table
            var color = "#ff5c33";
            if (line.count >= "5") {
                color = "#33cc33";
            }
            prodchartData.push({
                time: line.time,
                count: line.count,
                color: color
            });
        });

        angular.forEach(status, function(line) {
            // Choron graph
            var insert = {
                "start": line.start,
                "end": line.end,
                "count": line.count
            };
            if (line.state == "2") {
                insert.task = "Uptime";
                insert.color = "#33cc33";
                chartData[0].segments.push(insert);
                u += line.duration;
                $("#statesBody").append("<tr><td>" + insert.task + "</td><td>" + line.duration + "</td><td>" + insert.start + "</td><td>" + insert.end + "</td><td>"+insert.count+"</td></tr>");
            }
            if (line.state == "1") {
                insert.task = "Uptime";
                insert.color = "#33cc33";
                chartData[0].segments.push(insert);
                u += line.duration;
                $("#statesBody").append("<tr class=''><td>" + insert.task + "</td><td>" + line.duration + "</td><td>" + insert.start + "</td><td>" + insert.end  + "</td><td>"+insert.count+"</td></tr>");
            }
            if (line.state == "0") {
                insert.task = "Downtime";
                insert.color = "#ff5c33";
                chartData[1].segments.push(insert);
                d += line.duration;
                $("#statesBody").append("<tr class='danger'><td>" + insert.task + "</td><td>" + line.duration + "</td><td>" + insert.start + "</td><td>" + insert.end  + "</td><td>"+insert.count+"</td></tr>");
            }
            
        });

        var pieChartData = [{
            "state": "Uptime",
            "color": "#33cc33",
            "duration": u
        }, {
            "state": "Downtime",
            "color": "#ff5c33",
            "duration": d
        }];

        var chart = AmCharts.makeChart("chartdiv", {
            "type": "gantt",
            "theme": "light",
            "marginRight": 70,
            "period": "SS",
            "dataDateFormat": "YYYY-MM-DD JJ:NN:SS",
            "columnWidth": 0.5,
            "valueAxis": {
                "type": "date",
                "minPeriod": "ss"
            },
            // "brightnessStep": 7,
            "graph": {
                "fillAlphas": 1,
                "lineAlpha": 1,
                "lineColor": "#fff",
                "fillAlphas": 0.85,
                "balloonText": "<b>[[task]]</b>:<br />[[open]] -- [[value]]",

            },
            "rotate": true,
            "categoryField": "category",
            "segmentsField": "segments",
            "colorField": "color",
            "startDateField": "start",
            "endDateField": "end",
            "dataProvider": chartData,
            "valueScrollbar": {
                "autoGridCount": true
            },
            "chartCursor": {
                "cursorColor": "#55bb76",
                "valueBalloonsEnabled": false,
                "cursorAlpha": 0,
                "valueLineAlpha": 0.5,
                "valueLineBalloonEnabled": true,
                "valueLineEnabled": true,
                "zoomable": false,
                "valueZoomable": true
            },
            "export": {
                "enabled": true
            }
        });

        var prodchart = AmCharts.makeChart("prod_div", {
            "type": "serial",
            "theme": "none",
            "dataProvider": prodchartData,
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "fillColorsField": "color",
                "valueField": "count"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "valueAxes": [{
                "axisAlpha": 0,
                "position": "left",
                "title": "Production Count"
            }],
            "categoryField": "time",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            },
            "export": {
                "enabled": true
            }
        });

        var piechart = AmCharts.makeChart("piediv", {
            "type": "pie",
            "startDuration": 0,
            "theme": "light",
            "addClassNames": true,
            "legend": {
                "position": "right",
                "marginRight": 100,
                "autoMargins": false
            },
            "innerRadius": "30%",
            "defs": {
                "filter": [{
                    "id": "shadow",
                    "width": "200%",
                    "height": "200%",
                    "feOffset": {
                        "result": "offOut",
                        "in": "SourceAlpha",
                        "dx": 0,
                        "dy": 0
                    },
                    "feGaussianBlur": {
                        "result": "blurOut",
                        "in": "offOut",
                        "stdDeviation": 5
                    },
                    "feBlend": {
                        "in": "SourceGraphic",
                        "in2": "blurOut",
                        "mode": "normal"
                    }
                }]
            },
            "dataProvider": pieChartData,
            "valueField": "duration",
            "titleField": "state",
            "colorField": "color",
            "export": {
                "enabled": true
            }
        });

        // piechart.addListener("init", handleInit);
        // piechart.addListener("rollOverSlice", function (e) {
        //     handleRollOver(e);
        // });

    }, function errorCallback(error) {
        console.log(error);
    });
}
