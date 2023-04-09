<?php

use App\Models\AdmUsers;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmUsersController;
use App\Http\Controllers\BannerController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('adm')->group(function(){
    Route::prefix('auth')->controller(LoginController::class)->group(function () {
        Route::view('entrar', 'admin.index')->name('page-login');
        Route::get('logout', 'logout')->name('auth-sair')->middleware('guest:6,7,8,9');
        Route::post('login', 'login')->name('auth-entrar')->middleware(RedirectIfNotAuthenticated::class);
    });

    Route::prefix('user')->controller(AdmUsersController::class)->middleware('guest:8,9')->group(function () {
        Route::get('lista', 'all')->name('page-listAdm');
        Route::get('falha', 'fallback')->name('falha-listAdm');
        Route::view('inserir', 'admin.forms.InsertAdm')->name('page-inserirAdm');
        Route::post('register', 'register')->name('post-userAdm');
        Route::get('get/{id}', 'getUpdate')->name('get-userAdm')->middleware('guest:9');
        Route::delete('delete/{id}', 'delete')->name('delete-userAdm')->middleware('guest:9');
        Route::patch('update/{id}', 'update')->name('update-userAdm')->middleware('guest:9');
    });

    Route::prefix('produto')->controller(LoginController::class)->middleware('guest:6,8,9')->group(function () {
        Route::view('lista', 'admin.list.listProdutos')->name('page-listProdutos');
        Route::view('inserir', 'admin.forms.InsertProduto')->name('page-inserirProduto');
    });

    Route::prefix('banners')->controller(BannerController::class)->middleware('guest:8,9')->group(function () {
        Route::view('lista', 'admin.list.listCarrossel')->name('page-listCarrossel');
        Route::view('inserir', 'admin.forms.InsertBanner')->name('page-inserirBanner');
        Route::post('register', 'register')->name('post-banner');
    });

    Route::prefix('clientes')->controller(LoginController::class)->middleware('guest:7,8,9')->group(function () {
        Route::view('lista', 'admin.list.listClientes')->name('page-listClientes');
    });

    Route::prefix('comentarios')->controller(LoginController::class)->middleware('guest:7,8,9')->group(function () {
        Route::view('lista', 'admin.list.listComentarios')->name('page-listComentarios');
    });

    Route::prefix('cupons')->controller(LoginController::class)->middleware('guest:8,9')->group(function () {
        Route::view('lista', 'admin.list.listCupons')->name('page-listCupons');
    });

    Route::prefix('menus')->controller(LoginController::class)->middleware('guest:9')->group(function () {
        Route::view('lista', 'admin.list.listMenus')->name('page-listMenus');
        Route::view('inserir', 'admin.forms.InsertMenu')->name('page-inserirMenu');
    });

    Route::prefix('pedidos')->controller(LoginController::class)->middleware('guest:7,8,9')->group(function () {
        Route::view('lista', 'admin.list.listPedidos')->name('page-listPedidos');
    });

    Route::prefix('relatorios')->controller(LoginController::class)->middleware('guest:8,9')->group(function () {
        Route::view('/', 'admin.list.listRelatorios')->name('page-relatorios');
    });

});


Route::get('/', function () {
    return view('client.index');
});

Route::get('/factory', function () {
    AdmUsers::factory()->create();
    User::factory()->create();
});

Route::get('/session', function () {
    return session()->all();
});

