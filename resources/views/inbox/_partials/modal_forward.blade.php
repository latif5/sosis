<!-- Awal Modal Balas -->
<div class="modal fade" id="modalForward{{ $inbox->ID }}" tabindex="-1" role="dialog" aria-labelledby="myModForwardLabel{{ $inbox->ID }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModForwardLabel{{ $inbox->ID }}">Teruskan</h4>
            </div>
            <div class="modal-body">
                {!! Form::open() !!}
                    <div class="form-group">
                        <label>Tujuan</label>
                        {!! Form::text('DestinationNumber', null, $attributes = ['class' => 'form-control', 'placeholder' => '62...']) !!}
                        {!! $errors->first('DestinationNumber', '<p class="text-danger"><small>:message</small></p>') !!}
                    </div>

                    <div class="form-group">
                        <label>Pesan</label>
                        {!! Form::textarea('TextDecoded', $inbox->TextDecoded.' dari: '.$inbox->SenderNumber, $attributes = ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Ketik balasan di sini...']) !!}
                        {!! $errors->first('TextDecoded', '<p class="text-danger"><small>:message</small></p>') !!}
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Kirim</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Balas -->