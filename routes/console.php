<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

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

Artisan::command('1a', function () {
    $input = Storage::disk('local')->get('1/a.txt');
    $result = str($input)
        ->trim()
        ->explode(PHP_EOL)
        ->map(function (string $line) {
            return collect(str_split($line));
        })
        ->map(function (Collection $line) {
            return $line->filter(fn ($char) => is_numeric($char));
        })
        ->map(function (Collection $line) {
            return collect([$line->first(), $line->last()]);
        })
        ->map(fn (Collection $line) => $line->join(''))
        ->map(fn (string $calibrationValue) => (int)$calibrationValue)
        ->sum();

    dd($result);
});

Artisan::command('1b', function () {
    $input = Storage::disk('local')->get('1/a.txt');
    $result = str($input)
        ->trim()
        ->explode(PHP_EOL)
        ->map(function (string $line) {
            return str($line)
                ->replace('one', 'one1one')
                ->replace('two', 'two2two')
                ->replace('three', 'three3three')
                ->replace('four', 'four4four')
                ->replace('five', 'five5five')
                ->replace('six', 'six6six')
                ->replace('seven', 'seven7seven')
                ->replace('eight', 'eight8eight')
                ->replace('nine', 'nine9nine');
        })
        ->map(function (string $line) {
            return collect(str_split($line));
        })
        ->map(function (Collection $line) {
            return $line->filter(fn ($char) => is_numeric($char));
        })
        ->map(function (Collection $line) {
            return collect([$line->first(), $line->last()]);
        })
        ->map(fn (Collection $line) => $line->join(''))
        ->map(fn (string $calibrationValue) => (int)$calibrationValue)
        ->sum();

    dd($result);
});
