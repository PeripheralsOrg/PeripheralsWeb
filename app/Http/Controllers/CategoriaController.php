<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\ProdutoView;

class CategoriaController extends Controller
{

    private static function changeName($filterName)
    {
        switch ($filterName) {
            case 'select-status':
                return 'status';
                break;
            case 'select-ordem':
                return 'ordem';
                break;
            case 'select-categoria':
                return 'categoria';
                break;
            case 'select-avaliacao':
                return 'avaliacao_media';
                break;
        }
    }

    public static function sendData($produtos)
    {

        if(!Session::has('user')){
            return redirect()->route('auth-sair');
        }

        if (!empty($produtos)) {
            return view('admin.list.listProdutos')->with('produtos', $produtos);
        } else {
            return redirect()->route('falha-listProdutos');
        }
    }


    public function produtoFilterAdmin(Request $request)
    {
        $campoBd = CategoriaController::changeName($request->get('selectName'));
        Session::put("filtro-produto.$campoBd", $request->get('selectValue'));


        $campoSearch = array_keys($request->session()->get('filtro-produto'));
        $valueSearch = array_values($request->session()->get('filtro-produto'));
        $orderQuery = false;


        foreach ($campoSearch as $item) {
            if ($item === 'ordem') {
                $orderQuery = true;
            }
        }

        if ($orderQuery) {
            return (new CategoriaController)->orderProdutoAdmin($campoSearch, $valueSearch);
        } else {
            return (new CategoriaController)->commonFilterAdmin($campoSearch, $valueSearch);
        }


        return redirect()->route('page-listProdutos');
    }

    public function resetFilters(Request $request)
    {
        if ($request->session()->has('filtro-produto')) {
            $request->session()->forget('filtro-produto');
        }
        return redirect()->route('page-listProdutos');
    }


    private function orderProdutoAdmin($campoSearch, $valueSearch)
    {
        $ordemFind = array_search('ordem', $campoSearch);
        $ordemEscolhida = $valueSearch[$ordemFind];

        // dd($valueSearch[$ordemFind]);
        // unset($campoSearch[$ordemFind]);
        // dd(array_values($campoSearch));



        // ORDEM POR PREÇO
        if ($valueSearch[$ordemFind] == 'DESC' || $valueSearch[$ordemFind] == 'ASC') {
            if (count(Session::get('filtro-produto')) === 1) {
                $produtos = ProdutoView::all()->where('status', 1)->toArray();
                if(count($produtos) > 0){
                    $produtos = ProdutoView::all()->where('status', 1)->toQuery();
                    return CategoriaController::sendData($produtos->orderby('preco', $ordemEscolhida)->paginate(10));
                }

                return CategoriaController::sendData($produtos);

            } else if (count(Session::get('filtro-produto')) === 2) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])->toArray();
                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])->toQuery();
                    return CategoriaController::sendData($produtos->orderby('preco', $ordemEscolhida)->paginate(10));
                }

                return CategoriaController::sendData($produtos);

                
            } else if (count(Session::get('filtro-produto')) === 3) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])->toArray();

                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])
                        ->where($campoSearch[1], $valueSearch[1])->toQuery();
                    return CategoriaController::sendData($produtos->orderby('preco', $ordemEscolhida)->paginate(10));
                }

                return CategoriaController::sendData($produtos);
            } else {
                return redirect()->route('page-listProdutos');
            }


            // ORDEM POR QUANTIDADE
        } else {
            if (count(Session::get('filtro-produto')) === 1) {
                $produtos = ProdutoView::all()->toArray();
                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->toQuery();
                    return CategoriaController::sendData($produtos->orderby('quantidade', 'desc')->paginate(10));
                }
                return CategoriaController::sendData($produtos);
            } else if (count(Session::get('filtro-produto')) === 2) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])->toArray();
                if(count($produtos) > 0){
                    $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])->toQuery();
                    return CategoriaController::sendData($produtos->orderby('quantidade', 'desc')->paginate(10));
                }

                return CategoriaController::sendData($produtos);
            } else if (count(Session::get('filtro-produto')) === 3) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])->toArray();

                if(count($produtos) > 0){
                    $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])->toQuery();
                    return CategoriaController::sendData($produtos->orderby('quantidade', 'desc')->paginate(10));

                }

                return CategoriaController::sendData($produtos);
            } else {
                return redirect()->route('page-listProdutos');
            }
        }
    }

    private function commonFilterAdmin($campoSearch, $valueSearch)
    {

        if (count(Session::get('filtro-produto')) === 1) {
            $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])->toArray();
            if (count($produtos) > 0) {
                $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])->toQuery()->paginate(10);
            }
            //! VERIFICAR SE ESTÁ RETORNANDO ALGO
            return CategoriaController::sendData($produtos);
        } else if (count(Session::get('filtro-produto')) === 2) {
            $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])
                ->where($campoSearch[1], $valueSearch[1])->toArray();
            if (count($produtos) > 0) {
                $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])->toQuery()->paginate(10);
            }

            return CategoriaController::sendData($produtos);

        } else if (count(Session::get('filtro-produto')) === 3) {
            $produtos = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])
                ->where($campoSearch[1], $valueSearch[1])
                ->where($campoSearch[2], $valueSearch[2])->toArray();
            if (count($produtos) > 0) {
                $produtos
                    = ProdutoView::all()->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])
                    ->where($campoSearch[2], $valueSearch[2])->toQuery()->paginate(10);
            }
            return CategoriaController::sendData($produtos);
        } else {
            return redirect()->route('page-listProdutos');
        }
    }
}
