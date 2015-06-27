<div class="col-sm-3 col-md-2 sidebar">
    {{-- Bagian Pengaturan --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('home*') ? 'active' : '' }}">
            <a href="{{ route('home.index') }}">
                <span class="glyphicon glyphicon-home"></span>
                Beranda
            </a>
        </li>
    </ul>

    <hr class="hr-nav">

    {{-- Bagian Perpesanan --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('send*') ? 'active' : '' }}">
            <a href="{{ route('send.create') }}">
                <span class="glyphicon glyphicon-file"></span>
                Tulis Pesan
            </a>
        </li>
        <li class="{{ Request::is('inbox*') ? 'active' : '' }}">
            <a href="{{ route('inbox.index') }}">
                <span class="glyphicon glyphicon-envelope"></span>
                Kotak Masuk 
                <span class="badge">
                    {{ \App\Inbox::where('Processed', '=', 'false')->count() }}
                </span>
            </a>
        </li>
{{--         <li class="{{ Request::is('draft*') ? 'active' : '' }}">
            <a href="">
                <span class="glyphicon glyphicon-floppy-disk"></span>
                Draft
            </a>
        </li> --}}
        <li class="{{ Request::is('outbox*') ? 'active' : '' }}">
            <a href="{{ route('outbox.index') }}">
                <span class="glyphicon glyphicon-inbox"></span>
                Kotak Keluar
            </a>
        </li>
        <li class="{{ Request::is('sentitem*') ? 'active' : '' }}">
            <a href="{{ route('sentitem.index') }}">
                <span class="glyphicon glyphicon-saved"></span>
                Pesan Terkirim
            </a>
        </li>
    </ul>

    <hr class="hr-nav">

    {{-- Bagian Kontak --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('contact*') ? 'active' : '' }}">
            <a href="{{ route('contact.index') }}">
                <span class="glyphicon glyphicon-book"></span>
                Kontak
            </a>
        </li>
        <li class="{{ Request::is('group*') ? 'active' : '' }}">
            <a href="{{ route('group.index') }}">
                <span class="glyphicon glyphicon-tags"></span>
                Grup
            </a>
        </li>
    </ul>

    <hr class="hr-nav">

    {{-- Bagian Konfirmasi --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('bayar*') ? 'active' : '' }}">
            <a href="">
                <span class="glyphicon glyphicon-transfer"></span>
                Pembayaran
                <span class="badge">23</span>
            </a>
        </li>
        <li class="{{ Request::is('donasi*') ? 'active' : '' }}">
            <a href="">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                Donasi
                <span class="badge">3</span>
            </a>
        </li>
    </ul>

    <hr class="hr-nav">

    {{-- Bagian Pengaturan --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('balance*') ? 'active' : '' }}">
            <a href="">
                <span class="glyphicon glyphicon-stats"></span>
                Cek Pulsa
            </a>
        </li>
        <li class="{{ Request::is('user*') ? 'active' : '' }}">
            <a href="">
                <span class="glyphicon glyphicon-user"></span>
                Pengguna
            </a>
        </li>
        <li class="{{ Request::is('setting*') ? 'active' : '' }}">
            <a href="">
                <span class="glyphicon glyphicon-wrench"></span>
                Pengaturan
            </a>
        </li>
    </ul>
</div>