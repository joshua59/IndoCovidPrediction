//[Dashboard Javascript]

//Project:	Lion Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').wysihtml5();

  $('.daterange').daterangepicker({
    ranges   : {
      'Today'       : [moment(), moment()],
      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()
  }, function (start, end) {
    window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  });

  // SLIMSCROLL FOR CHAT WIDGET
  $('#direct-chat').slimScroll({
    height: '300px'
  });
			
// donut chart
		$('.donut').peity('donut');

// chart
	$("#linechart").sparkline([1,4,3,7,6,4,8,9,6,8,12], {
			type: 'line',
			width: '100',
			height: '38',
			lineColor: '#ffffff',
			fillColor: '#03a9f3',
			lineWidth: 2,
			minSpotColor: '#0fc491',
			maxSpotColor: '#0fc491',
		});
		
		$("#barchart").sparkline([1,4,3,7,6,4,8,9,6,8,12], {
			type: 'bar',
			height: '38',
			barWidth: 6,
			barSpacing: 4,
			barColor: '#ffffff',
		});
		$("#discretechart").sparkline([1,4,3,7,6,4,8,9,6,8,12], {
			type: 'discrete',
			width: '50',
			height: '38',
			lineColor: '#ffffff',
		});
		
//sparkline charts
$(document).ready(function() {
   var sparklineLogin = function() { 
         
        $("#sparkline8").sparkline([2,4,4,6,8,5,6,4,8,6,6,2 ], {
            type: 'line',
            width: '100%',
            height: '55',
            lineColor: '#fb9678',
            fillColor: '#fb9678',
            maxSpotColor: '#fb9678',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#fb9678'
        });
        
   }
    var sparkResize;
 
        $(window).resize(function(e) {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(sparklineLogin, 500);
        });
        sparklineLogin();

});
	
	
	
// WeatherIcon	
	WeatherIcon.add('icon1'	, WeatherIcon.SLEET , {stroke:false , shadow:false , animated:true } );	
	
// Morris-chart
//  var area = new Morris.Area({
//         element: 'revenue-chart',
//         data: [{
//             period: '2012',
//             iMac: 0,
//             iPhone: 0,
            
//         }, {
//             period: '2013',
//             iMac: 130,
//             iPhone: 100,
            
//         }, {
//             period: '2014',
//             iMac: 30,
//             iPhone: 60,
            
//         }, {
//             period: '2015',
//             iMac: 30,
//             iPhone: 200,
            
//         }, {
//             period: '2016',
//             iMac: 200,
//             iPhone: 150,
            
//         }, {
//             period: '2017',
//             iMac: 105,
//             iPhone: 90,
            
//         },
//          {
//             period: '2018',
//             iMac: 250,
//             iPhone: 150,
           
//         }],
//         xkey: 'period',
//         ykeys: ['iMac', 'iPhone'],
//         labels: ['iMac', 'iPhone'],
//         pointSize: 0,
//         fillOpacity: 0.4,
//         pointStrokeColors:['#b4becb', '#01c0c8'],
//         behaveLikeLine: true,
//         gridLineColor: '#e0e0e0',
//         lineWidth: 0,
//         smooth: true,
//         hideHover: 'auto',
//         lineColors: ['#b4becb', '#01c0c8'],
//         resize: true        
//     });


	
//am chart
	
var chartData1 = [];
var chartData2 = [];
var chartData3 = [];
var chartData4 = [];

generateChartData();

function generateChartData() {
  var firstDate = new Date();
  firstDate.setDate( firstDate.getDate() - 500 );
  firstDate.setHours( 0, 0, 0, 0 );

  var a1 = 1500;
  var b1 = 1500;
  var a2 = 1700;
  var b2  = 1700;
  var a3 = 1600;
  var b3 = 1600;
  var a4 = 1400;
  var b4 = 1400;

  for ( var i = 0; i < 500; i++ ) {
    var newDate = new Date( firstDate );
    newDate.setDate( newDate.getDate() + i );

    a1 += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    b1 += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);

    a2 += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    b2 += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);

    a3 += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    b3 += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);

    a4 += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    b4 += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);


    chartData1.push( {
      "date": newDate,
      "value": a1,
      "volume": a1
    } );
    chartData2.push( {
      "date": newDate,
      "value": a2,
      "volume": a2
    } );
    chartData3.push( {
      "date": newDate,
      "value": a3,
      "volume": b3 + 1500
    } );
    chartData4.push( {
      "date": newDate,
      "value": a4,
      "volume": b4 + 1500
    } );
  }
}

var chart = AmCharts.makeChart( "lion_amcharts_4", {
  "type": "stock",
  "theme": "light",
  "dataSets": [ {
      "title": "Data Kasus Baru",
      "fieldMappings": [ {
        "fromField": "value",
        "toField": "value"
      }, 
      {
        "fromField": "volume",
        "toField": "volume"
      }
     ],
      "dataProvider": chartData1,
      "categoryField": "date"
    }, 
  ],

  "panels": [ {
    "showCategoryAxis": true,
    "title": "Value",
    "percentHeight": 70,
    "stockGraphs": [ {
      "id": "g1",
      "valueField": "value",
      "compareField": "value",
      "balloonText": "[[title]]:<b>[[value]]</b>",
      "compareGraphBalloonText": "[[title]]:<b>[[value]]</b>"
    } ],
    "stockLegend": {
      "periodValueTextRegular": "[[value.close]]"
    }
   }, 
 ],



  "chartCursorSettings": {
    "valueBalloonsEnabled": true,
    "fullWidth": true,
    "cursorAlpha": 0.1,
    "valueLineBalloonEnabled": true,
    "valueLineEnabled": true,
    "valueLineAlpha": 0.5
  },

  "periodSelector": {
    "position": "left",
    "periods": [ {
      "period": "DD",
      "selected": true,
      "count": 1,
      "label": "1 Day"
    }, {
      "period": "DD",
      "count": 2,
      "label": "2 Day"
    },  {
      "period": "DD",
      "count": 7,
      "label": "1 Week"
    },{
      "period": "DD",
      "count": 14,
      "label": "2 Week"
    }, {
      "period": "MM",
      "selected": true,
      "count": 1,
      "label": "1 month"
    },{
      "period": "MM",
      "selected": true,
      "count": 2,
      "label": "2 month"
    } ]
  },

  "dataSetSelector": {
    "position": "left"
  },

  "export": {
    "enabled": true
  }
} );

	
//am gauge
var chart = AmCharts.makeChart( "lion_amcharts_15", {
  "theme": "light",
  "type": "gauge",
  "axes": [ {
    "axisColor": "#67b7dc",
    "axisThickness": 3,
    "endValue": 240,
    "gridInside": false,
    "inside": false,
    "radius": "100%",
    "valueInterval": 20,
    "tickColor": "#67b7dc"
  }, {
    "axisColor": "#fdd400",
    "axisThickness": 3,
    "endValue": 160,
    "radius": "80%",
    "valueInterval": 20,
    "tickColor": "#fdd400"
  } ],
  "arrows": [ {
    "color": "#67b7dc",
    "innerRadius": "20%",
    "nailRadius": 0,
    "radius": "85%"
  } ],
  "export": {
    "enabled": true
  }
} );

setInterval( randomValue, 2000 );

// set random value
function randomValue() {
  var value = Math.round( Math.random() * 240 );
  chart.arrows[ 0 ].setValue( value );
}

		


}); // End of use strict
