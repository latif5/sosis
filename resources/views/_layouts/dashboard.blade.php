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

        <!-- CSS pengaya untuk template datepicker dan select -->
        <link href="{{ asset('assets/css/bootstrap-select.min.css') }}" type="text/css" rel="stylesheet"/>
        <link href="{{ asset('assets/css/datepicker3.css') }}" type="text/css" rel="stylesheet"/>

        <!-- CSS pengaya untuk template datetime picker -->
        <link href="{{ asset('assets/css/bootstrap-datetimepicker.css') }}" type="text/css" rel="stylesheet"/>

        <!-- CSS pengaya untuk template awesome bootstrap checkbox -->
        {{-- dari https://github.com/flatlogic/awesome-bootstrap-checkbox --}}
        {{-- <link href="{{ asset('assets/css/awesome-bootstrap-checkbox.css') }}" type="text/css" rel="stylesheet"/> --}}
        {{-- di disabled --}}

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
        <script src="{{ asset('assets/js/bootstrap-confirmation.js') }}"></script>

        <!-- JavaScript datetime picker -->
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/transition.js') }}"></script>
        <script src="{{ asset('assets/js/collapse.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

        <!-- JavaScript datetime picker -->
        <script src="{{ asset('assets/js/mousetrap.min.js') }}"></script>
        
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="{{ asset('assets/js/ie10-viewport-bug-workaround.js') }}"></script>

        <!-- JavaScript Ubahsuaian -->
        <script>
        // Bootstrap selectpicker https://silviomoreto.github.io/bootstrap-select/
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

        // Konfigurasi Bootstrap Confirmation by Tavicu
        // https://github.com/tavicu/bs-confirmation
        $('[data-toggle="confirmation"]').confirmation();

        // Inisiasi popover bawaan bootstrap
        // Penggunaan: data-toggle="popover" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."
        $(function () {
            $('[data-toggle="popover"]').popover({
                'placement' : 'right',
                'trigger' : 'hover',
                'container' : 'body'
            })
        })

        // Inisiasi datetimepicker
        // https://eonasdan.github.io/bootstrap-datetimepicker
        $(function () {
            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                widgetPositioning: { horizontal: 'right', vertical: 'bottom' }
            });
        });
        </script>

        <script type="text/javascript">
        // Fungsi untuk mengunjungi url
        // Didapat dari https://stackoverflow.com/questions/17571571/making-mousetrap-click-a-link
        function GoToLocation(url)
          {
            //window.location = "http://www.stackoverflow.com";
            window.location = url;
          }

        // Pencegatan menggunakan tombol
        Mousetrap.bind("b e", function() {
            GoToLocation(document.getElementById("home.index").href);
        });

        Mousetrap.bind("t p", function() {
            GoToLocation(document.getElementById("send.create").href);
        });

        Mousetrap.bind("k m", function() {
            GoToLocation(document.getElementById("inbox.index").href);
        });

        Mousetrap.bind("k k", function() {
            GoToLocation(document.getElementById("outbox.index").href);
        });

        Mousetrap.bind("p t", function() {
            GoToLocation(document.getElementById("sentitem.index").href);
        });

        Mousetrap.bind("k o", function() {
            GoToLocation(document.getElementById("contact.index").href);
        });

        Mousetrap.bind("g r", function() {
            GoToLocation(document.getElementById("group.index").href);
        });

        Mousetrap.bind("p e", function() {
            GoToLocation(document.getElementById("confirmation.index").href);
        });

        Mousetrap.bind("d o", function() {
            GoToLocation(document.getElementById("donation.index").href);
        });

        Mousetrap.bind("p s", function() {
            GoToLocation(document.getElementById("psb.index").href);
        });

        Mousetrap.bind("c p", function() {
            GoToLocation(document.getElementById("balance.index").href);
        });

        Mousetrap.bind("p n", function() {
            GoToLocation(document.getElementById("user.index").href);
        });

        Mousetrap.bind("p g", function() {
            GoToLocation(document.getElementById("setting.index").href);
        });

        Mousetrap.bind("k e", function() {
            GoToLocation(document.getElementById("auth.logout").href);
        });

        Mousetrap.bind("ctrl+shift+f", function() {
            document.getElementById("search").focus();
        });
        </script>

        <script type="text/javascript">
        // Script agar ketika klik row, maka otomatis checkbox tercentang
        $(document).ready(function() {
            $('.table tr').click(function(event) {
                if (event.target.type !== 'checkbox') {
                    $(':checkbox', this).trigger('click');
                }
            });
        });
        </script>
    </body>
</html>