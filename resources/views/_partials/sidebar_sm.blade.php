@inject('badge', '\App\BadgeService')

{{-- Bagian Pengaturan --}}
<ul class="nav nav-sidebar">
    <li class="{{ Request::is('home*') || Request::is('authenticate*') ? 'active' : '' }}">
        <a href="{{ route('home.index') }}" id="home.index">
            <span class="glyphicon glyphicon-lg glyphicon-home"></span>
        </a>
    </li>
</ul>

<hr class="hr-nav">

{{-- Bagian Perpesanan --}}
<ul class="nav nav-sidebar">
    <li class="{{ Request::is('send*') ? 'active' : '' }}">
        <a href="{{ route('send.create') }}" id="send.create">
            <span class="glyphicon glyphicon-lg glyphicon-file"></span>
        </a>
    </li>
    <li class="{{ Request::is('inbox*') ? 'active' : '' }}">
        <a href="{{ route('inbox.index') }}" id="inbox.index">
            <span class="glyphicon glyphicon-lg glyphicon-envelope"></span>
            @if($badge->inbox() != 0)
            <span class="badge">
                {{ $badge->inbox() }}
            </span>
            @endif
        </a>
    </li>
{{--         <li class="{{ Request::is('draft*') ? 'active' : '' }}">
        <a href="">
            <span class="glyphicon glyphicon-lg glyphicon-floppy-disk"></span>
            Draft
        </a>
    </li> --}}
    <li class="{{ Request::is('outbox*') ? 'active' : '' }}">
        <a href="{{ route('outbox.index') }}" id="outbox.index">
            <span class="glyphicon glyphicon-lg glyphicon-inbox"></span>
            @if($badge->outbox() != 0)
            <span class="badge">
                {{ $badge->outbox() }}
            </span>
            @endif
        </a>
    </li>
    <li class="{{ Request::is('sentitem*') ? 'active' : '' }}">
        <a href="{{ route('sentitem.index') }}" id="sentitem.index">
            <span class="glyphicon glyphicon-lg glyphicon-saved"></span>
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
            <span class="glyphicon glyphicon-lg glyphicon-book"></span>
        </a>
    </li>
    <li class="{{ Request::is('group*') ? 'active' : '' }}">
        <a href="{{ route('group.index') }}" id="group.index">
            <span class="glyphicon glyphicon-lg glyphicon-tags"></span>
        </a>
    </li>
</ul>

<hr class="hr-nav">

{{-- Bagian Konfirmasi --}}
<ul class="nav nav-sidebar">
    <li class="{{ Request::is('confirmation*') ? 'active' : '' }}">
        <a href="{{ route('confirmation.index') }}" id="confirmation.index">
            <span class="glyphicon glyphicon-lg glyphicon-transfer"></span>
            @if($badge->confirmation() != 0)
            <span class="badge">
                {{ $badge->confirmation() }}
            </span>
            @endif
        </a>
    </li>
    <li class="{{ Request::is('donation*') ? 'active' : '' }}">
        <a href="{{ route('donation.index') }}" id="donation.index">
            <span class="glyphicon glyphicon-lg glyphicon-thumbs-up"></span>
            @if($badge->donation() != 0)
            <span class="badge">
                {{ $badge->donation() }}
            </span>
            @endif
        </a>
    </li>
    <li class="{{ Request::is('psb*') ? 'active' : '' }}">
        <a href="{{ route('psb.index') }}" id="psb.index">
            <span class="glyphicon glyphicon-lg glyphicon glyphicon-grain"></span>
            @if($badge->psb() != 0)
            <span class="badge">
                {{ $badge->psb() }}
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
            <span class="glyphicon glyphicon-lg glyphicon-stats"></span>
        </a>
    </li>
    <li class="{{ Request::is('user*') ? 'active' : '' }}">
        <a href="{{ route('user.index') }}" id="user.index">
            <span class="glyphicon glyphicon-lg glyphicon-user"></span>
        </a>
    </li>
    <li class="{{ Request::is('setting*') ? 'active' : '' }}">
        <a href="{{ route('setting.index') }}" id="setting.index">
            <span class="glyphicon glyphicon-lg glyphicon-wrench"></span>
        </a>
    </li>
</ul>