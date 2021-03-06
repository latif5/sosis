@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Pengguna <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-2">
        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-plus"></span> 
            Tambahkan
        </a>
    </div>

    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-sort"></span> 
                Urutkan
            </button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('user.index') }}?sort=nama&mode={{ $mode }}&cari={{ $cari }}">Nama</a></li>
                <li><a href="{{ route('user.index') }}?sort=created_at&mode={{ $mode }}&cari={{ $cari }}">Tanggal</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-sort-by-alphabet"></span> 
                Mode
            </button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('user.index') }}?sort={{ $sort }}&mode=asc&cari={{ $cari }}">Asc</a></li>
                <li><a href="{{ route('user.index') }}?sort={{ $sort }}&mode=desc&cari={{ $cari }}">Desc</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        {!! Form::open(['method' => 'get', 'class' => 'form-inline pull-right']) !!}
            {!! Form::hidden('sort', $sort) !!}
            {!! Form::hidden('mode', $mode) !!}
            <div class="form-group">
                {!! Form::text('cari', $cari, ['id' => 'search', 'class' => 'form-control input-sm', 'placeholder' => 'Pencarian...']) !!}
            </div>
            <button type="submit" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-search"></span>
                Cari
            </button>
         {!! Form::close() !!}
    </div>
</div><br>

<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="25%">Nama</th>
                <th width="25%">Username</th>
                <th width="30%">Email</th>
                <th width="10%">Hak</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $user_all->firstItem() ?>
            @forelse($user_all as $user)
            <tr>
                <td>{{ $nomor++ }}.</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->group }}</td>
                <td>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="{{ route('user.edit', [$user->id]) }}"><span class="glyphicon glyphicon-edit"></span> Ubah</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('user.delete', [$user->id]) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <p>Tidak ada data yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $user_all->setPath('')->appends(compact('sort', 'mode', 'cari'))->render() !!}
    <p>
        Menampilkan {{ $user_all->count() }} dari total {{ $user_all->total() }} data <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
    </p>
</div>


@stop