<div class="row">
    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <a href="{{ route('contact.create') }}" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-plus"></span> 
                Tambahkan
            </a>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('contact.create') }}">Satuan</a></li>
                <li><a href="{{ route('contact.import') }}">Import</a></li>
            </ul>
        </div>
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
                <li><a href="{{ route('contact.index') }}?sort=nama&mode={{ $mode }}&cari={{ $cari }}">Nama</a></li>
                <li><a href="{{ route('contact.index') }}?sort=created_at&mode={{ $mode }}&cari={{ $cari }}">Tanggal</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-2">
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
                <li><a href="{{ route('contact.index') }}?sort={{ $sort }}&mode=asc&cari={{ $cari }}">Asc</a></li>
                <li><a href="{{ route('contact.index') }}?sort={{ $sort }}&mode=desc&cari={{ $cari }}">Desc</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-export"></span> Ekspor</button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('contact.export', ['xlsx']) }}?sort={{ $sort }}&mode={{ $mode }}&cari={{ $cari }}" target="_blank">Excel</a></li>
                <li><a href="{{ route('contact.export', ['csv']) }}?sort={{ $sort }}&mode={{ $mode }}&cari={{ $cari }}" target="_blank">CSV</a></li>
                <li><a href="{{ route('contact.export', ['pdf']) }}?sort={{ $sort }}&mode={{ $mode }}&cari={{ $cari }}" target="_blank">PDF</a></li>
                <li><a href="{{ route('contact.export.plain') }}?sort={{ $sort }}&mode={{ $mode }}&cari={{ $cari }}" target="_blank">Plain</a></li>
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
