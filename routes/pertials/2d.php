<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\LotteryManagementController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Agent\PageController as AgentPageController;


Route::group([ 'middleware' => 'auth:web'], function () {

    Route::post('logout', [PageController::class,'logout'])->name('logout');
    Route::get('/', [PageController::class, 'index'])->name('home');

    Route::get('change-password', [PageController::class,'change_password'])->name('change.password');
    Route::post('change-password', [PageController::class,'change_password_post'])->name('change.password.post');

    Route::group([ 'middleware' => 'admin' , 'prefix' => 'admin'], function () {
        Route::get('home', [AdminPageController::class, 'index'])->name('admin.home');

        Route::resource('users', UserManagementController::class);
        Route::get('reset-password/{user}', [UserManagementController::class, 'reset_password'])->name('reset.password');

        Route::get('lottery/management', [LotteryManagementController::class, 'index'])->name('lottery.management.index');
        Route::post('lottery/management', [LotteryManagementController::class, 'store'])->name('lottery.management.store');

        // Fetch data for editing (Edit)
        Route::get('/lottery-management/{id}/edit', [LotteryManagementController::class, 'edit'])->name('lottery.management.edit');

        // Update an existing lottery (Update)
        Route::put('/lottery-management/{id}', [LotteryManagementController::class, 'update'])->name('lottery.management.update');
        Route::delete('/lottery-management/{id}', [LotteryManagementController::class, 'deleteLottery'])->name('lottery.management.delete');


        Route::get('lottery/report/{id}', [ReportController::class, 'report'])->name('lottery.report');
        Route::get('lottery/report/numbers/{id}', [ReportController::class, 'numberReport'])->name('lottery.report.number');
        Route::get('lottery/report/numbers/lager/{id}', [ReportController::class, 'numberLager'])->name('lottery.report.number.lager');
        Route::get('lottery/report/numbers/lager/{id}/detail/{number}', [ReportController::class, 'numberLagerDetail'])->name('lottery.report.number.lager.detail');
        // Route::post('lottery/report/numbers/lager/head-break/{id}', [ReportController::class, 'headBreak'])->name('lottery.report.number.lager.headBreak');
        Route::get('lottery/report/numbers/lager/head-break/{id}/{price}', [ReportController::class, 'headBreak'])->name('lottery.report.number.lager.headBreak');

        Route::get('lottery/report/numbers/boucher/{id}', [ReportController::class, 'numberBoucher'])->name('lottery.report.number.boucher');
        Route::get('search', [ReportController::class, 'search'])->name('lottery.search');

        Route::delete('lottery/report/numbers/boucher/{id}', [ReportController::class, 'deleteNumberBoucher'])->name('lottery.report.number.boucher.delete');
        Route::get('lottery/report/user-commission/{id}', [ReportController::class, 'userComm'])->name('lottery.report.user.comm');
        Route::get('lottery/report/numbers/hot/{id}', [ReportController::class, 'hotNumber'])->name('lottery.report.number.hot');
        Route::post('lottery/report/numbers/hot/{id}', [ReportController::class, 'hotNumberStore'])->name('lottery.report.number.hot.store');
        Route::delete('lottery/report/numbers/hot/{id}', [ReportController::class, 'deleteHotNumber'])->name('lottery.report.number.hot.delete');

        Route::get('setting', [AdminPageController::class, 'setting'])->name('admin.setting');
        Route::post('setting/{id}', [AdminPageController::class, 'change_setting'])->name('admin.setting.change');
        Route::post('lottery-time/change', [AdminPageController::class, 'changeLotteryTime'])->name('admin.lottery.change');
        Route::post('delete-all', [AdminPageController::class, 'deleteAllData'])->name('admin.setting.delete');
    });
    Route::get('lottery/report/numbers/boucher/{id}/{bId}', [ReportController::class, 'numberBoucherDetail'])->name('lottery.report.number.boucher.detail');
    Route::get('/api/numbers/{id}/{userId}', [ReportController::class, 'getNumbersByUser'])->middleware('admin');

    Route::group([ 'middleware' => 'agent' , 'prefix' => 'agent'], function () {
        Route::get('home', [AgentPageController::class, 'index'])->name('agent.home');
    });

    Route::get('lottery/management/add', [LotteryManagementController::class, 'addLottery'])->name('lottery.management.add');
    Route::get('lottery/management/create/{id}', [LotteryManagementController::class, 'createLottery'])->name('lottery.management.create');
    Route::post('lottery/management/add-number', [LotteryManagementController::class, 'addNumber'])->name('lottery.management.addNumber');
    Route::post('lottery/management/number/update', [LotteryManagementController::class, 'updateNumber'])->name('lottery.management.number.update');
    Route::get('lottery/management/number/report/{id}', [LotteryManagementController::class, 'lotteryReport'])->name('lottery.management.number.report');
    Route::get('lottery/management/number-report/{id}', [LotteryManagementController::class, 'numberReport'])->name('lottery.management.number-report');
    Route::get('lottery/management/boucher-report/{id}', [LotteryManagementController::class, 'bouncherReport'])->name('lottery.management.boucher-report');
    // Route::post('/store-message', [SessionController::class, 'storeMessage']);
    Route::post('getNumbers', [LotteryManagementController::class, 'getNumbers'])->name('getNumbers');

    Route::get('getHotNumber/{id}', [LotteryManagementController::class, 'getHotNumbers'])->name('getHotNumbers');

});

Route::get('test', function(){
    return checkLotteryTime();
});
