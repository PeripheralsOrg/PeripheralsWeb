<?php

use App\Models\AdmUsers;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('client.index');
});

Route::get('login/adm', function () {
    return view('admin.index');
});

Route::get('/layout', function () {
    return view('admin.list.listProdutos');
});

Route::get('/insert', function () {
    return view('admin.forms.InsertProduto');
});

Route::get('/adm', function () {
    return view('admin.forms.InsertAdm');
});


Route::get('/factory', function () {
    AdmUsers::factory()->create();
    User::factory()->create();
});

Route::get('/session', function () {
    return session()->all();
});