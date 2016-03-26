<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

use SoapClient;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $client = new SoapClient("http://tangostudio.wicp.net:81/TangoStudio/WebServices/BookService.asmx?WSDL");

            $params = array(
                'year' => '2016',
                'month' => '03',
            );

            $result = $client->GetBooksOfMonth($params)->GetBooksOfMonthResult;

            $booked = json_decode($result);

        })->everyMinute();
    }
}
