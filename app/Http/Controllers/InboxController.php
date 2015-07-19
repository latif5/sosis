<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use \Excel;

use App\Inbox;

use App\Http\Requests\DeleteInboxRequest;

class InboxController extends Controller
{
    /**
     * Menampilkan daftar sms di inbox.
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'ReceivingDateTime');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $inbox_all = Inbox::
              leftJoin('contact', 'inbox.SenderNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('ReceivingDateTime', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->paginate(7);

        return view('inbox.index', compact('inbox_all', 'sort', 'mode', 'cari', 'cari_bulan'));
    }

    /**
     * Menampilkan daftar sms di inbox dalam bentuk plain.
     */
    public function exportPlain()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'ReceivingDateTime');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $inbox_all = Inbox::
              leftJoin('contact', 'inbox.SenderNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('ReceivingDateTime', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        return view('inbox.plain', compact('inbox_all', 'sort', 'mode', 'cari', 'cari_bulan'));
    }

    /**
     * Menampilkan daftar sms di inbox dalam bentuk format file.
     */
    public function export($format)
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'ReceivingDateTime');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $inbox_all = Inbox::
              leftJoin('contact', 'inbox.SenderNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('ReceivingDateTime', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        Excel::create('Data Inbox', function($excel) use ($sort, $mode, $cari, $cari_bulan, $inbox_all){
            $excel->sheet('New sheet', function($sheet) use ($sort, $mode, $cari, $cari_bulan, $inbox_all){
                $sheet->loadView('inbox.plain', compact('sort', 'mode', 'cari', 'cari_bulan', 'inbox_all'));
                
                $sheet->setOrientation('landscape');
                
            });
        })->export($format);
    }

    /**
     * Mengapus data sms terpilih dari inbox.
     */
    public function delete($id)
    {
        $inbox = Inbox::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Pesan telah dihapus');
    }

    /**
     * Mengapus beberapa data sms terpilih dari inbox.
     */
    public function deleteMultiple(DeleteInboxRequest $request)
    {
        // Cek jika ceklist terisi
        if ($request->check != null) {
            $inbox = Inbox::destroy($request->check);

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
