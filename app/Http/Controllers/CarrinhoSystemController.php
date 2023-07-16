<?php

namespace App\Http\Controllers;

use App\Models\CarrinhoCompras;
use App\Models\Cupom;
use App\Models\Marcas;
use App\Models\Produto;
use App\Models\ProdutoCarrinho;
use App\Models\ProdutoImagens;
use App\Models\ProdutoInventario;
use Illuminate\Http\Request;

class CarrinhoSystemController extends Controller
{
    public function addProduto(Request $request, $idProduto)
    {

        $idUser = $request->session()->get('user')['id'];
        $checkCarrinho = CarrinhoCompras::all()->where('id_users', $idUser)->where('status', 1)->toArray();

        if (count($checkCarrinho) > 0) {
            $idCarrinho = array_values(CarrinhoCompras::all()->where('id_users', $idUser)->where('status', 1)->toArray())[0]['id_carrinho'];
            $atualizarCarrinho = (new CarrinhoComprasController())->updateCarrinhoSoma($idCarrinho, $idProduto, $request->input('quantidade', 1));
            if (!$atualizarCarrinho) {
                return redirect()->back()->withErrors('Ocorreu um erro ao adicionar o produto no carrinho de compras!');
            } else {
                return redirect()->route('carrinho-all');
            }
        } else {
            // Criar carrinho
            $createCarrinho = (new CarrinhoComprasController())->createCarrinho($idProduto, $request->input('quantidade', 1), $idUser);
            if (!$createCarrinho) {
                return redirect()->back()->withErrors('Ocorreu um erro ao adicionar o produto no carrinho de compras!');
            }

            // Adicionando produto
            $createProdutoCarrinho = (new ProdutoCarrinhoController())->insertProduto($idProduto, $request->input('quantidade', 1), $createCarrinho);
            if (!$createProdutoCarrinho) {
                $deleteCarrinho = (new CarrinhoComprasController())->deleteCarrinho($createCarrinho);
                return redirect()->back()->withErrors('Ocorreu um erro ao adicionar o produto no carrinho de compras!');
            }

            return redirect()->route('carrinho-all');
        }
    }

    public function removeItem($idProduto, $idCarrinho)
    {
        $deletarProduto = (new ProdutoCarrinhoController())->deleteItem($idProduto, $idCarrinho);
        if (!$deletarProduto) {
            return redirect()->back()->withErrors('Ocorreu um erro ao apagar o produto no carrinho de compras!');
        } else {
            $updateCarrinho = (new CarrinhoComprasController())->atualizarCarrinhoCompras($idCarrinho);
            return redirect()->back()->withErrors('Produto apagado com sucesso!');
        }
    }


    public function updateProduto(Request $request, $idProduto, $idCarrinho)
    {
        $request->validate([
            'quantidade' => ['required']
        ]);

        $changeQuantidade = (new ProdutoCarrinhoController())->UpdateProdutoAll($idProduto, $request->quantidade, $idCarrinho);
        if (!$changeQuantidade) {
            return redirect()->back()->withErrors('Ocorreu um erro ao atualizar o produto no carrinho de compras!');
        }

        $atualizarCarrinho = (new CarrinhoComprasController())->atualizarCarrinhoCompras($idCarrinho);
        return redirect()->back()->withErrors('Produto atualizado com sucesso!');
    }

    public function cupomProduto(Request $request, $idCarrinho)
    {
        $request->validate([
            'cupom' => ['required']
        ]);

        $getCupom = Cupom::all()->where('codigo', $request->cupom)->where('status', 1)->toArray();
        if (count($getCupom) <= 0) {
            return redirect()->back()->withErrors('Nenhum cupom foi encontrado!');
        }

        $getTipo = array_values($getCupom)[0]['tipo'];

        // CATEGORIA
        if ($getTipo == 'categoria') {
            $getCategoria = array_values($getCupom)[0]['id_categoria'];
            $getAllProdutos = array_values(ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray());
            $checkProd = false;

            foreach ($getAllProdutos as $produto) {
                $getProduto = array_values(Produto::all()->where('id_produtos', $produto['id_produto'])
                    ->where('status', 1)->toArray())[0]['id_categoria'];

                if ($getCategoria == $getProduto) {
                    $checkProd = true;
                }
            }


            if ($checkProd) {

                foreach ($getAllProdutos as $produto) {
                    // array_push($getDesconto, ($produto['valor_total'] * (array_values($getCupom)[0]['porcentagem'] / 100)));
                    // array_push($getValorFinal, $produto['valor_total'] - ($produto['valor_total'] 
                    // * (array_values($getCupom)[0]['porcentagem'] / 100)));

                    $updateProduto = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)
                        ->where('id_produto', $produto['id_produto'])->toQuery();


                    if ($updateProduto->getModel()->getAttributes()['valor_desconto'] == '0.00') {
                        $updateProduto->update([
                            'valor_total' => $produto['valor_total'] - ($produto['valor_total'] * (array_values($getCupom)[0]['porcentagem'] / 100)),
                            'valor_desconto' => $produto['valor_total'] * (array_values($getCupom)[0]['porcentagem'] / 100)
                        ]);
                    }
                }

                $atualizarCarrinho = (new CarrinhoComprasController())->atualizarCarrinhoCompras($idCarrinho);
                return redirect()->route('carrinho-all')->withErrors('Cupom aplicado com sucesso');
            }

            // MARCA
        } else {
            $getMarca = array_values($getCupom)[0]['id_marca'];
            $getAllProdutos = array_values(ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray());
            $checkProd = false;

            foreach ($getAllProdutos as $produto) {
                $getProduto = array_values(Produto::all()->where('id_produtos', $produto['id_produto'])
                    ->where('status', 1)->toArray())[0]['id_categoria'];

                if ($getMarca == $getProduto) {
                    $checkProd = true;
                }
            }


            if ($checkProd) {

                foreach ($getAllProdutos as $produto) {
                    $updateProduto = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)
                        ->where('id_produto', $produto['id_produto'])->toQuery();

                    if ($updateProduto->getModel()->getAttributes()['valor_desconto'] == '0.00') {
                        $updateProduto->update([
                            'valor_total' => $produto['valor_total'] - ($produto['valor_total'] * (array_values($getCupom)[0]['porcentagem'] / 100)),
                            'valor_desconto' => $produto['valor_total'] * (array_values($getCupom)[0]['porcentagem'] / 100)
                        ]);
                    }
                }

                $updateProdutoa = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)
                    ->where('id_produto', $produto['id_produto'])->toArray();

                $atualizarCarrinho = (new CarrinhoComprasController())->atualizarCarrinhoCompras($idCarrinho);
                return redirect()->route('carrinho-all')->withErrors('Cupom aplicado com sucesso');
            }
        }
        return redirect()->route('carrinho-all')->withErrors('Ocorreu um erro ao aplicar o cupom');
    }

    public function getCarrinhoItens(Request $request)
    {
        $idUser = $request->session()->get('user')['id'];
        $carrinho = CarrinhoCompras::all()->where('id_users', $idUser)->where('status', 1)->toArray();

        if (count($carrinho) > 0) {
            $carrinhoProduto = ProdutoCarrinho::all()->where('id_carrinho', array_values($carrinho)[0]['id_carrinho'])->toArray();

            $idCarrinho = array_values(CarrinhoCompras::all()->where('id_users', $idUser)->where('status', 1)->toArray())[0]['id_carrinho'];
            $carrinhoItens = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();


            if (count($carrinhoProduto) > 0) {
                $carrinhoItens = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();
            } else {
                return redirect()->route('falha-carrinho');
            }

            $produto = Produto::all()->where('id_produtos', array_values($carrinhoItens)[0]['id_produto'])->toArray();


            // ! Last modification
            $cart = ProdutoCarrinho::with('produto')->where('id_carrinho', $idCarrinho)->whereHas('produto')->get()->pluck('produto')->toArray();
            function array_flatten($array)
            {
                return array_reduce($array, function ($carry, $item) {
                    if (is_array($item)) {
                        return array_merge_recursive($carry, ($item));
                    } else {
                        $carry[] = $item;
                        return $carry;
                    }
                }, []);
            }

            $listProdutos = array_flatten($cart);

            $marca = Marcas::all()->where('id_marca', array_values($produto)[0]['id_marca'])->toArray();
            $inventario = array_values(ProdutoInventario::all()->where('id_inventario', array_values($produto)[0]['id_inventario'])->toArray())[0]['quantidade'];
            $arrayImages = [];

            foreach ($carrinhoItens as $item) {
                $getImages = array_values(ProdutoImagens::all()->where('id_produto', $item['id_produto'])
                    ->where('img_principal', 1)->toArray())[0]['link_img'];
                array_push($arrayImages, $getImages);
            }

            if (count($carrinhoItens) > 0) {
                return view('client.carrinho')->with([
                    'carrinho' => $carrinho,
                    'carrinhoItens' => $carrinhoItens,
                    'arrayImages' => $arrayImages,
                    'listProdutos' => $listProdutos,
                    'marca' => $marca,
                    'inventario' => $inventario
                ]);
            } else {
                return redirect()->route('falha-carrinho');
            }
        } else {
            return redirect()->route('falha-carrinho');
        }
    }




    public function fallback()
    {
        $erro = 'Nenhum item adicionado ao seu carrinho ainda!';
        return view('client.carrinho')->with('erro', $erro);
    }
}
