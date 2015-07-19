<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\Outbox;

use App\Http\Requests\DeleteOutboxRequest;

class OutboxController extends Controller
{
    /**
     * Menampilkan daftar sms di outbox.
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'UpdatedInDB');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $outbox_all = Outbox::
              leftJoin('contact', 'outbox.DestinationNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('UpdatedInDB', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->paginate(7);

        return view('outbox.index', compact('outbox_all', 'sort', 'mode', 'cari', 'cari_bulan'));
    }

    /**
     * Menampilkan daftar sms di outbox dalam bentuk plain.
     */
    public function exportPlain()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'UpdatedInDB');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $outbox_all = Outbox::
              leftJoin('contact', 'outbox.DestinationNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('UpdatedInDB', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        return view('outbox.plain', compact('outbox_all', 'sort', 'mode', 'cari', 'cari_bulan'));
    }

    /**
     * Menampilkan daftar sms di outbox dalam bentuk format file.
     */
    public function export($format)
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'UpdatedInDB');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $outbox_all = Outbox::
              leftJoin('contact', 'outbox.DestinationNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('UpdatedInDB', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        Excel::create('Data Sent Item', function($excel) use ($sort, $mode, $cari, $cari_bulan, $outbox_all){
            $excel->sheet('New sheet', function($sheet) use ($sort, $mode, $cari, $cari_bulan, $outbox_all){
                $sheet->loadView('outbox.plain', compact('sort', 'mode', 'cari', 'cari_bulan', 'outbox_all'));
                
                $sheet->setOrientation('landscape');
                
            });
        })->export($format);
    }

    /**
     * Menghapus seluruh data dari outbox, dengan kata lain
     * membatalkan seluruh antrean pengiriman pesan
     */
    public function truncate()
    {
        $outbox = Outbox::truncate();

        return redirect()->route('outbox.index')
            ->with('infoMessage', 'Seluruh pengiriman pesan telah dibatalkan');
    }

    /**
     * Mengapus data sms terpilih dari outbox.
     */
    public function delete($id)
    {
        $outbox = Outbox::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Pesan telah dibatalkan');
    }

    /**
     * Mengapus beberapa data sms terpilih dari inbox.
     */
    public function deleteMultiple(DeleteOutboxRequest $request)
    {
        // Cek jika ceklist terisi
        if ($request->check != null) {
            $outbox = Outbox::destroy($request->check);

            $statusAlert = 'infoMessage';
            $messageAlert = 'Sebanyak '.count($request->check).' pesan telah dihapus';
        } else {
            $statusAlert = 'dangerMessage';
            $messageAlert = 'Tidak ada data terpilih';
        }

        return redirect()->back()
            ->with($statusAlert, $messageAlert);
    }
}
