<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\Confirmation;

class ConfirmationController extends Controller
{
    /**
     * Menampilkan daftar data confirmation.
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'tanggal');
        $mode = Input::get('mode', 'desc');
        $status = Input::get('status', '');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $confirmation_all = Confirmation::
              where('status', 'like', "%$status%")
            ->where('santri', 'like', "%$cari%")
            ->where('tanggal', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->paginate(10);

        return view('confirmation.index', compact('confirmation_all', 'sort', 'mode', 'status', 'cari', 'cari_bulan'));
    }

    /**
     * Mengubah status verifikasi data confirmation.
     */
    public function status($id, $status_verifikasi)
    {
        $confirmation = Confirmation::find($id);

        $confirmation->status = $status_verifikasi;

        if ($status_verifikasi == 'Sudah') {

            $statusAlert = 'successMessage';
            $messageAlert = 'Data telah diverifikasi';
            
            $SendController = new SendController;
            $SendController->send('123', $messageAlert);

            $confirmation->save();
        
        } else if ($status_verifikasi == 'Tunda') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Proses verifikasi data ditunda';
            
            $confirmation->save();
        
        } else if ($status_verifikasi == 'Belum') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Verifikasi data dibatalkan';
            
            $confirmation->save();
        
        } else {
        
            $statusAlert = 'dangerMessage';
            $messageAlert = 'Data gagal diproses';

        }

        return redirect()->back()
            ->with($statusAlert, $messageAlert);
    }

    /**
     * Menghapus data confirmation terpilih.
     */
    public function delete($id)
    {
        $confirmation = Confirmation::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Data telah dihapus');
    }
}
