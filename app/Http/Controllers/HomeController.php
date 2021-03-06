<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan beranda aplikasi.
     */
    public function index()
    {
        // Hitung data inbox
        $inbox = \App\Inbox::count();
        $inbox_false = \App\Inbox::where('Processed', 'false')->count();

        // Hitung data outbox
        $outbox = \App\Outbox::count();

        // Hitung data sentitem
        $sentitem = \App\SentItem::count();
        $sentitem_sendingok = \App\SentItem::where('Status', 'SendingOK')->count();
        $sentitem_sendingerror = \App\SentItem::where('Status', 'SendingError')->count();

        // Hitung data contact
        $contact = \App\Contact::count();

        // Hitung data group
        $group = \App\Group::count();

        // Hitung data confirmation
        $confirmation = \App\Confirmation::count();
        $confirmation_belum = \App\Confirmation::where('status', 'Belum')->count();
        $confirmation_tunda = \App\Confirmation::where('status', 'Tunda')->count();

        // Hitung data donation
        $donation = \App\Donation::count();
        $donation_belum = \App\Donation::where('status', 'Belum')->count();
        $donation_tunda = \App\Donation::where('status', 'Tunda')->count();

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
            'confirmation_tunda',

            'donation',
            'donation_belum',
            'donation_tunda'
        ));
    }
}
