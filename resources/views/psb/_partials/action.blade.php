{{-- Awal tombol multiple action --}}
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::select('aksi', [
                'Administrasi' => [
                    'Sudah'         => 'Sudah',
                    'Tunda'         => 'Tunda',
                    'Belum'         => 'Belum'
                ],
                'Lainnya' => [
                    'Hapus'         => 'Hapus',
                    ''              => '-pilih-'
                ]
            ], null, $attributes = ['class' => 'form-control selectpicker']) !!}
            {!! $errors->first('aksi', '<p class="text-danger"><small>:message</small></p>') !!}
            {!! $errors->first('check', '<p class="text-danger"><small>:message</small></p>') !!}
        </div>
    </div>
    <div class="col-md-10">
        <div class="form-group">
            <button type="submit" class="btn btn-danger">
                <span class="glyphicon glyphicon glyphicon-thumbs-up"></span> 
                Aksi
            </button>
        </div>
    </div>
</div>
{{-- Akhir tombol multiple action --}}
