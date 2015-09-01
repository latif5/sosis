@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Kontak <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Import Kontak</h3>
            </div>
            {!! Form::open(['route' => 'contact.import.post', 'files' => true, 'method' => 'post']) !!}
            <div class="panel-body">
                <label>Data yang akan diimport</label>
                <div class="row">
                    <div class="table">
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th width="8%" class="text-center">No.</th>
                                    <th width="35%">Nama</th>
                                    <th width="25%">Nomor</th>
                                    <th width="27%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1; ?>
                                @forelse($excel as $excel_row)
                                <tr>
                                    <td class="text-center">{{ $nomor++ }}.</td>
                                    <td>{{ $excel_row[0] }}</td>
                                    <td>{{ $excel_row[2] }}</td>
                                    <td>{{ $excel_row[1] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <p>Tidak ada data yang dapat ditampilkan.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">                    
                        <div class="form-group">
                            <label>Grup</label>
                            {!! Form::select('group[]', $group_options, $group_selected, $attributes = ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'multiple', 'data-selected-text-format' => 'count']) !!}
                            {!! $errors->first('group', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                    </div>
                </div> <!-- ./row -->
            </div> {{-- panel-body --}}
                
            <div class="panel-footer">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>

                    <button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-remove-sign"></span> Batal</button>
                </div> {{-- .btn-group --}}
            </div> {{-- .panel-footer --}}
            {!! Form::close() !!}
        </div> {{-- .panel --}}
    </div>
</div>
@stop