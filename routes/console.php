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
            $replacements = [
                'one' => 'one1one',
                'two' => 'two2two',
                'three' => 'three3three',
                'four' => 'four4four',
                'five' => 'five5five',
                'six' => 'six6six',
                'seven' => 'seven7seven',
                'eight' => 'eight8eight',
                'nine' => 'nine9nine',
            ];
            return str($line)->replace(array_keys($replacements), array_values($replacements));
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
