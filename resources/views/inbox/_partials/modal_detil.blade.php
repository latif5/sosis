<!-- Awal Modal Balas -->
<div class="modal fade" id="modalDetil{{ $inbox->ID }}" tabindex="-1" role="dialog" aria-labelledby="myModalDetilLabel{{ $inbox->ID }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalDetilLabel{{ $inbox->ID }}">Detil</h4>
            </div>
            <div class="modal-body">
                <blockquote>
                    <p>{{ $inbox->TextDecoded }}</p>
                    <footer>{{ $inbox->SenderNumber }} <cite>{{ $inbox->nama }}</cite></footer>
                </blockquote>
                <div class="well well-sm">
                    <ul>
                        <li><strong>Pengirim</strong> : {{ $inbox->SenderNumber }}</li>
                        <li><strong>Nama</strong> : {{ $inbox->nama }}</li>
                        <li><strong>Dikirim</strong> : {{ $inbox->ReceivingDateTime }}</li>
                        <li><strong>Diterima</strong> : {{ $inbox->UpdatedInDB }}</li>
                        <li><strong>SMSC</strong> : {{ $inbox->SMSCNumber }}</li>
                        <li><strong>Status Proses</strong> : {{ $inbox->Processed }}</li>
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