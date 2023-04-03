<?php

use App\Models\AdmUsers;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmUsersController;
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
        Route::get('logout', 'logout')->name('auth-sair')->middleware(RedirectIfAuthenticated::class);
        Route::post('login', 'login')->name('auth-entrar')->middleware(RedirectIfNotAuthenticated::class);
    });

    Route::prefix('user')->controller(AdmUsersController::class)->group(function () {
        Route::get('lista', 'all')->name('page-listAdm');
        Route::get('falha', 'fallback')->name('falha-listAdm');
        Route::view('inserir', 'admin.forms.InsertAdm')->name('page-inserirAdm');
        Route::post('register', 'register')->name('post-userAdm')->middleware(RedirectIfAuthenticated::class);
        Route::delete('delete/{id}', 'delete')->name('delete-userAdm')->middleware(RedirectIfAuthenticated::class);
    });

    Route::prefix('produto')->controller(LoginController::class)->group(function () {
        Route::view('inserir', 'admin.forms.InsertProduto')->middleware(RedirectIfAuthenticated::class)->name('page-inserirProduto');
    });

    Route::prefix('relatorios')->controller(LoginController::class)->group(function () {
        Route::view('/', 'admin.list.listRelatorios')->middleware(RedirectIfAuthenticated::class)->name('page-relatorios');
    });

    Route::view('/', 'homepage');
});


Route::get('/', function () {
    return view('client.index');
});



Route::get('/layout', function () {
    return view('admin.list.listProdutos');
});



// Route::get('/adm', function () {
//     return view('admin.forms.InsertAdm');
// });


Route::get('/factory', function () {
    AdmUsers::factory()->create();
    User::factory()->create();
});

Route::get('/session', function () {
    return session()->all();
});

