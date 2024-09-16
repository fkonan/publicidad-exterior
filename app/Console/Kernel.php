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

        Commands\Automatizacion::class,
        Commands\Pagos::class,
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {   
        $schedule->command('pagos:realizados')->everyMinute()->timezone('America/Bogota');
        $schedule->command('revision:diaria')->dailyAt('07:00')->timezone('America/Bogota');
        // $schedule->command('revision:diaria')->everyMinute()->timezone('America/Bogota');
        
        // $schedule->command('revision:diaria')->dailyAt('07:46')->timezone('America/Bogota');
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
