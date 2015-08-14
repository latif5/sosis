@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Pesan Terkirim <small>SOSIS</small></h1>

@include('sentitem._partials.filter')

{{-- Awal form multiple delete --}}
{!! Form::open(['route' => 'sentitem.delete.multiple']) !!}
<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="10%">Tanggal</th>
                <th width="10%">Pengirim</th>
                <th width="60%">Isi Pesan</th>
                <th width="10%">Status</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $sentitem_all->firstItem() ?>
            @forelse($sentitem_all as $sentitem)
            <tr>
                <td>
                    {{-- Tombol checkbox multiple delete --}}
                        {!! Form::checkbox('check[]', $sentitem->ID) !!}
                        {{ $nomor++ }}.
                </td>
                <td>
                    <small>{{ date('d M Y H:i:s', strtotime($sentitem->SendingDateTime)) }}</small>
                    <br>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($sentitem->SendingDateTime)->diffForHumans() }}</small>
                </td>
                <td>
                    <small>{{ $sentitem->DestinationNumber }}</small>
                    <br>
                    <small>{{ $sentitem->nama }}</small>
                </td>
                <td>{{ $sentitem->TextDecoded }}</td>
                <td>
                    @if($sentitem->Status == 'SendingOK')
                    <span class="label label-success">{{ $sentitem->Status }}</span>
                    @else
                    <span class="label label-danger">{{ $sentitem->Status }}</span>
                    @endif  
                </td>
                <td>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#" data-toggle="modal" data-target="#modalDetil{{ $sentitem->ID }}"><span class="glyphicon glyphicon-eye-open"></span> Detail</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('sentitem.resend', [$sentitem->ID]) }}"><span class="glyphicon glyphicon-send"></span> Kirim ulang</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('sentitem.delete', [$sentitem->ID]) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @include('sentitem._partials.modal_detil')
            @empty
            <tr>
                <td colspan="6">
                    <p>Tidak ada pesan yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $sentitem_all->setPath('')->appends(compact('sort', 'mode', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $sentitem_all->count() }} dari total {{ $sentitem_all->total() }} pesan <br>
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