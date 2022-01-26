<?php

use Illuminate\Support\Facades\{DB, Route};


Route::group(['middleware' => ['web','admin']], function () {
        Route::namespace('DOCore\DOQuot\Http\Controllers\Admin')->prefix('admin/doquot')->group(function () {
                /* Quotations Routes */
                Route::get('/', 'DOQuotController@index')->defaults('_config', ['view' => 'doquot::admin.index'])->name('admin.doquot.index');
                Route::name('admin.doquot')->resource('/quotations', 'QuotationController');
                Route::get('quotations/{quotation}/print-pdf', 'QuotationController@printPDF')->name('quotation.print-pdf');
                Route::patch('/quotations/{quotation}/status', 'QuotationController@updateQuotationStatus')->name('admin.doquot.status.update');

                /* Settings Routes */
                Route::get('/settings', 'SettingsController@index')->name('admin.doquot.settings.index'); 
                Route::post('/settings', 'SettingsController@update')->name('admin.doquot.settings.update');
        });
});