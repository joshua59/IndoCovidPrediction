<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="icon" href="http://lion-admin-templates.multipurposethemes.com/lion-admin/images/favicon.ico"> --}}

    <title>Indonesia COVID-19 Prediction</title>

    <!-- Bootstrap 4.0-->
    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/vendor_components/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet"
          type="text/css">

    <!--amcharts -->
    <link href="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/plugins/export/export.css')}}"
          rel="stylesheet" type="text/css">

    <!-- Bootstrap-extend -->
    <link href="{{asset('assets/css/bootstrap-extend.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Morris charts -->
    <link href="{{asset('assets/vendor_components/morris.js/morris.css')}}" rel="stylesheet" type="text/css">

    <!-- weather weather -->
    <link href="{{asset('assets/vendor_components/weather-icons/weather-icons.css')}}" rel="stylesheet" type="text/css">

    <!-- date picker -->
    <link href="{{asset('assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}"
          rel="stylesheet" type="text/css">

    <!-- daterange picker -->
    <link href="{{asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet"
          type="text/css">

    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css')}}" rel="stylesheet"
          type="text/css">

    <!-- theme style -->
    <link href="{{asset('assets/css/master_style.css')}}" rel="stylesheet" type="text/css">

    <!-- skins -->
    <link href="{{asset('assets/css/skins/_all-skins.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.amcharts.com/lib/4/amcharts.css" type="text/css">

    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>

    <!-- Tautan script AmCharts -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/plugins/rangeSelector.js"></script>

</head>

<body class="hold-transition skin-blue-light sidebar-mini">
{{--    @foreach ($data as $key => $value)--}}
{{--        {{ $data[$key]['date'] }}--}}
{{--        {{ $data[$key]['new_cases'] }}--}}
{{--    @endforeach--}}


<!-- Main content -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- AREA CHART -->
            <div class="box">
                <div class="card-title" align="center">
                    <h2 class="box-title">COVID-19 Prediction Graph</h2>
                </div>
                <div class="box-body">
                    <div id="selectorDiv">

                    </div>
                    <div id="chartdiv">

                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <a href="{{ route('train') }}" id="train" class="btn btn-primary">Train</a>
        <p>Mantap kali {{ $updateNeeded }}</p>
        <p>anjay</p>
    </div>
    <!-- /.row -->

</div>
<!-- /.content -->

<div class="footer py-4 d-flex flex-lg-column" align="center">
    <!--begin::Container-->
    <div>
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2023©</span>
            <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Indonesia COVID-19's Cases
                Prediction</a>
        </div>
        <!--end::Copyright-->
    </div>
    <!--end::Container-->
</div>

<!-- jQuery 3 -->
<script src="{{asset('assets/vendor_components/jquery/dist/jquery.js')}}"></script>

<!-- popper -->
<script src="{{asset('assets/vendor_components/popper/dist/popper.min.js')}}"></script>

<!-- Bootstrap 4.0-->
<script src="{{asset('assets/vendor_components/bootstrap/dist/js/bootstrap.js')}}"></script>

<!-- Morris.js charts -->
<script src="{{asset('assets/vendor_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/morris.js/morris.min.js')}}"></script>

<!-- weather for demo purposes -->
<script src="{{asset('assets/vendor_plugins/weather-icons/WeatherIcon.js')}}"></script>

<!-- Sparkline -->
<script src="{{asset('assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.js')}}"></script>

<!-- daterangepicker -->
<script src="{{asset('assets/vendor_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- datepicker -->
<script src="{{asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

<!-- Slimscroll -->
<script src="{{asset('assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- FastClick -->
<script src="{{asset('assets/vendor_components/fastclick/lib/fastclick.js')}}"></script>

<!-- peity -->
<script src="{{asset('assets/vendor_components/jquery.peity/jquery.peity.js')}}"></script>

<!-- App -->
<script src="{{asset('assets/js/template.js')}}"></script>

<!-- amchart line graph -->
<script>
    am4core.ready(function () {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        // Add data
        chart.data = [
            @foreach($data as $d)
            {
                "date": "{{$d->date}}",
                "new_cases": "{{$d->new_cases}}",

                // make different color for is_predicted = 1
                @if($d->is_predicted == '1')
                "lineColor": "#fabd61",
                "legendText": "Predicted"
                @else
                "lineColor": "#61defa",
                "legendText": "Actual"
                @endif
                
            },
            @endforeach
        ];

        console.log(chart.data);

        // Set input format for the dates
        chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

        // Create axes
        let dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        let series = chart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "new_cases";
        series.dataFields.dateX = "date";
        series.tooltipText = "{new_cases}";
        series.name = "New Cases";
        series.legendSettings.valueText = "{valueY}";
        series.strokeWidth = 2;
        series.minBulletDistance = 15;
        series.propertyFields.stroke = "lineColor";
        series.propertyFields.fill = "lineColor";


        // Drop-shaped tooltips
        series.tooltip.background.cornerRadius = 20;
        series.tooltip.background.strokeOpacity = 0;
        series.tooltip.pointerOrientation = "vertical";
        series.tooltip.label.minWidth = 40;
        series.tooltip.label.minHeight = 40;
        series.tooltip.label.textAlign = "middle";
        series.tooltip.label.textValign = "middle";

        // Make bullets grow on hover
        let bullet = series.bullets.push(new am4charts.CircleBullet());
        bullet.circle.strokeWidth = 2;
        bullet.circle.radius = 4;
        bullet.circle.fill = am4core.color("#fff");
        bullet.propertyFields.fill = "lineColor";

        let bullethover = bullet.states.create("hover");
        bullethover.properties.scale = 1.3;

        // Make a panning cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "panXY";
        chart.cursor.xAxis = dateAxis;
        chart.cursor.snapToSeries = series;

        // Create vertical scrollbar and place it before the value axis
        chart.scrollbarY = new am4core.Scrollbar();
        chart.scrollbarY.parent = chart.leftAxesContainer;
        chart.scrollbarY.toBack();

        // Create a horizontal scrollbar with previe and place it underneath the date axis
        chart.scrollbarX = new am4charts.XYChartScrollbar();
        chart.scrollbarX.series.push(series);
        chart.scrollbarX.parent = chart.bottomAxesContainer;

        // chart.scrollbarX.thumb.minWidth = 50;
        // chart.scrollbarX.startGrip.minWidth = 50;

        dateAxis.start = 0.79;
        dateAxis.keepSelection = true;

        // Add legend
        chart.legend = new am4charts.Legend();
        chart.legend.position = "top";
        chart.legend.scrollable = true;

        var hoverState = series.columns.template.states.create("hover");
        hoverState.properties.fillOpacity = 1;
        hoverState.properties.strokeOpacity = 1;
        
        chart.legend.itemContainers.template.events.on("over", function (event) {
            processOver(event.target.dataItem.dataContext);
        })

        chart.legend.itemContainers.template.events.on("out", function (event) {
            processOut(event.target.dataItem.dataContext);
        })

        function processOver(hoveredSeries) {
            hoveredSeries.toFront();

            hoveredSeries.segments.each(function (segment) {
                segment.setState("hover");
            })

            chart.series.each(function (series) {
                if (series != hoveredSeries) {
                    series.segments.each(function (segment) {
                        segment.setState("dimmed");
                    })
                    series.bulletsContainer.setState("dimmed");
                }
            });
        }

        function processOut(hoveredSeries) {
            chart.series.each(function (series) {
                series.segments.each(function (segment) {
                    segment.setState("default");
                })
                series.bulletsContainer.setState("default");
            });
        }

    }); // end am4core.ready()
</script>

</body>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>

<script>
    let model = null;
    let parsedData = null;
    let parsedDataIndo = [];

    let data = null;
    let trainingData = [];

    let predictData = [];
    let predictionsToBeStored = [];

    async function predict() {
        console.log("Loading model...");
        const myModel = await tf.loadLayersModel('{{ asset('assets/model/model.json') }}');
        console.log(myModel.summary());
        // return model;
        model = myModel;
        console.log("Loading model done!");

        console.log("Getting data from database")
        $.ajax({
            url: "{{ route('get-data') }}",
            type: "GET",
            success: function (response) {
                // console.log(response);
                data = response.data;
            },
            error: function (response) {
                console.log(response);
            }
        });
        console.log("Getting data from database done!");

        // wait for data to be loaded from database
        if (data == null) {
            setTimeout(predict, 1000);
            return;
        }

        let temp = [];
        for (let i = 0; i < data.length; i++) {
            let row = data[i];
            temp.push([row['new_cases']]);
        }

        trainingData.push(temp);

        console.log("Predicting...")
        for (let count_prediction = 1; count_prediction <= 60; count_prediction++) {
            temp = [];
            predictData = [];

            for (let i = trainingData[0].length - 14; i < trainingData[0].length; i++) {
                let row = trainingData[0][i][0];
                temp.push([row]);
            }

            predictData.push(temp);
            // console.log(predictData);

            const tensor = tf.tensor3d(predictData, [1, 14, 1]);
            const prediction = await myModel.predict(tensor).data();
            console.log("Prediction no. " + count_prediction + " : " + prediction);

            // push prediction to trainingData
            trainingData[0].push([prediction[0]]);

            // push prediction to predictionsToBeStored
            predictionsToBeStored.push(prediction[0]);
        }
        console.log("Predicting done!");

        console.log("Storing predictions to database...");
        $.ajax({
            url: "{{ route('new-predictions') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                predictions: predictionsToBeStored
            },
            success: function (response) {
                console.log(response);
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    async function doEverything() {
        let updateNeded = {{$updateNeeded}};

        if (updateNeded) {
            const myModel = await tf.loadLayersModel('{{ asset('assets/model/model.json') }}');
            console.log(myModel.summary());
            // return model;
            model = myModel;

            console.log("Downloading data...");
            $.get('https://covid.ourworldindata.org/data/owid-covid-data.csv', function (data) {
                parsedData = Papa.parse(data, {header: true});
                // console.log(parsedData);

                // filter data for Indonesia
                for (let i = 0; i < parsedData['data'].length; i++) {
                    if (parsedData['data'][i]['location'] === 'Indonesia') {
                        // console.log(parsedData['data'][i]);

                        if (parsedData['data'][i]['new_cases'] === '') {
                            parsedData['data'][i]['new_cases'] = parsedData['data'][i - 1]['new_cases'];
                        }

                        parsedDataIndo.push({
                            'date': parsedData['data'][i]['date'],
                            'new_cases': parsedData['data'][i]['new_cases'],
                        });
                    }
                }

                // delete last data
                parsedDataIndo.pop();

                console.log(parsedDataIndo);

                // transform parsedDataIndo to JSON
                let parsedDataIndoJSON = JSON.stringify(parsedDataIndo);
                console.log(parsedDataIndoJSON);

                // send parsedDataIndoJSON to controller
                $.ajax({
                    url: "{{ route('add-data') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: parsedDataIndoJSON
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });

                // add last update data to data_update_history table
                $.ajax({
                    url: "{{ route('new-data') }}",
                    type: "GET",
                    success: function (response) {
                        console.log(response);
                        predict();
                        // reload
                        setTimeout(function () {
                            location.reload();
                        }, 10000);
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            });
        } else {
            console.log("Data is up to date!");
        }
    }

    doEverything();

</script>
</html>
