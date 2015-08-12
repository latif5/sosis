@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Kotak Masuk <small>SOSIS</small></h1>

@include('inbox._partials.filter')

{{-- Awal form multiple delete --}}
{!! Form::open(['route' => 'inbox.delete.multiple']) !!}
<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="10%">Tanggal</th>
                <th width="15%">Pengirim</th>
                <th width="60%">Isi Pesan</th>
                <th width="5%">Status</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $inbox_all->firstItem() ?>
            @forelse($inbox_all as $inbox)
            <tr>
                <td>
                    {{-- Tombol checkbox multiple delete --}}
                        {!! Form::checkbox('check[]', $inbox->ID) !!}
                        {{ $nomor++ }}.
                </td>
                <td>
                   <small>{{ date('d M Y H:i:s', strtotime($inbox->ReceivingDateTime)) }}</small>
                    <br>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($inbox->ReceivingDateTime)->diffForHumans() }}
                    </small>
                </td>
                <td>
                    <small>{{ $inbox->SenderNumber }}</small>
                    <br>
                    <small>{{ $inbox->nama }}</small>
                </td>
                <td>{{ $inbox->TextDecoded }}</td>
                <td>
                    @if($inbox->Processed == 'true')
                    <span class="label label-success">{{ $inbox->Processed }}</span>
                    @else
                    <span class="label label-danger">{{ $inbox->Processed }}</span>
                    @endif                   
                </td>
                <td>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#" data-toggle="modal" data-target="#modalDetil{{ $inbox->ID }}"><span class="glyphicon glyphicon-eye-open"></span> Detail</a></li>
                            <li class="divider"></li>
                            <li><a href="#" data-toggle="modal" data-target="#modalReply{{ $inbox->ID }}"><span class="glyphicon glyphicon-share-alt"></span> Balas</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modalForward{{ $inbox->ID }}"><span class="glyphicon glyphicon-share"></span> Teruskan</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('inbox.delete', [$inbox->ID]) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @include('inbox._partials.modal_detil')
            @include('inbox._partials.modal_reply')
            @include('inbox._partials.modal_forward')
            @empty
            <tr>
                <td colspan="6">
                    <p>Tidak ada pesan yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $inbox_all->setPath('')->appends(compact('sort', 'mode', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $inbox_all->count() }} dari total {{ $inbox_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
    </p>
</div>
{{-- Tombol multiple delete --}}
<button type="submit" class="btn btn-danger">
    <span class="glyphicon glyphicon-trash"></span> 
    Hapus item terpilih
</button>
{!! Form::close() !!}
{{-- Akhir form multiple delete --}}

@stop