<?php

use App\Models\AdmUsers;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmUsersController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use App\Http\Middleware\CheckNotAuthUser;
use App\Http\Middleware\CheckAuthUser;
use App\Http\Controllers\SocialLoginController;

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

// TODO: #27 Fazer uma página inicial com acesso para todos os poderes
// TODO: #37 Checar todos os tratamentos de erro

Route::prefix('adm')->group(function () {
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
        Route::get('pesquisar', 'search')->name('search-adm');
        Route::get('get/{id}', 'getUpdate')->name('get-userAdm')->middleware('guest:9');
        Route::delete('delete/{id}', 'delete')->name('delete-userAdm')->middleware('guest:9');
        Route::patch('update/{id}', 'update')->name('update-userAdm')->middleware('guest:6,8,9');
    });

    Route::prefix('produto')->controller(ProdutoController::class)->middleware('guest:6,8,9')->group(function () {
        Route::get('lista', 'all')->name('page-listProdutos');
        Route::get('inserir', 'getInsert')->name('page-inserirProduto');
        Route::get('falha', 'fallback')->name('falha-listProdutos');
        Route::post('register', 'register')->name('post-produto');
        Route::get('get/{id}', 'getUpdate')->name('get-produto');
        Route::get('pesquisar', 'search')->name('search-produto');
        Route::delete('delete/{id}', 'delete')->name('delete-produto');
        Route::patch('update/{id}', 'update')->name('update-produto');
    });

    Route::prefix('banners')->controller(BannerController::class)->middleware('guest:8,9')->group(function () {
        Route::get('lista', 'all')->name('page-listCarrossel');
        Route::view('inserir', 'admin.forms.InsertBanner')->name('page-inserirBanner');
        Route::post('register', 'register')->name('post-banner');
        Route::get('falha', 'fallback')->name('falha-listBanner');
        Route::get('get/{id}', 'getUpdate')->name('get-banner')->middleware('guest:9');
        Route::delete('delete/{id}', 'delete')->name('delete-banner')->middleware('guest:9');
        Route::patch('update/{id}', 'update')->name('update-banner')->middleware('guest:9');
    });

    Route::prefix('clientes')->controller(LoginController::class)->middleware('guest:7,8,9')->group(function () {
        Route::view('lista', 'admin.list.listClientes')->name('page-listClientes');
    });

    Route::prefix('comentarios')->controller(LoginController::class)->middleware('guest:7,8,9')->group(function () {
        Route::view('lista', 'admin.list.listComentarios')->name('page-listComentarios');
    });

    Route::prefix('cupons')->controller(CupomController::class)->middleware('guest:8,9')->group(function () {
        Route::get('lista', 'all')->name('page-listCupons');
        Route::get('inserir', 'retrieveInfo')->name('page-inserirCupom');
        Route::get('falha', 'fallback')->name('falha-listCupons');
        Route::post('register', 'register')->name('post-cupom');
        Route::get('pesquisar', 'search')->name('search-cupom');
        Route::get('get/{id}', 'getUpdate')->name('get-cupom');
        Route::delete('delete/{id}', 'delete')->name('delete-cupom');
        Route::patch('update/{id}', 'update')->name('update-cupom');
    });

    Route::prefix('menus')->controller(MenuController::class)->middleware('guest:9')->group(function () {
        Route::get('lista', 'all')->name('page-listMenus');
        Route::get('falha', 'fallback')->name('falha-listMenus');

        Route::prefix('menu')->controller(MenuController::class)->middleware('guest:9')->group(function () {
            Route::view('inserir', 'admin.forms.InsertMenu')->name('page-inserirMenu');
            Route::post('register', 'register')->name('post-menu');
            Route::get('get/{id}', 'getUpdate')->name('get-menu');
            Route::delete('delete/{id}', 'delete')->name('delete-menu');
            Route::patch('update/{id}', 'update')->name('update-menu');
        });

        Route::prefix('submenu')->controller(SubmenuController::class)->middleware('guest:9')->group(function () {
            Route::get('inserir', 'getSubmenu')->name('page-getSubmenu');
            Route::post('register', 'register')->name('post-submenu');
            Route::get('get/{id}', 'getUpdate')->name('get-Updatesubmenu');
            Route::delete('delete/{id}', 'delete')->name('delete-submenu');
            Route::patch('update/{id}', 'update')->name('update-submenu');
        });
    });

    Route::prefix('pedidos')->controller(LoginController::class)->middleware('guest:7,8,9')->group(function () {
        Route::view('lista', 'admin.list.listPedidos')->name('page-listPedidos');
    });

    Route::prefix('relatorios')->controller(LoginController::class)->middleware('guest:8,9')->group(function () {
        Route::view('/', 'admin.list.listRelatorios')->name('page-relatorios');
    });

    Route::prefix('config')->controller(ConfigController::class)->middleware('guest:8,9')->group(function () {
        Route::get('/', 'all')->name('page-listConfig');
        Route::get('falha', 'fallback')->name('falha-listConfig');

        //! Categoria
        Route::view('inserir/categoria', 'admin.forms.InsertCategoria')->name('page-inserirCategoria');
        Route::post('register/categoria', 'registerCategoria')->name('post-categoria');
        Route::delete('delete/categoria/{id}', 'deleteCategoria')->name('delete-categoria');
        Route::get('get/categoria/{id}', 'getUpdateCategoria')->name('get-categoria');
        Route::patch('update/categoria/{id}', 'updateCategoria')->name('update-categoria');

        //! Marcas
        Route::view('inserir/marca', 'admin.forms.InsertMarca')->name('page-inserirMarca');
        Route::post('register/marca', 'registerMarca')->name('post-marca');
        Route::delete('delete/marca/{id}', 'deleteMarca')->name('delete-marca');
        Route::get('get/marca/{id}', 'getUpdateMarca')->name('get-marca');
        Route::patch('update/marca/{id}', 'updateMarca')->name('update-marca');
    });
});


// CLIENTE

Route::prefix('filtro')->controller(CategoriaController::class)->group(function () {
    Route::get('admin/filtrar', 'produtoFilterAdmin')->name('produto-filter');
    Route::get('admin/filtro/reset', 'resetFilters')->name('produto-resetFilter');
});



Route::prefix('usuario')->controller(UsersController::class)->group(function () {

    Route::view('/entrar', 'client.login')->name('client-login');

    Route::view('/cadastro', 'client.cadastro')->name('client-cadastro');

    Route::view('/confirmar/cadastro', 'client.confirm-cadastro')->name('client-confirmarCadastro');

    // Rotas Actions
    Route::post('/registro', 'registerUser')->middleware(CheckNotAuthUser::class)->name('register-user');
    Route::post('/login', 'LoginUser')->middleware(CheckNotAuthUser::class)->name('login-user');
    Route::get('/sair', 'logoutUser')->middleware(CheckAuthUser::class)->name('logout-user');

    //! LOGINS SOCIAIS

    Route::controller(SocialLoginController::class)->group(function () {
        // Google
        Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
        Route::get('auth/google/callback', 'handleGoogleCallback');

        // Linkedin
        Route::get('auth/linkedin', 'redirectToLinkedin')->name('auth.linkedin');
        Route::get('auth/linkedin/callback', 'handleLinkedinCallback');
    });

});

Route::prefix('favoritos')->controller(FavoritoController::class)->middleware(CheckAuthUser::class)->group(function () {
    Route::get('lista', 'all')->name('client-favoritos');
    Route::post('favoritar/{idProduto}', 'register')->name('favoritar-produto');
    Route::delete('apagar/{idProduto}', 'delete')->name('desfavoritar-produto');
    Route::get('falha', 'fallback')->name('falha-listFavoritos');
});



Route::get('/', function () {
    return view('client.index');
})->name('client-homepage');

Route::get('/contato', function () {
    return view('client.contato');
})->name('client-contato');

Route::get('/categorias', function () {
    return view('client.categorias');
})->name('client-categorias');

Route::get('/pesquisa', function () {
    return view('client.pesquisa');
})->name('client-pesquisa');

Route::get('/favoritos', function () {
    return view('client.favoritos');
})->middleware(CheckAuthUser::class)->name('client-favoritos');



Route::get('/novo', function () {
    return view('admin.forms.InsertProduto');
});

Route::get('/factory', function () {
    AdmUsers::factory()->create();
    User::factory()->create();
});

Route::get('/session', function () {
    return session()->all();
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
