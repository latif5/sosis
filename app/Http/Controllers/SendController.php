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
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Menampilkan form pengiriman sms ke group dan ke contact.
     */
    public function create()
    {
        // Ambil data contact dan group, lalu format menjadi list
        $contact_options = Contact::orderBy('nama')->lists('nama', 'ponsel');
        $group_options = Group::orderBy('nama')->lists('nama', 'id');

        return view('send.create', compact('contact_options', 'group_options'));
    }

    /**
     * Mengirim sms ke nomor/group tujuan.
     */
    public function store(CreateSendRequest $request)
    {
        // Mendeteksi tujuan pengiriman pesan ke group atau personal
        // Mengirim pesan ke personal
        if ($request->DestinationNumber != '' and $request->group == '')
        {
            // Mengirim pesan personal satu persatu
            foreach ($request->DestinationNumber as $DestinationNumber) {
                $send = new Outbox([
                    'TextDecoded' => $request->TextDecoded,
                    'DestinationNumber' => $DestinationNumber,
                    'SendingDateTime' => $request->SendingDateTime,
                    'Class' => $request->Class
                ]);

                $send->save();
            }
        }
        // Mengirim pesan ke group
        elseif ($request->DestinationNumber == '' and $request->group != '')
        {
            // Mengirim pesan group satu persatu
            foreach ($request->group as $group) {
                $group_all = Group::findOrFail($group);

                foreach ($group_all->contact as $contact) {
                    $send = new Outbox([
                        'TextDecoded' => $request->TextDecoded,
                        'DestinationNumber' => $contact->ponsel,
                        'SendingDateTime' => $request->SendingDateTime,
                        'Class' => $request->Class
                    ]);

                    $send->save();
                }
            }
        }

        return redirect()->route('send.create')
            ->with('successMessage', 'Pesan berhasil dikirim')
            ->with($request->flash());
    }

    /**
     * Mengirim pesan balasan dari inbox.
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
     * Mengirim pesan balasan tanpa return value.
     */
    public function send($DestinationNumber, $TextDecoded)
    {
        $send = new Outbox;

        $send->DestinationNumber = $DestinationNumber;
        $send->TextDecoded = $TextDecoded;

        $send->save();
    }

    /**
     * Mengirim pesan terusan dari inbox.
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
}
