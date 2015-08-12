<div class="row">
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
                <li><a href="{{ route('sentitem.index') }}?sort=SendingDateTime&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Tanggal</a></li>
                <li><a href="{{ route('sentitem.index') }}?sort=Status&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Status</a></li>
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
                <li><a href="{{ route('sentitem.index') }}?sort={{ $sort }}&mode=asc&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Asc</a></li>
                <li><a href="{{ route('sentitem.index') }}?sort={{ $sort }}&mode=desc&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Desc</a></li>
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
                <li><a href="{{ route('sentitem.export', ['xlsx']) }}?sort={{ $sort }}&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}" target="_blank">Excel</a></li>
                <li><a href="{{ route('sentitem.export', ['csv']) }}?sort={{ $sort }}&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}" target="_blank">CSV</a></li>
                <li><a href="{{ route('sentitem.export', ['pdf']) }}?sort={{ $sort }}&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}" target="_blank">PDF</a></li>
                <li><a href="{{ route('sentitem.export.plain') }}?sort={{ $sort }}&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}" target="_blank">Plain</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-1">
        <a href="{{ route('sentitem.truncate') }}" class="btn btn-danger btn-sm" data-toggle="confirmation" data-placement="left">
            <span class="glyphicon glyphicon-ban-circle"></span> 
            Kosongkan
        </a>
    </div>

    <div class="col-md-5">
        {!! Form::open(['method' => 'get', 'class' => 'form-inline pull-right']) !!}
                {!! Form::hidden('sort', $sort) !!}
                {!! Form::hidden('mode', $mode) !!}
            <div class="form-group">
                {!! Form::text('cari', $cari, ['id' => 'search', 'class' => 'form-control input-sm', 'placeholder' => 'Pencarian...']) !!}
                {!! Form::text('cari_bulan', $cari_bulan, ['id' => 'cari_bulan', 'class' => 'form-control input-sm datepicker-month', 'placeholder' => 'Bulan']) !!}
            </div>
            <button type="submit" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-search"></span>
                Cari
            </button>
        {!! Form::close() !!}
    </div>
</div><br>
