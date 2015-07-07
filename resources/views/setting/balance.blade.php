@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Cek Pulsa <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Cek Pulsa</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="well">
                            <strong>*555#</strong> &raquo; Sisa pulsa anda adalah...
                        </div>
                        <div class="well">
                            <strong>*555*1#</strong> &raquo; Sisa pulsa anda adalah...
                        </div>
                        <div class="well">
                            <strong>*555*2#</strong> &raquo; Sisa pulsa anda adalah...
                        </div>
                        <div class="well">
                            <strong>Status</strong> &raquo; Sisa pulsa anda adalah...
                        </div>
                    </div>
                </div> <!-- ./row -->
            </div> {{-- panel-body --}}
                
            <div class="panel-footer">
                <a href="{{ route('balance') }}" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Muat ulang</a>
            </div> {{-- .panel-footer --}}
        </div> {{-- .panel --}}
    </div>
</div>
@stop