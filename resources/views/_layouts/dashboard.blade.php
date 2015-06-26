<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Software Administrasi Hotspot Javanet">
        <meta name="author" content="Miftah Afina - www.miftahafina.com">
        <link rel="icon" href="{{ asset('assets/ico/favicon.ico') }}">

        <title>SOSIS</title>

        <!-- CSS inti bootstrap -->
        <link href="{{ asset('assets/css/bootstrap.css') }}" type="text/css" rel="stylesheet"/>

        <!-- CSS ubahsuaian untuk template ini -->
        <link href="{{ asset('assets/css/dashboard.css') }}" type="text/css" rel="stylesheet"/>

        <!-- CSS pengaya untuk template ini -->
        <link href="{{ asset('assets/css/bootstrap-select') }}.min.css" type="text/css" rel="stylesheet"/>
        <link href="{{ asset('assets/css/datepicker3.css') }}" type="text/css" rel="stylesheet"/>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        @include('_partials.navbar')

        @include('_partials.modal')

        <div class="container-fluid">
            <div class="row">

                @include('_partials.sidebar')

                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    
                    @include('_partials.alert')
                    
                    @yield('content')
                
                </div>
                
            </div>
        </div>

        @include('_partials.footer')

        <!-- Inti JavaScript Bootstrap -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/docs.min.js') }}"></script>

        <!-- JavaScript Pengaya Bootstrap -->
        <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/locales/bootstrap-datepicker.id.js') }}"></script>
        
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="{{ asset('assets/js/ie10-viewport-bug-workaround.js') }}"></script>

        <!-- JavaScript Ubahsuaian -->
        <script>
        $('.selectpicker').selectpicker({
            size: 7
        });

        // A package from https://eternicode.github.io/bootstrap-datepicker/
        // Standard mode
        $('.datepicker').datepicker({
                format: "yyyy-mm-dd HH:ii",
                language: "id",
                autoclose: true,
                todayHighlight: true,
                orientation: "auto left"
        });

        // Month mode
        $('.datepicker-month').datepicker({
                format: "yyyy-mm",
                language: "id",
            minViewMode: "months",
                autoclose: true,
                todayHighlight: true,
                orientation: "auto right"
        });

        // Javascript untuk menghitung karakter
        // sumber http://www.bootply.com/uGGf9Tf4LS
        var text_max = 160;
        $('#count_message').html('sisa ' + text_max + ' karakter');

        $('#pesan').keyup(function() {
            var text_length = $('#pesan').val().length;
            var text_remaining = text_max - text_length;
          
            $('#count_message').html('sisa ' + text_remaining + ' karakter');
        });
        </script>
    </body>
</html>