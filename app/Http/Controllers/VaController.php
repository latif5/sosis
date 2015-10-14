<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use \Excel;
use \Session;

use App\Confirmation;

use App\Http\Requests\ImportVaRequest;

use \Carbon\Carbon;

class VaController extends Controller
{
    /**
     * Menampilkan form import data konfirmasi dari va.
     */
    public function import()
    {
        return view('va.import');
    }

    /**
     * Menampilkan preview data import konfirmasi dari va.
     */
    public function importPut(ImportVaRequest $request)
    {
        $excel = Excel::load($request->file('data'), function($reader) {
            // Agar tidak menganggap bahwa baris pertama adalah header
            // Serta agar mengubah offset array menjadi numeric, bukan string header
            $reader->noHeading();
        })->get();

        // Session kan data excel
        Session::put('data_va_excel', $excel);

        return view('va.preview', compact('excel'))
            ->with('successMessage', 'Sebanyak '.count($excel).' data konfirmasi akan diimpor');
    }

    /**
     * Memasukkan data import ke tabel confirmation.
     */
    public function importPost()
    {
        $excel = Session::pull('data_va_excel');

        foreach ($excel as $excel_row) {
            // Memasukkan data konfirmasi ke database
            $confirmation = new Confirmation;

            $confirmation->tanggal = Carbon::now()->format('Y-m-d');
            $confirmation->ponsel = !is_null($excel_row[1]) ? $excel_row[1] : '-';
            $confirmation->santri = !is_null($excel_row[2]) ? $excel_row[2] : '-';
            $confirmation->kelas = !is_null($excel_row[3]) ? $excel_row[3] : '-';
            $confirmation->jumlah = !is_null($excel_row[4]) ? $excel_row[4] : '-';
            $confirmation->tanggal_kirim = Carbon::now()->subDay()->format('d-m-Y');
            $confirmation->pengirim = !is_null($excel_row[5]) ? $excel_row[5] : '-';
            $confirmation->keperluan = !is_null($excel_row[6]) ? $excel_row[6] : '-';
            $confirmation->status = 'Belum';

            $confirmation->save();
        }

        return redirect()->route('confirmation.index')
            ->with('successMessage', 'Sebanyak '.count($excel).' data telah diimpor');
    }
}
