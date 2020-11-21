<?php
Route::prefix('api/v1')
    ->namespace('PlanetaDelEste\ApiMartinForms\Controllers\Api')
    ->middleware('api')
    ->group(
        function () {
            Route::prefix('forms')
                ->name('forms.')
                ->group(
                    function () {
                        Route::post('send', 'Records@send')->name('records.send');
                    }
                );
        }
    );
