<?php

namespace App\Http\Controllers;

use App\Models\CarrinhoCompras;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaTemporary;
use Illuminate\Http\Request;
use App\Models\ProdutoCarrinho;
use App\Models\ProdutoInventario;
use App\Models\Endereco;
use App\Models\Marcas;
use App\Models\ProdutoImagens;
use App\Models\User;
use App\Models\VendaStatus;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public static function registerTemporary($valorTotal, $frete, $prazo, $quantItems, $idusers, $idCarrinho, $idEndereco, $descontoTotal)
    {
        $vendaT = new VendaTemporary();

        $vendaCreate = $vendaT->create([
            'valor_total' => $valorTotal,
            'frete' => floatval($frete),
            'prazo' => $prazo,
            'desconto_total' => $descontoTotal,
            'quantidade_items' => $quantItems,
            'id_users' => $idusers,
            'id_carrinho' => $idCarrinho,
            'id_endereco' => $idEndereco,
        ])->id_temporary_venda;

        if ($vendaCreate) {
            return $vendaCreate;
        } else {
            return false;
        }
    }

    public function processVenda(Request $request)
    {
        $vendaT = new Venda();
        $getVenda = array_values(VendaTemporary::all()->where('id_temporary_venda', $request->idVendaT)->toArray());
        $getCarinho = (CarrinhoCompras::all()->where('id_carrinho', $request->idCarrinho)->toQuery());


        // dd($getVenda);

        $vendaCreate = $vendaT->create([
            'valor_total' => $getVenda[0]['valor_total'],
            'frete' => $getVenda[0]['frete'],
            'valor_desconto_total' => $getCarinho->getModel()->getAttribute('valor_desconto'),
            "quantidade_items" => $getVenda[0]['quantidade_items'],
            "id_users" => $request->session()->get('user')['id'],
            "id_carrinho" => $request->input('idCarrinho'),
            "id_endereco" => $getVenda[0]['id_endereco'],
            'id_venda_status' => 1
        ]);


        if ($vendaCreate) {
            $atualizarQuant = VendaController::atualizarQuantProduto($getCarinho);
            $getVenda = (VendaTemporary::all()->where('id_carrinho', $request->idCarrinho)->toQuery());
            $getVenda->delete();
            $getCarinho->update([
                'status' => 0
            ]);

            return redirect($request->input('checkoutLink'));
        } else {
            return redirect()->back()->withErrors('Ocorreu um erro ao finalizar a compra! Por favor contate o SAC');
        }
    }

    private static function flattenArray($array)
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

    private static function atualizarQuantProduto($getCarinho)
    {
        $carrinhoProdutoS = array_values(ProdutoCarrinho::all()->where('id_carrinho', $getCarinho->getModel()->getAttribute('id_carrinho'))->toArray());

        $cart = ProdutoCarrinho::with('produto')->where('id_carrinho', $getCarinho->getModel()->getAttribute('id_carrinho'))
            ->whereHas('produto')->get()->pluck('produto')->toArray();


        $listProdutos = VendaController::flattenArray($cart);


        for ($i = 0; $i < count($listProdutos); $i++) {
            $inventario = ProdutoInventario::all()->where('id_inventario', $listProdutos[$i]['id_inventario'])->toQuery();

            if (intval($inventario->getModel()->getAttribute('quantidade')) !== 0) {
                $subtraction = intval($inventario->getModel()->getAttribute('quantidade')) - intval($carrinhoProdutoS[$i]['quantidade']);
                if ($subtraction <= 0) {
                    $inventario->update([
                        'quantidade' => 0,
                    ]);

                    $updateProd = Produto::all()->where('id_inventario', $listProdutos[$i]['id_inventario'])->toQuery();
                    $updateProd->update([
                        'status' => 0
                    ]);
                } else {
                    $inventario->update([
                        'quantidade' => $subtraction
                    ]);
                }
            }
        }
    }


    public function getPedidoDetailClient(Request $request, $idVenda)
    {
        // FRETE
        $getVenda = array_values(Venda::all()->where('id_venda', $idVenda)->toArray());
        $getEndereco = Endereco::all()->where('id_endereco', array_values($getVenda)[0]['id_endereco'])->toArray();

        $idUser = $request->session()->get('user')['id'];


        // Informações Pedido
        $carrinho = CarrinhoCompras::all()->where('id_carrinho', array_values($getVenda)[0]['id_carrinho'])->toArray();

        $idCarrinho = array_values(CarrinhoCompras::all()->where('id_carrinho', array_values($getVenda)[0]['id_carrinho'])
            ->toArray())[0]['id_carrinho'];
        $carrinhoItens = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();

        $carrinhoItens = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();

        $produto = Produto::all()->where('id_produtos', array_values($carrinhoItens)[0]['id_produto'])->toArray();

        $cart = ProdutoCarrinho::with('produto')->whereHas('produto')->get()->pluck('produto')->toArray();

        $listProdutos = VendaController::flattenArray($cart);

        $marca = Marcas::all()->where('id_marca', array_values($produto)[0]['id_marca'])->toArray();
        $inventario = array_values(ProdutoInventario::all()->where('id_inventario', array_values($produto)[0]['id_inventario'])->toArray())[0]['quantidade'];
        $arrayImages = [];

        foreach ($carrinhoItens as $item) {
            $getImages = array_values(ProdutoImagens::all()->where('id_produto', $item['id_produto'])
                ->where('img_principal', 1)->toArray())[0]['link_img'];
            array_push($arrayImages, $getImages);
        }


        $cartProdutos = ProdutoCarrinho::with('produto')->whereHas('produto')->get()->pluck('produto')->toArray();
        $listProdutos = VendaController::flattenArray($cartProdutos);



        $checkVendaT = VendaTemporary::all()->where('id_carrinho', $idCarrinho)->toArray();


        if ($getVenda) {
            return view('client.pedido-detail')->with([
                'getVenda' => $getVenda,
                'getEndereco' => $getEndereco,
                'carrinho' => $carrinho,
                'carrinhoItens' => $carrinhoItens,
                'arrayImages' => $arrayImages,
                'listProdutos' => $listProdutos,
                'marca' => $marca,
                'inventario' => $inventario,
                'idCarrinho' => $idCarrinho,
            ]);
        } else {
            return redirect()->back()->withErrors('Ocorreu um erro ao obter as informações do pedido!');
        }
    }

    public function fallback(){
        $erro = 'Nenhum pedido encontrado';
        return view('admin.list.listPedidos')->with('erro', $erro);
    }


    public function getPedidoAdmin()
    {
        $getVenda = Venda::all()->toArray();

        if (count($getVenda) > 0) {
            return view('admin.list.listPedidos')->with('getVenda', $getVenda);
        } else {
            return redirect()->route('fallback-pedidoAdmin');
        }
    }

    public function detailsPedidoAdmin(Request $request, $idVenda){
        // FRETE
        $getVenda = Venda::all()->where('id_venda', $idVenda)->toArray();
        $getEndereco = Endereco::all()->where('id_endereco', array_values($getVenda)[0]['id_endereco'])->toArray();

        $idUser = array_values($getVenda)[0]['id_users'];
        $getUser = User::all()->where('id', $idUser)->toArray();


        // Informações Pedido
        $carrinho = CarrinhoCompras::all()->where('id_carrinho', array_values($getVenda)[0]['id_carrinho'])->toArray();

        $idCarrinho = array_values(CarrinhoCompras::all()->where('id_carrinho', array_values($getVenda)[0]['id_carrinho'])
            ->toArray())[0]['id_carrinho'];
        $carrinhoItens = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();

        $carrinhoItens = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();

        $produto = Produto::all()->where('id_produtos', array_values($carrinhoItens)[0]['id_produto'])->toArray();

        $cart = ProdutoCarrinho::with('produto')->whereHas('produto')->get()->pluck('produto')->toArray();

        $listProdutos = VendaController::flattenArray($cart);

        $marca = Marcas::all()->where('id_marca', array_values($produto)[0]['id_marca'])->toArray();
        $inventario = array_values(ProdutoInventario::all()->where('id_inventario', array_values($produto)[0]['id_inventario'])->toArray())[0]['quantidade'];
        $arrayImages = [];

        foreach ($carrinhoItens as $item) {
            $getImages = array_values(ProdutoImagens::all()->where('id_produto', $item['id_produto'])
                ->where('img_principal', 1)->toArray())[0]['link_img'];
            array_push($arrayImages, $getImages);
        }


        $cartProdutos = ProdutoCarrinho::with('produto')->whereHas('produto')->get()->pluck('produto')->toArray();
        $listProdutos = VendaController::flattenArray($cartProdutos);



        $checkVendaT = VendaTemporary::all()->where('id_carrinho', $idCarrinho)->toArray();
        $getVendaStatus = VendaStatus::all()->toArray();


        if ($getVenda) {
            return view('admin.details.detailsPedido')->with([
                'getVenda' => $getVenda,
                'getEndereco' => $getEndereco,
                'carrinho' => $carrinho,
                'carrinhoItens' => $carrinhoItens,
                'arrayImages' => $arrayImages,
                'listProdutos' => $listProdutos,
                'marca' => $marca,
                'inventario' => $inventario,
                'idCarrinho' => $idCarrinho,
                'getUser' => $getUser,
                'getVendaStatus' => $getVendaStatus
            ]);
        } else {
            return redirect()->back()->withErrors('Ocorreu um erro ao obter as informações do pedido!');
        }
    }

    public function updateStatusPedido(Request $request){

        $getVenda = Venda::all()->where('id_venda', $request->input('idVenda'))->toQuery();

        $updateStatusVenda = $getVenda->update([
            'id_venda_status' => $request->input('status-pedido')
        ]);

        if($updateStatusVenda){
            return redirect()->back()->withErrors('Status atualizado com sucesso!');
        }else{
            return redirect()->back()->withErrors('Ocorreu um erro ao atualizar o status do pedido!');
        }
    }

    public function searchPedidosAdmin(Request $request){
        if (empty($request->input('search'))) {
            return redirect()->route('page-listPedidos')->withErrors('Por favor, preencha o campo de pesquisa!');
        }

        $search = $request->input('search');
        $getVenda = json_decode(json_encode(DB::table('users_venda')->where('id_venda', 'LIKE', '%' . $search . '%')
        ->get()->toArray()), true);

        if ($getVenda) {
            return view('admin.list.listPedidos')->with('getVenda', $getVenda);
        }
        return redirect()->route('fallback-pedidoAdmin');
    }

    public function orderFilterAdmin(Request $request)
    {
        if($request->input('select-ordem') == 'quant'){
            $getVenda = Venda::all()->toQuery()->orderby('quantidade_items', 'desc')->paginate(10);
            if ($getVenda) {
                return view('admin.list.listPedidos')->with('getVenda', $getVenda);
            }
            return redirect()->route('fallback-pedidoAdmin');

        }else{
            $getVenda = Venda::all()->toQuery()->orderby('valor_total', $request->input('select-ordem'))->paginate(10);
            if ($getVenda) {
                return view('admin.list.listPedidos')->with('getVenda', $getVenda);
            }
            return redirect()->route('fallback-pedidoAdmin');
        }
    }

    public function dateFilterAdmin(Request $request){
        $getVenda = Venda::all()->whereBetween('created_at', [$request->input('dateFrom'), $request->input('dateTo')])->toArray();

        if ($getVenda) {
            return view('admin.list.listPedidos')->with('getVenda', $getVenda);
        }
        return redirect()->route('fallback-pedidoAdmin');
    }
}
