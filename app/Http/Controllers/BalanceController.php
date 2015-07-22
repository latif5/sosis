<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    /**
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $balance = [
            'stop'      => exec("sudo /etc/init.d/gammu-smsd stop"),
            'ussd1'     => exec("sudo /usr/bin/gammu getussd *555#"),
            // 'ussd2'     => exec("sudo /usr/bin/gammu getussd *555*1#"),
            // 'ussd3'     => exec("sudo /usr/bin/gammu getussd *555*2#"),
            'start'     => exec("sudo /etc/init.d/gammu-smsd start"),
            'status'    => exec("sudo /etc/init.d/gammu-smsd status")
        ];

        return view('balance.index', compact('balance'));
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
}
