<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use \Excel;

use App\Donation;

use App\Http\Requests\DeleteDonationRequest;

class DonationController extends Controller
{
    /**
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $donation = Donation::findOrFail($id);
        $SendController = new SendController;

        $donation->status = $status_verifikasi;

        // Jika status Sudah
        if ($donation->status == 'Sudah') {

            $statusAlert = 'successMessage';
            $messageAlert = 'Data telah diverifikasi';
            $messageSms = 'Transfer utk keperluan '.$donation->keperluan.' pd tgl '.$donation->tanggal_kirim.' sejmlh '.$donation->jumlah.' BERHASIL kami verifikasi. Trims.';
            
            $SendController->send($donation->ponsel, $messageSms);

            $donation->save();
        
        // Jika status Tunda
        } else if ($donation->status == 'Tunda') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Proses verifikasi data ditunda';
            $messageSms = 'Maaf, verifikasi transfer utk keperluan '.$donation->keperluan.' pd tgl '.$donation->tanggal_kirim.' sejmlh '.$donation->jumlah.' TERTUNDA. Trims.';
            
            $SendController->send($donation->ponsel, $messageSms);

            $donation->save();
        
        // Jika status Belum
        } else if ($donation->status == 'Belum') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Verifikasi data dibatalkan';
            $messageSms = 'Maaf, verifikasi transfer utk keperluan '.$donation->keperluan.' pd tgl '.$donation->tanggal_kirim.' sejmlh '.$donation->jumlah.' DIBATALKAN. Trims.';
            
            $SendController->send($donation->ponsel, $messageSms);

            $donation->save();
        
        // Jika status ubahan tidak sesuai
        } else {
        
            $statusAlert = 'dangerMessage';
            $messageAlert = 'Data gagal diproses';

        }

        return redirect()->back()
            ->with($statusAlert, $messageAlert);
    }

    /**
     * Menampilkan daftar sms di inbox dalam bentuk plain.
     */
    public function exportPlain()
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
            ->get();

        return view('donation.plain', compact('donation_all', 'sort', 'mode', 'status', 'cari', 'cari_bulan'));
    }

    /**
     * Menampilkan daftar sms di inbox dalam bentuk format file.
     */
    public function export($format)
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
            ->get();

        Excel::create('Data Inbox', function($excel) use ($sort, $mode, $status, $cari, $cari_bulan, $donation_all){
            $excel->sheet('New sheet', function($sheet) use ($sort, $mode, $status, $cari, $cari_bulan, $donation_all){
                $sheet->loadView('donation.plain', compact('sort', 'mode', 'status', 'cari', 'cari_bulan', 'donation_all'));
                
                $sheet->setOrientation('landscape');
                
            });
        })->export($format);
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

    /**
     * Mengapus beberapa data terpilih dari donation.
     */
    public function deleteMultiple(DeleteDonationRequest $request)
    {
        // Cek jika ceklist terisi
        if ($request->check != null) {
            $donation = Donation::destroy($request->check);

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
