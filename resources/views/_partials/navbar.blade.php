<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=""><img src="{{ asset('assets/img/logo-sosis-small-dark.png') }}" alt="OPH Javanet" style="max-width:78px; margin-top: -7px"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('home.index') }}">Dasbor</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modalTentang">Tentang</a></li>
                {{-- Awal navigasi untuk ponsel --}}
                <li class="nav-divider"></li>
                <li class="visible-xs-block"><a href="{{ route('send.create') }}">Tulis Pesan</a></li>
                <li class="visible-xs-block"><a href="{{ route('inbox.index') }}">Kotak Masuk</a></li>
                <li class="visible-xs-block"><a href="{{ route('outbox.index') }}">Kotak Keluar</a></li>
                <li class="visible-xs-block"><a href="{{ route('sentitem.index') }}">Pesan Terkirim</a></li>

                <li class="nav-divider"></li>
                <li class="visible-xs-block"><a href="{{ route('contact.index') }}">Kontak</a></li>
                <li class="visible-xs-block"><a href="{{ route('group.index') }}">Grup</a></li>

                <li class="nav-divider"></li>
                <li class="visible-xs-block"><a href="{{ route('confirmation.index') }}">Pembayaran</a></li>
                <li class="visible-xs-block"><a href="{{ route('donation.index') }}">Donasi</a></li>

                <li class="nav-divider"></li>
                <li class="visible-xs-block"><a href="{{ route('donation.index') }}">Cek Pulsa</a></li>
                <li class="visible-xs-block"><a href="{{ route('user.index') }}">Pengguna</a></li>
                <li class="visible-xs-block"><a href="{{ route('setting.index') }}">Pengaturan</a></li>

                <li class="nav-divider"></li>
                {{-- Akhir navigasi untuk ponsel --}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>{{ \Auth::user()->nama }} ({{  \Auth::user()->group }}{{--  | {{ \Auth::user()->id }} --}})
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="">Ubah Profil</a></li>
                        <li><a href="{{ route('user.password.edit') }}">Ubah Kata Sandi</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('auth.logout') }}"><span class="glyphicon glyphicon-log-out"></span> Keluar</a></li>
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