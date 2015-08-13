<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\SosisService::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Masukkan kode di bawah ini pada cron
        // * * * * * php /opt/lampp/htdocs/sosis/artisan schedule:run 1>> /dev/null 2>&1

        // Menjalankan perintah sosis:start setiap 1 menit
        $schedule->command('sosis:start')
                 ->everyMinute();
    }
}
