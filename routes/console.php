<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Services\StockAlertService;
use App\Console\Commands\SendAbandonedCartSms;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    app(StockAlertService::class)->sendAlertEmailIfNeeded();
})
    ->dailyAt('08:00')
    ->name('stock-alert-email')
    ->withoutOverlapping();

/*
|--------------------------------------------------------------------------
| Abandoned Cart SMS
|--------------------------------------------------------------------------
*/

Schedule::command('sms:abandoned-cart')
    ->dailyAt('10:00')
    ->name('abandoned-cart-sms')
    ->withoutOverlapping();