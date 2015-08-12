<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use \Excel;

use App\Donation;

use App\Http\Requests\ActionDonationRequest;

class DonationController extends Controller
{
    /**
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('keuangan');
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
     * Melakukan aksi ke beberapa data terpilih dari donation.
     */
    public function actionMultiple(ActionDonationRequest $request)
    {
        switch ($request->aksi) {
            case 'Sudah':
                $status_aksi = 'diverifikasi';
                break;
            case 'Tunda':
                $status_aksi = 'ditunda';
                break;
            case 'Belum':
                $status_aksi = 'dibatalkan';
                break;
            case 'Hapus':
                $status_aksi = 'dihapus';
                break;
        }

        // Cek jika ceklist terisi, aksi terisi, dan aksi bukan hapus
        if ($request->check != null and $request->aksi != '' and $request->aksi != 'Hapus') {
            // Update status donation
            Donation::whereIn('id', $request->check)->update(['status' => $request->aksi]);

            // Kirim SMS
            $donation_selected = Donation::whereIn('id', $request->check)->get();

            foreach ($donation_selected as $donation) {
                $SendController = new SendController;
            
                // Menentukan isi balasan berdasarkan aksi
                switch ($request->aksi) {
                    case 'Sudah':
                        $messageSms = 'Transfer utk keperluan '.$donation->keperluan.' pd tgl '.$donation->tanggal_kirim.' sejmlh '.$donation->jumlah.' BERHASIL kami verifikasi. Trims.';
                        break;
                    case 'Tunda':
                        $messageSms = 'Maaf, verifikasi transfer utk keperluan '.$donation->keperluan.' pd tgl '.$donation->tanggal_kirim.' sejmlh '.$donation->jumlah.' TERTUNDA. Trims.';
                        break;
                    case 'Belum':
                        $messageSms = 'Maaf, verifikasi transfer utk keperluan '.$donation->keperluan.' pd tgl '.$donation->tanggal_kirim.' sejmlh '.$donation->jumlah.' DIBATALKAN. Trims.';
                        break;
                }

                // Mengirim pesan SMS
                $SendController->send($donation->ponsel, $messageSms);
            }

            $statusAlert = 'successMessage';
            $messageAlert = 'Sebanyak '.count($request->check).' data telah '.$status_aksi;

        // Cek jika ceklist terisi, aksi terisi, dan aksi adalah hapus
        } else if ($request->check != null and $request->aksi != '' and $request->aksi == 'Hapus') {
            // Hapus data donation
            $donation = Donation::destroy($request->check);

            $statusAlert = 'infoMessage';
            $messageAlert = 'Sebanyak '.count($request->check).' data telah '.$status_aksi;

        // Cek jika ceklist tidak terisi, dan aksi tidak terisi
        } else {
            $statusAlert = 'dangerMessage';
            $messageAlert = 'Tidak ada data terpilih';
        }

        return redirect()->back()
            ->with($statusAlert, $messageAlert);
    }
}
