@inject('badge', '\App\BadgeService')

<div class="col-sm-3 col-md-2 sidebar">
    {{-- Bagian Pengaturan --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('home*') || Request::is('authenticate*') ? 'active' : '' }}">
            <a href="{{ route('home.index') }}" id="home.index">
                <span class="glyphicon glyphicon-home"></span>
                <u>Be</u>randa
            </a>
        </li>
    </ul>

    <hr class="hr-nav">

    {{-- Bagian Perpesanan --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('send*') ? 'active' : '' }}">
            <a href="{{ route('send.create') }}" id="send.create">
                <span class="glyphicon glyphicon-file"></span>
                <u>T</u>ulis <u>P</u>esan
            </a>
        </li>
        <li class="{{ Request::is('inbox*') ? 'active' : '' }}">
            <a href="{{ route('inbox.index') }}" id="inbox.index">
                <span class="glyphicon glyphicon-envelope"></span>
                <u>K</u>otak <u>M</u>asuk 
                @if($badge->inbox() != 0)
                <span class="badge">
                    {{ $badge->inbox() }}
                </span>
                @endif
            </a>
        </li>
{{--         <li class="{{ Request::is('draft*') ? 'active' : '' }}">
            <a href="">
                <span class="glyphicon glyphicon-floppy-disk"></span>
                Draft
            </a>
        </li> --}}
        <li class="{{ Request::is('outbox*') ? 'active' : '' }}">
            <a href="{{ route('outbox.index') }}" id="outbox.index">
                <span class="glyphicon glyphicon-inbox"></span>
                <u>K</u>otak <u>K</u>eluar
                @if($badge->outbox() != 0)
                <span class="badge">
                    {{ $badge->outbox() }}
                </span>
                @endif
            </a>
        </li>
        <li class="{{ Request::is('sentitem*') ? 'active' : '' }}">
            <a href="{{ route('sentitem.index') }}" id="sentitem.index">
                <span class="glyphicon glyphicon-saved"></span>
                <u>P</u>esan <u>T</u>erkirim
                @if($badge->sentitem() != 0)
                <span class="badge">
                    {{ $badge->sentitem() }}
                </span>
                @endif
            </a>
        </li>
    </ul>

    <hr class="hr-nav">

    {{-- Bagian Kontak --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('contact*') ? 'active' : '' }}">
            <a href="{{ route('contact.index') }}"  id="contact.index">
                <span class="glyphicon glyphicon-book"></span>
                <u>Ko</u>ntak
            </a>
        </li>
        <li class="{{ Request::is('group*') ? 'active' : '' }}">
            <a href="{{ route('group.index') }}" id="group.index">
                <span class="glyphicon glyphicon-tags"></span>
                <u>Gr</u>up
            </a>
        </li>
    </ul>

    <hr class="hr-nav">

    {{-- Bagian Konfirmasi --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('confirmation*') ? 'active' : '' }}">
            <a href="{{ route('confirmation.index') }}" id="confirmation.index">
                <span class="glyphicon glyphicon-transfer"></span>
                <u>Pe</u>mbayaran
                @if($badge->confirmation() != 0)
                <span class="badge">
                    {{ $badge->confirmation() }}
                </span>
                @endif
            </a>
        </li>
        <li class="{{ Request::is('donation*') ? 'active' : '' }}">
            <a href="{{ route('donation.index') }}" id="donation.index">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                <u>Do</u>nasi
                @if($badge->donation() != 0)
                <span class="badge">
                    {{ $badge->donation() }}
                </span>
                @endif
            </a>
        </li>
    </ul>

    <hr class="hr-nav">

    {{-- Bagian Pengaturan --}}
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('balance*') ? 'active' : '' }}">
            <a href="{{ route('balance.index') }}" id="balance.index">
                <span class="glyphicon glyphicon-stats"></span>
                <u>C</u>ek <u>P</u>ulsa
            </a>
        </li>
        <li class="{{ Request::is('user*') ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" id="user.index">
                <span class="glyphicon glyphicon-user"></span>
                <u>P</u>e<u>n</u>gguna
            </a>
        </li>
        <li class="{{ Request::is('setting*') ? 'active' : '' }}">
            <a href="{{ route('setting.index') }}" id="setting.index">
                <span class="glyphicon glyphicon-wrench"></span>
                <u>P</u>en<u>g</u>aturan
            </a>
        </li>
    </ul>
</div>