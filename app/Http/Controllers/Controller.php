<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Carbon\Carbon;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function __construct() {
        // Set bahasa carbon
        Carbon::setLocale('id');
    }
}
