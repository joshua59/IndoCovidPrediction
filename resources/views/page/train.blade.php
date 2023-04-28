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
</head>

<body class="hold-transition skin-blue-light sidebar-mini">

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

<!--amcharts charts -->

<script src="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/amcharts.js')}}"></script>
<script src="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/gauge.js')}}"></script>
<script src="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/serial.js')}}"></script>
<script src="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/amstock.js')}}"></script>
<script src="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/pie.js')}}"></script>
<script
    src="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/plugins/animate/animate.min.js')}}"></script>
<script
    src="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/plugins/export/export.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/themes/patterns.js')}}"></script>
<script src="{{asset('assets/vendor_components/amcharts_3.21.12.free/amcharts/themes/light.js')}}"></script>

<!-- App -->
<script src="{{asset('assets/js/template.js')}}"></script>

<!-- dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/js/pages/dashboard.js')}}"></script>

<!-- dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/js/pages/dashboard-chart.js')}}"></script>

<!-- demo purposes -->
<script src="{{asset('assets/js/demo.js')}}"></script>

</body>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>
<script>
    let model = null;
    let data = null;
    let trainingData = [

    ];

    let predictData = [];

    let x_for_pred = [[
        [450.0], [304.00], [357.00], [436.00], [426.00], [329.00], [511.00],
        [580.00], [556.00], [465.00], [486.00], [403.00], [329.00], [616.00]
    ]];

    async function train(){
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

        // console.log("Training model...");
        // model.compile({
        //     optimizer: tf.train.adam(0.0001),
        //     loss: tf.losses.huberLoss(),
        //     // metrics: ['']
        // });

        // wait for data to be loaded from database
        if (data == null){
            setTimeout(train, 1000);
            return;
        }

        let temp = [];
        for (let i = 0; i < data.length; i++){
            let row = data[i];
            temp.push([row['new_cases']]);
        }

        trainingData.push(temp);

        temp = [];

        // console.log(trainingData);
        // console.log(x_for_pred); // just to check if it has the same shape as the training data

        // for (let i = 0; i < trainingData.length; i++){
        //     for (let j = trainingData[i].length - 20; j < trainingData[i].length; j++){
        //         for (let k = 0; k < trainingData[i][j].length; k++){
        //             console.log(trainingData[i][j][k]);
        //             // let row = trainingData[i][j][k];
        //             // temp.push([row]);
        //         }
        //     }
        // }

        for (let i = trainingData[0].length - 14; i < trainingData[0].length; i++) {
            let row = trainingData[0][i][0];
            temp.push([row]);
        }

        predictData.push(temp);

        console.log("Predicting...");
        const tensor = tf.tensor3d(predictData, [1, 14, 1]);
        const prediction = await myModel.predict(tensor).data();
        console.log(prediction);
        console.log("Prediction done!");
    }

    train();
</script>
</html>
