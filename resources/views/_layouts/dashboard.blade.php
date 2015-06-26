<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Software Administrasi Hotspot Javanet">
        <meta name="author" content="Miftah Afina - www.miftahafina.com">
        <link rel="icon" href="assets/ico/favicon.ico">

        <title>OPH Javanet</title>

        <!-- CSS inti bootstrap -->
        {{ HTML::style('assets/css/bootstrap.min.css') }}

        <!-- CSS ubahsuaian untuk template ini -->
        {{ HTML::style('assets/css/dashboard.css') }}

        <!-- CSS pengaya untuk template ini -->
        {{ HTML::style('assets/css/bootstrap-select.min.css') }}
        {{ HTML::style('assets/css/datepicker3.css') }}

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
        {{ HTML::script('assets/js/jquery.min.js') }}
        {{ HTML::script('assets/js/bootstrap.min.js') }}
        {{ HTML::script('assets/js/docs.min.js') }}

        <!-- JavaScript Pengaya Bootstrap -->
        {{ HTML::script('assets/js/bootstrap-select.min.js') }}
        {{ HTML::script('assets/js/bootstrap-datepicker.js') }}
        {{ HTML::script('assets/js/locales/bootstrap-datepicker.id.js') }}
        
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        {{ HTML::script('assets/js/ie10-viewport-bug-workaround.js') }}

        <!-- JavaScript Ubahsuaian -->
        <script>
        $('.selectpicker').selectpicker({
            size: 7
        });

        // A package from https://eternicode.github.io/bootstrap-datepicker/
        // Standard mode
        $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
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

        $('#pelanggan_id_tagihan').on('change', function() {
            var tarif = $("#pelanggan_id_tagihan option:selected").data("tarif");
            var paket = $("#pelanggan_id_tagihan option:selected").data("paket");
            $("#nominal_tagihan").val(tarif);
            $("#paket_id_tagihan").val(paket);
        });

        $('#tagihan_id_bayar').on('change', function() {
            var nominal = $("#tagihan_id_bayar option:selected").data("nominal");
            var pelanggan = $("#tagihan_id_bayar option:selected").data("pelanggan");
            $("#nominal_bayar").val(nominal);
            $("#pelanggan_id_bayar").val(pelanggan);
        });
        </script>
    </body>
</html>