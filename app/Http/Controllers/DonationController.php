<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\Donation;

class DonationController extends Controller
{
    /**
     * Menampilkan daftar data donation.
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'tanggal');
        $mode = Input::get('mode', 'desc');
        $status = Input::get('status', '');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $donation_all = Donation::
              where('status', 'like', "%$status%")
            ->where('pengirim', 'like', "%$cari%")
            ->where('tanggal', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->paginate(10);

        return view('donation.index', compact('donation_all', 'sort', 'mode', 'status', 'cari', 'cari_bulan'));
    }

    /**
     * Mengubah status verifikasi data donation.
     */
    public function status($id, $status_verifikasi)
    {
        $donation = Donation::find($id);

        $donation->status = $status_verifikasi;

        if ($status_verifikasi == 'Sudah') {

            $statusAlert = 'successMessage';
            $messageAlert = 'Data telah diverifikasi';

            $donation->save();
        
        } else if ($status_verifikasi == 'Tunda') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Proses verifikasi data ditunda';
            
            $donation->save();
        
        } else if ($status_verifikasi == 'Belum') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Verifikasi data dibatalkan';
            
            $donation->save();
        
        } else {
        
            $statusAlert = 'dangerMessage';
            $messageAlert = 'Data gagal diproses';

        }

        return redirect()->back()
            ->with($statusAlert, $messageAlert);
    }

    /**
     * Menghapus data donation terpilih.
     */
    public function delete($id)
    {
        $donation = Donation::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Data telah dihapus');
    }
}
