<?php

use App\Http\Controllers\threed\PageController as ThreedPageController;
use App\Http\Controllers\threed\admin\PageController as ThreedAdminPageController;
use App\Http\Controllers\threed\agent\PageController as ThreedAgentPageController;
use App\Http\Controllers\threed\admin\LotteryManagementController as ThreedLotteryManagementController;
use App\Http\Controllers\threed\admin\ReportController as ThreedReportController;
use App\Http\Controllers\threed\admin\UserManagementController as ThreedUserManagementController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'threed', 'prefix' => 'threed', 'as' => 'threed.'], function(){

    Route::post('logout', [ThreedPageController::class, 'logout'])->name('logout');
    Route::get('/', [ThreedPageController::class, 'index'])->name('home');

    Route::get('change-password', [ThreedPageController::class, 'change_password'])->name('change.password');
    Route::post('change-password', [ThreedPageController::class, 'change_password_post'])->name('change.password.post');

    Route::group(['middleware' => 'threed.admin', 'prefix' => 'admin'], function(){
        Route::get('home', [ThreedAdminPageController::class, 'index'])->name('admin.home');

        Route::resource('users', ThreedUserManagementController::class);
        Route::get('reset-password/{user}', [ThreedUserManagementController::class, 'reset_password'])->name('reset.password');

        Route::get('lottery/management', [ThreedLotteryManagementController::class, 'index'])->name('lottery.management.index');
        Route::post('lottery/management', [ThreedLotteryManagementController::class, 'store'])->name('lottery.management.store');

        // Fetch data for editing (Edit)
        Route::get('/lottery-management/{id}/edit', [ThreedLotteryManagementController::class, 'edit'])->name('lottery.management.edit');

        // Update an existing lottery (Update)
        Route::put('/lottery-management/{id}', [ThreedLotteryManagementController::class, 'update'])->name('lottery.management.update');
        Route::delete('/lottery-management/{id}', [ThreedLotteryManagementController::class, 'deleteLottery'])->name('lottery.management.delete');


        Route::get('lottery/report/{id}', [ThreedReportController::class, 'report'])->name('lottery.report');
        Route::get('lottery/report/numbers/{id}', [ThreedReportController::class, 'numberReport'])->name('lottery.report.number');
        Route::get('lottery/report/numbers/lager/{id}', [ThreedReportController::class, 'numberLager'])->name('lottery.report.number.lager');
        Route::get('lottery/report/numbers/lager/{id}/detail/{number}', [ThreedReportController::class, 'numberLagerDetail'])->name('lottery.report.number.lager.detail');
        // Route::post('lottery/report/numbers/lager/head-break/{id}', [ReportController::class, 'headBreak'])->name('lottery.report.number.lager.headBreak');
        Route::get('lottery/report/numbers/lager/head-break/{id}/{price}', [ThreedReportController::class, 'headBreak'])->name('lottery.report.number.lager.headBreak');

        Route::get('lottery/report/numbers/boucher/{id}', [ThreedReportController::class, 'numberBoucher'])->name('lottery.report.number.boucher');
        Route::get('search', [ThreedReportController::class, 'search'])->name('lottery.search');

        Route::delete('lottery/report/numbers/boucher/{id}', [ThreedReportController::class, 'deleteNumberBoucher'])->name('lottery.report.number.boucher.delete');
        Route::get('lottery/report/user-commission/{id}', [ThreedReportController::class, 'userComm'])->name('lottery.report.user.comm');
        Route::get('lottery/report/numbers/hot/{id}', [ThreedReportController::class, 'hotNumber'])->name('lottery.report.number.hot');
        Route::post('lottery/report/numbers/hot/{id}', [ThreedReportController::class, 'hotNumberStore'])->name('lottery.report.number.hot.store');
        Route::delete('lottery/report/numbers/hot/{id}', [ThreedReportController::class, 'deleteHotNumber'])->name('lottery.report.number.hot.delete');

        Route::get('setting', [ThreedAdminPageController::class, 'setting'])->name('admin.setting');
        Route::post('setting/{id}', [ThreedAdminPageController::class, 'change_setting'])->name('admin.setting.change');
        Route::post('delete-all', [ThreedAdminPageController::class, 'deleteAllData'])->name('admin.setting.delete');
    });
    Route::get('lottery/report/numbers/boucher/{id}/{bId}', [ThreedReportController::class, 'numberBoucherDetail'])->name('lottery.report.number.boucher.detail');
    Route::get('/api/numbers/{id}/{userId}', [ThreedReportController::class, 'getNumbersByUser'])->middleware('admin');

    Route::group(['middleware' => 'threed.agent', 'prefix' => 'agent'], function () {
        Route::get('home', [ThreedAgentPageController::class, 'index'])->name('agent.home');
    });

    Route::get('lottery/management/add', [ThreedLotteryManagementController::class, 'addLottery'])->name('lottery.management.add');
    Route::get('lottery/management/create/{id}', [ThreedLotteryManagementController::class, 'createLottery'])->name('lottery.management.create');
    Route::post('lottery/management/add-number', [ThreedLotteryManagementController::class, 'addNumber'])->name('lottery.management.addNumber');
    Route::post('lottery/management/number/update', [ThreedLotteryManagementController::class, 'updateNumber'])->name('lottery.management.number.update');
    Route::get('lottery/management/number/report/{id}', [ThreedLotteryManagementController::class, 'lotteryReport'])->name('lottery.management.number.report');
    Route::get('lottery/management/number-report/{id}', [ThreedLotteryManagementController::class, 'numberReport'])->name('lottery.management.number-report');
    Route::get('lottery/management/boucher-report/{id}', [ThreedLotteryManagementController::class, 'bouncherReport'])->name('lottery.management.boucher-report');
    // Route::post('/store-message', [SessionController::class, 'storeMessage']);
    Route::post('getNumbers', [ThreedLotteryManagementController::class, 'getNumbers'])->name('getNumbers');

    Route::get('getHotNumber/{id}', [ThreedLotteryManagementController::class, 'getHotNumbers'])->name('getHotNumbers');

});




