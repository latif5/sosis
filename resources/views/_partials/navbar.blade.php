<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=""><img src="{{ asset('assets/img/oph-logo-dark-small.png') }}" alt="OPH Javanet" style="max-width:78px; margin-top: -7px"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="">Dasbor</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modalTentang">Tentang</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Miftah Afina
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="">Ubah Profil</a></li>
                        <li><a href="">Ubah Kata Sandi</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('home.login') }}"><span class="glyphicon glyphicon-log-out"></span> Keluar</a></li>
                    </ul>
                </li>
            </ul>
            <p class="navbar-text navbar-right">
                <span class="glyphicon glyphicon-calendar"></span> 
                {{ \Carbon\Carbon::now()->format('l, j F Y') . '&nbsp;' }}
            </p>
        </div>
    </div>
</nav>