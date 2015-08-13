<?php

namespace App;

use App\Inbox;
use App\Outbox;
use App\SentItem;
use App\Confirmation;
use App\Donation;
use App\Psb;

class BadgeService
{
    /**
     * Menghitung jumlah inbox false
     */
    public function inbox()
    {
        return Inbox::where('Processed', '=', 'false')->count();
    }

    /**
     * Menghitung jumlah Outbox (antrian)
     */
    public function Outbox()
    {
        return Outbox::count();
    }

    /**
     * Menghitung jumlah sentitem tidak terkirim
     */
    public function SentItem()
    {
        return SentItem::where('Status', '=', 'SendingError')->count();
    }

    /**
     * Menghitung jumlah confirmation belum verifikasi
     */
    public function confirmation()
    {
        return Confirmation::where('status', '!=', 'Sudah')->count();
    }

    /**
     * Menghitung jumlah donation belum verifikasi
     */
    public function donation()
    {
        return Donation::where('status', '!=', 'Sudah')->count();
    }

    /**
     * Menghitung jumlah psb belum verifikasi
     */
    public function psb()
    {
        return Psb::where('status', '!=', 'Sudah')->count();
    }
}