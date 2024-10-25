<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();



Artisan::command('sms', function () {
  // open URL
    exec('xdg-open http://127.0.0.1:8000'); // Linux

    // Fetch the user's IP address
    $ip = request()->ip();

    if (!$ip) {
        $this->error('IP address could not be determined in CLI mode.');
    } else {
        $this->info("Tracking IP Address: $ip");
    }
})->purpose('Open SMS PROJECT and start tracking IP address.');
