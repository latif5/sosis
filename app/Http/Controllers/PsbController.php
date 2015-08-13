<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use \Excel;

use App\Psb;

use App\Http\Requests\ActionPsbRequest;

class PsbController extends Controller
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
     * Menampilkan daftar data psb.
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'tanggal');
        $mode = Input::get('mode', 'desc');
        $status = Input::get('status', '');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $psb_all = Psb::
              where('status', 'like', "%$status%")
            ->where('santri', 'like', "%$cari%")
            ->where('tanggal', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->paginate(10);

        return view('psb.index', compact('psb_all', 'sort', 'mode', 'status', 'cari', 'cari_bulan'));
    }

    /**
     * Mengubah status verifikasi data psb.
     */
    public function status($id, $status_verifikasi)
    {
        $psb = Psb::findOrFail($id);
        $SendController = new SendController;

        $psb->status = $status_verifikasi;

        // Jika status Sudah
        if ($psb->status == 'Sudah') {

            $statusAlert = 'successMessage';
            $messageAlert = 'Data telah diverifikasi';
            $messageSms = 'Transfer untuk '.$psb->santri.' pd tgl '.$psb->tanggal_kirim.' sejmlh '.$psb->jumlah.' BERHASIL kami verifikasi. Trims.';
            
            $SendController->send($psb->ponsel, $messageSms);

            $psb->save();
        
        // Jika status Tunda
        } else if ($psb->status == 'Tunda') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Proses verifikasi data ditunda';
            $messageSms = 'Maaf, verifikasi transfer untuk '.$psb->santri.' pd tgl '.$psb->tanggal_kirim.' sejmlh '.$psb->jumlah.' TERTUNDA. Trims.';
            
            $SendController->send($psb->ponsel, $messageSms);

            $psb->save();
        
        // Jika status Belum
        } else if ($psb->status == 'Belum') {
        
            $statusAlert = 'infoMessage';
            $messageAlert = 'Verifikasi data dibatalkan';
            $messageSms = 'Maaf, verifikasi transfer untuk '.$psb->santri.' pd tgl '.$psb->tanggal_kirim.' sejmlh '.$psb->jumlah.' DIBATALKAN. Trims.';
            
            $SendController->send($psb->ponsel, $messageSms);

            $psb->save();
        
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

        $psb_all = Psb::
              where('status', 'like', "%$status%")
            ->where('santri', 'like', "%$cari%")
            ->where('tanggal', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        return view('psb.plain', compact('psb_all', 'sort', 'mode', 'status', 'cari', 'cari_bulan'));
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

        $psb_all = Psb::
              where('status', 'like', "%$status%")
            ->where('santri', 'like', "%$cari%")
            ->where('tanggal', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->get();

        Excel::create('Data Inbox', function($excel) use ($sort, $mode, $status, $cari, $cari_bulan, $psb_all){
            $excel->sheet('New sheet', function($sheet) use ($sort, $mode, $status, $cari, $cari_bulan, $psb_all){
                $sheet->loadView('psb.plain', compact('sort', 'mode', 'status', 'cari', 'cari_bulan', 'psb_all'));
                
                $sheet->setOrientation('landscape');
                
            });
        })->export($format);
    }

    /**
     * Menghapus data psb terpilih.
     */
    public function delete($id)
    {
        $psb = Psb::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Data telah dihapus');
    }

    /**
     * Melakukan aksi ke beberapa data terpilih dari psb.
     */
    public function actionMultiple(ActionpsbRequest $request)
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
            // Update status psb
            Psb::whereIn('id', $request->check)->update(['status' => $request->aksi]);

            // Kirim SMS
            $psb_selected = Psb::whereIn('id', $request->check)->get();

            foreach ($psb_selected as $psb) {
                $SendController = new SendController;
            
                // Menentukan isi balasan berdasarkan aksi
                switch ($request->aksi) {
                    case 'Sudah':
                        $messageSms = 'Transfer untuk '.$psb->santri.' pd tgl '.$psb->tanggal_kirim.' sejmlh '.$psb->jumlah.' BERHASIL kami verifikasi. Trims.';
                        break;
                    case 'Tunda':
                        $messageSms = 'Maaf, verifikasi transfer untuk '.$psb->santri.' pd tgl '.$psb->tanggal_kirim.' sejmlh '.$psb->jumlah.' TERTUNDA. Trims.';
                        break;
                    case 'Belum':
                        $messageSms = 'Maaf, verifikasi transfer untuk '.$psb->santri.' pd tgl '.$psb->tanggal_kirim.' sejmlh '.$psb->jumlah.' DIBATALKAN. Trims.';
                        break;
                }

                // Mengirim pesan SMS
                $SendController->send($psb->ponsel, $messageSms);
            }

            $statusAlert = 'successMessage';
            $messageAlert = 'Sebanyak '.count($request->check).' data telah '.$status_aksi;

        // Cek jika ceklist terisi, aksi terisi, dan aksi adalah hapus
        } else if ($request->check != null and $request->aksi != '' and $request->aksi == 'Hapus') {
            // Hapus data psb
            $psb = Psb::destroy($request->check);

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
