<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Inbox;
use App\Outbox;
use App\Confirmation;
use App\Donation;

class SosisService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sosis:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Service SOSIS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 
    }
}
