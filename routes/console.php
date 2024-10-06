<?php

use App\Jobs\HandleArticlesGuardianApiJob;
use App\Jobs\HandleArticlesNewsApiJob;
use App\Jobs\HandleArticlesNewYorkTimesApiJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::job(new HandleArticlesNewsApiJob)->hourly()->withoutOverlapping();

Schedule::job(new HandleArticlesGuardianApiJob())->hourly()->withoutOverlapping();

Schedule::job(new HandleArticlesNewYorkTimesApiJob())->hourly()->withoutOverlapping();
