<!-- Awal Modal Balas -->
<div class="modal fade" id="modalDetil{{ $sentitem->ID }}" tabindex="-1" role="dialog" aria-labelledby="myModalDetilLabel{{ $sentitem->ID }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalDetilLabel{{ $sentitem->ID }}">Detil</h4>
            </div>
            <div class="modal-body">
                <blockquote>
                    <p>{{ $sentitem->TextDecoded }}</p>
                    <footer>{{ $sentitem->SenderNumber }} <cite>Contact Name</cite></footer>
                </blockquote>
                <div class="well well-sm">
                    <ul>
                        <li><strong>Tujuan</strong> : {{ $sentitem->DestinationNumber }}</li>
                        <li><strong>Dikirim</strong> : {{ $sentitem->UpdatedInDB }}</li>
                        <li><strong>Dijadwalkan</strong> : {{ $sentitem->SendingDateTime }}</li>
                        <li><strong>Jenis</strong> : {!! $sentitem->Class == '-1' ? 'Biasa' : 'Flash' !!}</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Balas -->