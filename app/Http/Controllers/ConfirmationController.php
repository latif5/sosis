<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use \Excel;

use App\Confirmation;

use App\Http\Requests\ActionConfirmationRequest;

class ConfirmationController extends Controller
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

        $confirmation_all = Confirmation::
              where('status', 'like', "%$status%")
            ->where('santri', 'like', "%$cari%")
            ->where('tanggal', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        return view('confirmation.plain', compact('confirmation_all', 'sort', 'mode', 'status', 'cari', 'cari_bulan'));
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

        $confirmation_all = Confirmation::
              where('status', 'like', "%$status%")
            ->where('santri', 'like', "%$cari%")
            ->where('tanggal', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        Excel::create('Data Inbox', function($excel) use ($sort, $mode, $status, $cari, $cari_bulan, $confirmation_all){
            $excel->sheet('New sheet', function($sheet) use ($sort, $mode, $status, $cari, $cari_bulan, $confirmation_all){
                $sheet->loadView('confirmation.plain', compact('sort', 'mode', 'status', 'cari', 'cari_bulan', 'confirmation_all'));
                
                $sheet->setOrientation('landscape');
                
            });
        })->export($format);
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
     * Melakukan aksi ke beberapa data terpilih dari confirmation.
     */
    public function actionMultiple(ActionConfirmationRequest $request)
    {
        switch ($request->aksi) {
            case 'Sudah':
                $status_aksi = 'diverifikasi';
                break;
            case 'Tunda':
                $status_aksi = 'ditunda';
                break;
            case 'Belum':
                $status_aksi = 'dikembalikan';
                break;
            case 'Hapus':
                $status_aksi = 'dihapus';
                break;
        }

        // Cek jika ceklist terisi, aksi terisi, dan aksi bukan hapus
        if ($request->check != null and $request->aksi != '' and $request->aksi != 'Hapus') {
            Confirmation::whereIn('id', $request->check)->update(['status' => $request->aksi]);

            $statusAlert = 'successMessage';
            $messageAlert = 'Sebanyak '.count($request->check).' data telah '.$status_aksi;

        // Cek jika ceklist terisi, aksi terisi, dan aksi adalah hapus
        } else if ($request->check != null and $request->aksi != '' and $request->aksi == 'Hapus') {
            $confirmation = Confirmation::destroy($request->check);

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
