<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\Inbox;

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
     * Mengapus data sms terpilih dari inbox.
     */
    public function delete($id)
    {
        $inbox = Inbox::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Pesan telah dihapus');
    }
}
