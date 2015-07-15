<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Outbox;
use App\Contact;
use App\Group;

use App\Http\Requests\CreateSendRequest;
use App\Http\Requests\ReplySendRequest;
use App\Http\Requests\ForwardSendRequest;

class SendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $contact_options = Contact::orderBy('nama')->lists('nama', 'ponsel');
        $group_options = Group::orderBy('nama')->lists('nama', 'id');

        return view('send.create', compact('contact_options', 'group_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateSendRequest $request)
    {
        // Mendeteksi tujuan pengiriman pesan ke group atau personal
        if ($request->DestinationNumber != '' and $request->group == '') {
            $send = new Outbox;

            $send->TextDecoded = $request->TextDecoded;
            $send->DestinationNumber = $request->DestinationNumber;
            $send->Class = $request->Class;

            $send->save();
        } elseif ($request->DestinationNumber == '' and $request->group != '') {
            
        }

        return redirect()->route('send.create')
            ->with('successMessage', 'Pesan berhasil dikirim')
            ->with($request->flash());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function reply(ReplySendRequest $request)
    {
        $send = new Outbox;

        $send->DestinationNumber = $request->DestinationNumber;
        $send->TextDecoded = $request->TextDecoded;

        $send->save();

        return redirect()->back()
            ->with('successMessage', 'Balasan telah dikirim');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function send($DestinationNumber, $TextDecoded)
    {
        $send = new Outbox;

        $send->DestinationNumber = $DestinationNumber;
        $send->TextDecoded = $TextDecoded;

        $send->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function forward(ForwardSendRequest $request)
    {
        $send = new Outbox;

        $send->DestinationNumber = $request->DestinationNumber;
        $send->TextDecoded = $request->TextDecoded;

        $send->save();

        return redirect()->back()
            ->with('successMessage', 'Pesan terusan telah dikirim');
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
