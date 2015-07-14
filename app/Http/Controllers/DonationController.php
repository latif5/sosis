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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
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
     * Change status of the resource.
     *
     * @return Response
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

        return redirect()->route('donation.index')
            ->with($statusAlert, $messageAlert);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        $donation = Donation::destroy($id);

        return redirect()->route('donation.index')
            ->with('infoMessage', 'Data telah dihapus');
    }
}
