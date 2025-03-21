<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\CancelUnconfirmedBookings;
use App\Models\Booking;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $pendingBookings = Booking::where('status', 'pending')
        ->where('created_at', '<', Carbon::now()->subMinutes(10))
        ->exists();

    if ($pendingBookings) {
        dispatch(new CancelUnconfirmedBookings());
    }
})->everyMinute();