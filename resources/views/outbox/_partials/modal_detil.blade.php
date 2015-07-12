<!-- Awal Modal Balas -->
<div class="modal fade" id="modalDetil{{ $outbox->ID }}" tabindex="-1" role="dialog" aria-labelledby="myModalDetilLabel{{ $outbox->ID }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalDetilLabel{{ $outbox->ID }}">Detil</h4>
            </div>
            <div class="modal-body">
                <blockquote>
                    <p>{{ $outbox->TextDecoded }}</p>
                    <footer>{{ $outbox->DestinationNumber }} <cite>Contact Name</cite></footer>
                </blockquote>
                <div class="well well-sm">
                <ul>
                    <li><strong>Tujuan</strong> : {{ $outbox->DestinationNumber }}</li>
                    <li><strong>Dikirim</strong> : {{ $outbox->UpdatedInDB }}</li>
                    <li><strong>Dijadwalkan</strong> : {{ $outbox->SendingDateTime }}</li>
                    <li><strong>Jenis</strong> : {!! $outbox->Class == '-1' ? 'Biasa' : 'Flash' !!}</li>
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