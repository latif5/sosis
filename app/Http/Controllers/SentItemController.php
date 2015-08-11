<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use \Excel;

use App\SentItem;

use App\Http\Requests\DeleteSentItemRequest;

class SentItemController extends Controller
{
    /**
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar sms di sentitem.
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'SendingDateTime');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $sentitem_all = SentItem::
              leftJoin('contact', 'sentitems.DestinationNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('SendingDateTime', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->paginate(7);

        return view('sentitem.index', compact('sentitem_all', 'sort', 'mode', 'cari', 'cari_bulan'));
    }

    /**
     * Menampilkan daftar sms di outbox dalam bentuk plain.
     */
    public function exportPlain()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'SendingDateTime');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $sentitem_all = SentItem::
              leftJoin('contact', 'sentitems.DestinationNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('SendingDateTime', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        return view('sentitem.plain', compact('sentitem_all', 'sort', 'mode', 'cari', 'cari_bulan'));
    }

    /**
     * Menampilkan daftar sms di outbox dalam bentuk format file.
     */
    public function export($format)
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'SendingDateTime');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $sentitem_all = SentItem::
              leftJoin('contact', 'sentitems.DestinationNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('SendingDateTime', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        Excel::create('Data Sent Item', function($excel) use ($sort, $mode, $cari, $cari_bulan, $sentitem_all){
            $excel->sheet('New sheet', function($sheet) use ($sort, $mode, $cari, $cari_bulan, $sentitem_all){
                $sheet->loadView('sentitem.plain', compact('sort', 'mode', 'cari', 'cari_bulan', 'sentitem_all'));
                
                $sheet->setOrientation('landscape');
                
            });
        })->export($format);
    }

    /**
     * Menghapus seluruh data dari sentitem
     */
    public function truncate()
    {
        $sentitem = SentItem::truncate();

        return redirect()->route('sentitem.index')
            ->with('infoMessage', 'Seluruh pesan terkirim dihapus');
    }

    /**
     * Mengapus data sms terpilih dari sentitem.
     */
    public function delete($id)
    {
        $sentitem = SentItem::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Pesan telah dihapus');
    }

    /**
     * Mengapus beberapa data sms terpilih dari sent item.
     */
    public function deleteMultiple(DeleteSentItemRequest $request)
    {
        // Cek jika ceklist terisi
        if ($request->check != null) {
            $sentitem = SentItem::destroy($request->check);

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
