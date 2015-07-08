<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a login form.
     *
     * @return Response
     */
    public function login()
    {
        return view('guest.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Inbox
        $inbox = \App\Inbox::count();
        $inbox_false = \App\Inbox::where('Processed', 'false')->count();

        // Outbox
        $outbox = \App\Outbox::count();

        // SentItem
        $sentitem = \App\SentItem::count();
        $sentitem_sendingok = \App\SentItem::where('Status', 'SendingOK')->count();
        $sentitem_sendingerror = \App\SentItem::where('Status', 'SendingError')->count();

        // Contact
        $contact = \App\Contact::count();

        // Group
        $group = \App\Group::count();

        // Confirmation
        $confirmation = \App\Confirmation::count();
        $confirmation_belum = \App\Confirmation::where('status', 'Belum')->count();

        // Donation
        $donation = \App\Donation::count();
        $donation_belum = \App\Donation::where('status', 'Belum')->count();

        return view('home.index', compact(
            'inbox',
            'inbox_false',

            'outbox',

            'sentitem',
            'sentitem_sendingok',
            'sentitem_sendingerror',

            'contact',

            'group',

            'confirmation',
            'confirmation_belum',

            'donation',
            'donation_belum'
        ));
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
