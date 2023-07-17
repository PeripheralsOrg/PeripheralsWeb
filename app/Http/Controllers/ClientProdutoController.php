<?php

namespace App\Http\Controllers;

use App\Models\AdmBanner;
use App\Models\Avaliacao;
use App\Models\Categoria;
use App\Models\DetalhesProduto;
use App\Models\Marcas;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\ProdutoImagens;
use App\Models\ProdutoInventario;
use App\Models\ProdutoView;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ClientProdutoController extends Controller
{
    public function allProdutos()
    {
        $produtosTest = Produto::all()->where('status', 1)->toArray();
        $categorias = Categoria::all()->toArray();
        $marcas = Marcas::all()->toArray();
        if (count($produtosTest) > 0) {
            $produtos = ProdutoView::all()->where('status', 1)->toQuery()->paginate(10);
            return view('client.pesquisa')->with([
                'produtos' => $produtos,
                'categorias' => $categorias,
                'marcas' => $marcas
            ]);
        }
        return redirect()->route('falha-produtoClient');
    }

    public function getProduto($idProduto)
    {
        $produtosTest = Produto::all()->where('status', 1)->where('id_produtos', $idProduto)->toArray();
        $produtosTest = reset($produtosTest);

        // AVALIACAO INFO
        $getAvaliacao = new AvaliacaoController();
        $avaliacaoPercent = [
            '5' => $getAvaliacao->getPercentStar($idProduto, 5),
            '4' => $getAvaliacao->getPercentStar($idProduto, 4),
            '3' => $getAvaliacao->getPercentStar($idProduto, 3),
            '2' => $getAvaliacao->getPercentStar($idProduto, 2),
            '1' => $getAvaliacao->getPercentStar($idProduto, 1),
        ];

        $avaliacaoCount = $getAvaliacao->getCountAvaliacaoProduto($idProduto);
        $avaliacaoMedia = $getAvaliacao->getMediaAvaliacaoProduto($idProduto);
        $avaliacaoAll = $getAvaliacao->getAllAvaliacaoProduto($idProduto);

        // dd(($avaliacaoPercent));

        $categorias = Categoria::all()->where('id_categoria', $produtosTest['id_categoria'])->toArray();
        $marcas = Marcas::all()->where('id_marca', $produtosTest['id_marca'])->toArray();
        $imgProdutos = ProdutoImagens::all()->where('id_produto', $idProduto)->toArray();
        $quantProduto = ProdutoInventario::all()->where('id_inventario', $produtosTest['id_inventario'])->toArray();
        $detalhesProduto = DetalhesProduto::all()->where('id_detalhes', $produtosTest['id_detalhes'])->toArray();
        $getProdutos1 = ProdutoView::inRandomOrder()->latest()->where('status', 1)->take(5)->get()->toArray();
        $getProdutos2 = ProdutoView::inRandomOrder()->latest()->where('status', 1)->take(5)->get()->toArray();
        // Comentarios

        if (count($produtosTest) > 0) {
            $produtos = ProdutoView::all()->where('status', 1)->where('id_produtos', $idProduto)->toQuery()->paginate(10);
            return view('client.produto')->with([
                'produtos' => $produtos,
                'categorias' => $categorias,
                'marcas' => $marcas,
                'imgProdutos' => $imgProdutos,
                'quantProduto' => $quantProduto,
                'detalhesProduto' => $detalhesProduto,
                'avaliacaoPercent' => $avaliacaoPercent,
                'avaliacaoCount' => $avaliacaoCount,
                'avaliacaoMedia' => $avaliacaoMedia,
                'avaliacaoAll' => $avaliacaoAll,
                'getProdutos1' => $getProdutos1,
                'getProdutos2' => $getProdutos2
            ]);
        }
        return redirect()->back()->withErrors('Ocorreu um erro ao carregar o item!');
    }

    public static function getUserAvaliacao($idUser){
        return array_values(User::all()->where('id', $idUser)->toArray())[0]['email'];
    }

    public static function getAvaliacaoCarrossel($idProduto)
    {
        return (new AvaliacaoController())->getMediaAvaliacaoProduto($idProduto);
    }

    public function fallback()
    {
        $erro = 'Nenhum item foi encontrado!';
        $categorias = Categoria::all()->toArray();
        $marcas = Marcas::all()->toArray();
        return view('client.pesquisa')->with([
            'erro' => $erro,
            'categorias' => $categorias,
            'marcas' => $marcas
        ]);
    }

    private static function changeName($filterName)
    {
        switch ($filterName) {
            case 'select-ordem':
                return 'ordem';
                break;
            case 'select-categoria':
                return 'categoria';
                break;
            case 'select-avaliacao':
                return 'avaliacao_media';
                break;
            case 'select-marca':
                return 'marca';
                break;
        }
    }

    public function resetFiltersAll(Request $request)
    {
        if ($request->session()->has('filtro-produto')) {
            $request->session()->forget('filtro-produto');
        }
        return redirect()->route('produto-pesquisaAll');
    }

    public function maximumValue(Request $request)
    {
        $produtosTest = Produto::all()->where('status', 1)
            ->where('preco', '<=', $request->input('max-value'))->toArray();
        $categorias = Categoria::all()->toArray();
        $marcas = Marcas::all()->toArray();
        if (count($produtosTest) > 0) {
            $produtos = ProdutoView::all()->where('status', 1)
                ->where('preco', '<=', $request->input('max-value'))->toQuery()->paginate(10);
            return view('client.pesquisa')->with([
                'produtos' => $produtos,
                'categorias' => $categorias,
                'marcas' => $marcas
            ]);
        }
        return redirect()->route('falha-produtoClient');
    }


    public function produtoFilterClient(Request $request)
    {
        $campoBd = ClientProdutoController::changeName($request->get('selectName'));
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
            return (new ClientProdutoController)->orderProdutoClient($campoSearch, $valueSearch);
        } else {
            return (new ClientProdutoController)->commonFilterClient($campoSearch, $valueSearch);
        }


        return redirect()->route('produto-pesquisaAll');
    }

    public static function sendData($produtos)
    {

        $categorias = Categoria::all()->toArray();
        $marcas = Marcas::all()->toArray();

        if (!empty($produtos)) {
            return view('client.pesquisa')->with([
                'produtos' => $produtos,
                'categorias' => $categorias,
                'marcas' => $marcas
            ]);
        } else {
            return redirect()->route('falha-produtoClient');
        }
    }


    private function commonFilterClient($campoSearch, $valueSearch)
    {

        if (count(Session::get('filtro-produto')) === 1) {
            $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])->toArray();
            if (count($produtos) > 0) {
                $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])->toQuery()->paginate(10);
            }
            //! VERIFICAR SE ESTÁ RETORNANDO ALGO
            return ClientProdutoController::sendData($produtos);
        } else if (count(Session::get('filtro-produto')) === 2) {
            $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                ->where($campoSearch[1], $valueSearch[1])->toArray();
            if (count($produtos) > 0) {
                $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])->toQuery()->paginate(10);
            }

            return ClientProdutoController::sendData($produtos);
        } else if (count(Session::get('filtro-produto')) === 3) {
            $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                ->where($campoSearch[1], $valueSearch[1])
                ->where($campoSearch[2], $valueSearch[2])->toArray();
            if (count($produtos) > 0) {
                $produtos
                    = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])
                    ->where($campoSearch[2], $valueSearch[2])->toQuery()->paginate(10);
            }
            return ClientProdutoController::sendData($produtos);
        } else {
            return redirect()->route('produto-pesquisaAll');
        }
    }

    public function filterCategoria(Request $request, $categoria)
    {
        $campoBd = ClientProdutoController::changeName($request->get('selectName'));
        if ($request->session()->has('filtro-produto')) {
            $request->session()->forget('filtro-produto');
        }
        Session::put("filtro-produto.categoria", $categoria);

        // dd($request->session());

        $campoSearch = array_keys($request->session()->get('filtro-produto'));
        $valueSearch = array_values($request->session()->get('filtro-produto'));
        $orderQuery = false;

        foreach ($campoSearch as $item) {
            if ($item === 'ordem') {
                $orderQuery = true;
            }
        }

        if ($orderQuery) {
            return (new ClientProdutoController)->orderProdutoClient($campoSearch, $valueSearch);
        } else {
            return (new ClientProdutoController)->commonFilterClient($campoSearch, $valueSearch);
        }


        return redirect()->route('produto-pesquisaAll');
    }


    private function orderProdutoClient($campoSearch, $valueSearch)
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
                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where('status', 1)->toQuery();
                    return ClientProdutoController::sendData($produtos->orderby('preco', $ordemEscolhida)->paginate(10));
                }

                return ClientProdutoController::sendData($produtos);
            } else if (count(Session::get('filtro-produto')) === 2) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])->toArray();
                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])->toQuery();
                    return ClientProdutoController::sendData($produtos->orderby('preco', $ordemEscolhida)->paginate(10));
                }

                return ClientProdutoController::sendData($produtos);
            } else if (count(Session::get('filtro-produto')) === 3) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])->toArray();

                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                        ->where($campoSearch[1], $valueSearch[1])->toQuery();
                    return ClientProdutoController::sendData($produtos->orderby('preco', $ordemEscolhida)->paginate(10));
                }

                return ClientProdutoController::sendData($produtos);
            } else if (count(Session::get('filtro-produto')) === 4) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])->where($campoSearch[2], $valueSearch[2])->toArray();

                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                        ->where($campoSearch[1], $valueSearch[1])->where($campoSearch[2], $valueSearch[2])->toQuery();
                    return ClientProdutoController::sendData($produtos->orderby('preco', $ordemEscolhida)->paginate(10));
                }

                return ClientProdutoController::sendData($produtos);
            } else {
                return redirect()->route('produto-pesquisaAll');
            }


            // ORDEM POR QUANTIDADE
        } else {
            if (count(Session::get('filtro-produto')) === 1) {
                $produtos = ProdutoView::all()->where('status', 1)->toArray();

                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where('status', 1)->toQuery();
                    return ClientProdutoController::sendData($produtos->orderby('quantidade', 'desc')->paginate(10));
                }
                return ClientProdutoController::sendData($produtos);
            } else if (count(Session::get('filtro-produto')) === 2) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])->toArray();

                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])->toQuery();
                    return ClientProdutoController::sendData($produtos->orderby('quantidade', 'desc')->paginate(10));
                }

                return ClientProdutoController::sendData($produtos);
            } else if (count(Session::get('filtro-produto')) === 3) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])->toArray();

                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                        ->where($campoSearch[1], $valueSearch[1])->toQuery();
                    return ClientProdutoController::sendData($produtos->orderby('quantidade', 'desc')->paginate(10));
                }

                return ClientProdutoController::sendData($produtos);
            } else if (count(Session::get('filtro-produto')) === 4) {
                unset($campoSearch[$ordemFind]);
                unset($valueSearch[$ordemFind]);
                $campoSearch = array_values($campoSearch);
                $valueSearch = array_values($valueSearch);

                $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                    ->where($campoSearch[1], $valueSearch[1])
                    ->where($campoSearch[2], $valueSearch[2])->toArray();

                if (count($produtos) > 0) {
                    $produtos = ProdutoView::all()->where('status', 1)->where($campoSearch[0], $valueSearch[0])
                        ->where($campoSearch[1], $valueSearch[1])
                        ->where($campoSearch[2], $valueSearch[2])->toQuery();
                    return ClientProdutoController::sendData($produtos->orderby('quantidade', 'desc')->paginate(10));
                }

                return ClientProdutoController::sendData($produtos);
            } else {
                return redirect()->route('produto-pesquisaAll');
            }
        }
    }

    public function getProdutoCategoria()
    {

        $getCategorias = (Categoria::with('produto')->get()->pluck('categoria', 'id_categoria')->toArray());
        $arrayProdutos = [];

        foreach ($getCategorias as $categoria => $key) {
            $produtosTest = ProdutoView::all()->where('status', 1)->where('categoria', $key)->take(5)->toArray();
            array_push($arrayProdutos, $produtosTest);
        }

        $getCategoriasValues = array_values($getCategorias);
        if (count($arrayProdutos[0]) > 0) {
            // $produtos = ProdutoView::all()->where('status', 1)->toQuery()->paginate(10);
            return view('client.categorias')->with([
                'arrayProdutos' => $arrayProdutos,
                'getCategoriasValues' => $getCategoriasValues
            ]);
        }
        return redirect()->route('falha-produtoClient');
    }


    public function getInfoHomepage()
    {

        $getBanners = AdmBanner::all()->where('status', 1)->toArray();
        $getProdutos1 = ProdutoView::inRandomOrder()->latest()->where('status', 1)->take(5)->get()->toArray();
        $getProdutos2 = ProdutoView::inRandomOrder()->latest()->where('status', 1)->take(5)->get()->toArray();
        $getProdutosCategoria = array_values(ProdutoView::all()->where('status', 1)->where('categoria', 'Teclado')->take(5)->toArray());


        if (count($getProdutos1) > 0) {
            return view('client.index')->with([
                'getProdutos1' => $getProdutos1,
                'getProdutos2' => $getProdutos2,
                'getProdutosCategoria' => $getProdutosCategoria,
                'getBanners' => $getBanners
            ]);
        }
        
        return abort(404);
    }
}
