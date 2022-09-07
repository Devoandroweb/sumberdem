<?php

use App\Http\Controllers\CAdmin;
use App\Http\Controllers\CBerita;
use App\Http\Controllers\CDataTable;
use App\Http\Controllers\CDiagnosis;
use App\Http\Controllers\CFoto;
use App\Http\Controllers\CGalery;
use App\Http\Controllers\Client\CIndex;
use App\Http\Controllers\CLogin;
use App\Http\Controllers\CMenu;
use App\Http\Controllers\CObat;
use App\Http\Controllers\CPages;
use App\Http\Controllers\CPengaduan;
use App\Http\Controllers\CPerangkatDesa;
use App\Http\Controllers\CSaranKritik;
use App\Http\Controllers\CSettingApp;
use App\Http\Controllers\CUser;
use App\Http\Controllers\CVidio;
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

Route::get('/admin',[CLogin::class,'index'])->middleware('guest');
Route::post('/auth',[CLogin::class,'auth']);

Route::middleware(['auth'])->group(function ()
{
    Route::name('admin.')->prefix('/admin')->group(function ()
    {
        Route::get('/home', [CAdmin::class, 'index']);

        Route::resource('foto',CFoto::class)->except('show','edit','update');
        Route::resource('pages',CPages::class);
        Route::resource('kritiksaran',CSaranKritik::class);
        Route::resource('pengguna',CUser::class);
        Route::resource('menu',CMenu::class);
        Route::resource('perangkat_desa',CPerangkatDesa::class);

        Route::get('vidio',[CVidio::class,'index']);
        Route::post('vidio/update',[CVidio::class,'update']);
        
        Route::get('/pengaturan', [CSettingApp::class, 'index']);
        Route::post('/pengaturan-update', [CSettingApp::class, 'saveUpdate']);
        Route::get('/logout', [CLogin::class, 'logout']);
    });
    Route::prefix('/datatable')->group(function ()
    {
        Route::get('/pages', [CDataTable::class, 'pages']);
        Route::get('/kritiksaran', [CDataTable::class, 'kritiksaran']);
        Route::get('/pengguna', [CDataTable::class, 'pengguna']);
        Route::get('/menu', [CDataTable::class, 'menu']);
        Route::get('/perangkat_desa', [CDataTable::class, 'perangkatdesa']);
    });
});
Route::get('/', [CIndex::class, 'index']);
Route::get('/pages/{slug}', [CIndex::class, 'detailPages']);
Route::get('/kritik-saran', [CIndex::class, 'kritiksaran']);
Route::post('/kritik-saran-save', [CIndex::class, 'saveKritik']);
Route::get('/berita', [CBerita::class, 'index']);
Route::get('/perangkatdesa', [CIndex::class, 'perangkatdesa']);