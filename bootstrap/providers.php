<?php

use Illuminate\Support\Facades\Facade;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    App\Providers\JetstreamServiceProvider::class,
    // Barryvdh\DomPDF\ServiceProvider::class,

    // 'aliases' => Facade::defaultAliases()->merge([
    //     'PDF' => Barryvdh\DomPDF\ServiceProvider::class,
    // ]),
];
