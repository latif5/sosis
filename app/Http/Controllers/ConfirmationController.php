<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\Confirmation;

use App\Http\Requests\DeleteConfirmationRequest;

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
        $confirmation = Confirmation::findOrFail($id);
        $SendController = new SendController;

        $confirmation->status = $status_verifikasi;

        // Jika status Sudah
        if ($confirmation->status == 'Sudah') {

            $statusAlert = 'successMessage';
            $messageAlert = 'Data telah diverifikasi';
            $messageSms = 'Transfer untuk '.$confirmation->santri.' pd tgl '.$confirmation->tanggal_kirim.' sejmlh '.$confirmation->jumlah.' BERHASIL kami verifikasi. Trims.';
            
            $SendController->send($confirmation->ponsel, $messageSms);

            $confirmation->save();
        
        // Jika status Tunda
        } else if ($confirmation->status == 'Tunda') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Proses verifikasi data ditunda';
            $messageSms = 'Maaf, verifikasi transfer untuk '.$confirmation->santri.' pd tgl '.$confirmation->tanggal_kirim.' sejmlh '.$confirmation->jumlah.' TERTUNDA. Trims.';
            
            $SendController->send($confirmation->ponsel, $messageSms);

            $confirmation->save();
        
        // Jika status Belum
        } else if ($confirmation->status == 'Belum') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Verifikasi data dibatalkan';
            $messageSms = 'Maaf, verifikasi transfer untuk '.$confirmation->santri.' pd tgl '.$confirmation->tanggal_kirim.' sejmlh '.$confirmation->jumlah.' DIBATALKAN. Trims.';
            
            $SendController->send($confirmation->ponsel, $messageSms);

            $confirmation->save();
        
        // Jika status ubahan tidak sesuai
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

    /**
     * Mengapus beberapa data terpilih dari confirmation.
     */
    public function deleteMultiple(DeleteConfirmationRequest $request)
    {
        // Cek jika ceklist terisi
        if ($request->check != null) {
            $confirmation = Confirmation::destroy($request->check);

            $statusAlert = 'infoMessage';
            $messageAlert = 'Sebanyak '.count($request->check).' data telah dihapus';
        } else {
            $statusAlert = 'dangerMessage';
            $messageAlert = 'Tidak ada data terpilih';
        }

        return redirect()->back()
            ->with($statusAlert, $messageAlert);
    }
}
