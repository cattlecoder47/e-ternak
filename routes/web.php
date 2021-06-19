<?php

use App\Http\Controllers\Api\ReferenceController;
use App\Http\Controllers\DatatablesController;
use App\Http\Livewire\AuthLogin;
use App\Http\Livewire\HomePage;
use App\Http\Livewire\RealisasiKontrak;
use App\Http\Livewire\RInsentif;
use App\Http\Livewire\RJeniskontrak;
use App\Http\Livewire\RJenisProduk;
use App\Http\Livewire\RJinsentif;
use App\Http\Livewire\RJid;
use App\Http\Livewire\RJtrans;
use App\Http\Livewire\RKandang;
use App\Http\Livewire\RKandangCreate;
use App\Http\Livewire\RKandangUpdate;
use App\Http\Livewire\RKondJalan;
use App\Http\Livewire\RPrefix;
use App\Http\Livewire\RProduk;
use App\Http\Livewire\RProdukCreate;
use App\Http\Livewire\RProdukUpdate;
use App\Http\Livewire\RSatuan;
use App\Http\Livewire\RTypeLog;
use App\Http\Livewire\RUnit;
use App\Http\Livewire\SysCustomer;
use App\Http\Livewire\SysCustomerVerification;
use App\Http\Livewire\SysOption;
use App\Http\Livewire\SysRole;
use App\Http\Livewire\SysUser;
use App\Http\Livewire\SysUserDatatables;
use App\Http\Livewire\SysUserLog;
use App\Http\Livewire\TKontrak;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'access.menu'], function () {
    Route::group(['middleware' => 'revalidate'], function () {
        Route::get('/', AuthLogin::class);
        Route::get('/login', AuthLogin::class);
        Route::get('/home', HomePage::class);
    });
    Route::get('/logout', [HomePage::class, 'logout']);


//route referensi
    Route::prefix('referensi')->group(function () {
        Route::get('/role', SysRole::class);
        Route::get('/satuan', RSatuan::class);
        Route::get('/rjinsentif', RJinsentif::class);
        Route::get('/jid', RJid::class);
        Route::get('/typelog', RTypeLog::class);
        Route::get('/jeniskontrak', RJeniskontrak::class);
        Route::get('/jenisproduk', RJenisProduk::class);
        Route::get('/rkondjalan', RKondJalan::class);
    });
//route manajemen pengguna
    Route::prefix('user')->group(function () {
        Route::get('/role', SysRole::class);
        Route::get('/typelog', RTypeLog::class);
        Route::get('/sysuser', SysUser::class);
        Route::get('/sysuserlog', SysUserLog::class);
    });
//route pengaturan aplikasi
    Route::prefix('setting')->group(function () {
        Route::get('/prefix', RPrefix::class);
        Route::get('/option', SysOption::class);
    });
//route master
    Route::prefix('master')->group(function () {
        Route::get('/customer/list_customer', SysCustomer::class);
        Route::get('/customer/verif_customer', SysCustomerVerification::class);
        Route::get('/unit', RUnit::class);
        Route::get('/insentif', RInsentif::class);
        Route::get('/kontrak', TKontrak::class);
        Route::get('/produk', RProduk::class);
        Route::get('/produk/add', RProdukCreate::class);
        Route::get('/produk/edit', RProdukUpdate::class);
        Route::get("/produk/edit/{path}", RProdukUpdate::class)->where('path', '.+');
        Route::get('/kandang', RKandang::class);
        Route::get('/kandang/add', RKandangCreate::class);
        Route::get('/kandang/edit', RKandangUpdate::class);
        Route::get("/kandang/edit/{path}", RKandangUpdate::class)->where('path', '.+');

    });
//route transaksi
    Route::prefix('transaksi')->group(function () {
        Route::get('/realisasiKontrak', RealisasiKontrak::class);
    });

});
Route::prefix('Api')->group(function () {
    // Route Sys Role
    Route::post(config('apicode.apiHandlerAddSysRole'), [ReferenceController::class, 'AddSysRole']);
    Route::put(config('apicode.apiHandlerUpdateSysRole') . '/{id}', [ReferenceController::class, 'UpdateSysRole']);
    Route::delete(config('apicode.apiHandlerDeleteSysRole') . '/{id}', [ReferenceController::class, 'DeleteSysRole']);
    Route::get(config('apicode.apiHandlerGetSysRole'), [ReferenceController::class, 'GetSysRole']);
// Route R Satuan
    Route::post(config('apicode.apiHandlerAddRSatuan'), [ReferenceController::class, 'AddRSatuan']);
    Route::put(config('apicode.apiHandlerUpdateRSatuan') . '/{id}', [ReferenceController::class, 'UpdateRSatuan']);
    Route::delete(config('apicode.apiHandlerDeleteRSatuan') . '/{id}', [ReferenceController::class, 'DeleteRSatuan']);
    Route::get(config('apicode.apiHandlerGetRSatuan'), [ReferenceController::class, 'GetRSatuan']);
// Route R Unit
    Route::post(config('apicode.apiHandlerAddRUnit'), [ReferenceController::class, 'AddRUnit']);
    Route::put(config('apicode.apiHandlerUpdateRUnit') . '/{id}', [ReferenceController::class, 'UpdateRUnit']);
    Route::delete(config('apicode.apiHandlerDeleteRUnit') . '/{id}', [ReferenceController::class, 'DeleteRUnit']);
    Route::get(config('apicode.apiHandlerGetRUnit'), [ReferenceController::class, 'GetRUnit']);
// Route R Jenis Kontrak
    Route::post(config('apicode.apiHandlerAddRJenisKontrak'), [ReferenceController::class, 'AddRJenisKontrak']);
    Route::put(config('apicode.apiHandlerUpdateRJenisKontrak') . '/{id}', [ReferenceController::class, 'UpdateRJenisKontrak']);
    Route::delete(config('apicode.apiHandlerDeleteRJenisKontrak') . '/{id}', [ReferenceController::class, 'DeleteRJenisKontrak']);
    Route::get(config('apicode.apiHandlerGetRJenisKontrak'), [ReferenceController::class, 'GetRJenisKontrak']);
// Route R Type Log
    Route::post(config('apicode.apiHandlerAddRTypeLog'), [ReferenceController::class, 'AddRTypeLog']);
    Route::put(config('apicode.apiHandlerUpdateRTypeLog') . '/{id}', [ReferenceController::class, 'UpdateRTypeLog']);
    Route::delete(config('apicode.apiHandlerDeleteRTypeLog') . '/{id}', [ReferenceController::class, 'DeleteRTypeLog']);
    Route::get(config('apicode.apiHandlerGetRTypeLog'), [ReferenceController::class, 'GetRTypeLog']);
// Route R Jid
    Route::post(config('apicode.apiHandlerAddRJid'), [ReferenceController::class, 'AddRJid']);
    Route::put(config('apicode.apiHandlerUpdateRJid') . '/{id}', [ReferenceController::class, 'UpdateRJid']);
    Route::delete(config('apicode.apiHandlerDeleteRJid') . '/{id}', [ReferenceController::class, 'DeleteRJid']);
    Route::get(config('apicode.apiHandlerGetRJid'), [ReferenceController::class, 'GetRJid']);
// Route R J Insentif
    Route::post(config('apicode.apiHandlerAddRJInsentif'), [ReferenceController::class, 'AddRJInsentif']);
    Route::put(config('apicode.apiHandlerUpdateRJInsentif') . '/{id}', [ReferenceController::class, 'UpdateRJInsentif']);
    Route::delete(config('apicode.apiHandlerDeleteRJInsentif') . '/{id}', [ReferenceController::class, 'DeleteRJInsentif']);
    Route::get(config('apicode.apiHandlerGetRJInsentif'), [ReferenceController::class, 'GetRJInsentif']);
});

