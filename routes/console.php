<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use YooKassa\Client;
use YooKassa\Model\CurrencyCode;
use YooKassa\Model\Payment\ConfirmationType;
use YooKassa\Request\Payments\CreatePaymentRequest;
use Ramsey\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');