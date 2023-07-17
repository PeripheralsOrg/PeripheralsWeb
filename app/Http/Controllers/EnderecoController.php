<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Models\CarrinhoCompras;
use App\Models\Marcas;
use App\Models\Produto;
use App\Models\ProdutoCarrinho;
use App\Models\ProdutoImagens;
use App\Models\ProdutoInventario;
use App\Models\VendaTemporary;
use DragonCode\Contracts\Cashier\Config\Payment as ConfigPayment;
use Faker\Provider\pt_BR\Payment;
use Illuminate\Support\Facades\Auth;
use LaravelLang\Lang\Plugins\Spark\Paddle;

class EnderecoController extends Controller
{

    private string $finalMessage = '';

    public function getEnderecos(Request $request)
    {
        $idUser = $request->session()->get('user')['id'];
        $endereco = Endereco::all()->where('id_users', $idUser)->toArray();

        if (count($endereco) > 0) {
            return view('client.endereco')->with('endereco', $endereco);
        } else {
            return redirect()->route('falha-endereco');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'tipo_logradouro' => ['required'],
            'logradouro' => ['required'],
            'bairro' => ['required'],
            'numero' => ['required'],
            'estado' => ['required'],
            'cidade' => ['required'],
            'ponto_ref' => ['required'],
            'cep' => ['required'],
            'complemento',

        ]);

        if ($request->input('tipo_logradouro') == '0') {
            return redirect()->back()->withErrors('Por favor, preencha o tipo do seu logradouro!');
        }


        $idUser = $request->session()->get('user')['id'];

        $enderecoC = (new Endereco())->create([
            'tipo_logradouro' => $request->input('tipo_logradouro'),
            'logradouro' => $request->input('logradouro'),
            'bairro' => $request->input('bairro'),
            'numero' => $request->input('numero'),
            'estado' => $request->input('estado'),
            'cidade' => $request->input('cidade'),
            'ponto_ref' => $request->input('ponto_ref'),
            'cep' => str_replace(['-', '.'], '', $request->input('cep')),
            'complemento' => $request->input('complemento'),
            'id_users' => $idUser,
            'status' => 1
        ]);

        if ($enderecoC) {
            return redirect()->route('get-endereco');
        } else {
            return redirect()->route('falha-endereco');
        }
    }

    public function fallback()
    {
        $erro = 'Nenhum endereço cadastrado';
        if (!empty($changeRedirect)) {
            return view('client.info-endereco')->with('erro', $erro);
        } else {
            return view('client.endereco')->with('erro', $erro);
        }
    }


    public function selectEndereco(Request $request)
    {
        // FRETE
        $getEndereco = Endereco::all()->where('id_endereco', $request->input('id_endereco'))->toArray();
        $getFrete = (new CEPController('40010', array_values($getEndereco)[0]['cep'], 5))->getInfo();
        $idUser = $request->session()->get('user')['id'];


        // Informações Pedido
        $carrinho = CarrinhoCompras::all()->where('id_users', $idUser)->where('status', 1)->toArray();

        $idCarrinho = array_values(CarrinhoCompras::all()->where('id_users', $idUser)->where('status', 1)->toArray())[0]['id_carrinho'];
        $carrinhoItens = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();


        $carrinhoItens = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();

        $produto = Produto::all()->where('id_produtos', array_values($carrinhoItens)[0]['id_produto'])->toArray();

        $cart = ProdutoCarrinho::with('produto')->whereHas('produto')->get()->pluck('produto')->toArray();
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

        $valorTotal = floatval(array_values($carrinho)[0]['valor_total']);
        $quantidade = array_values($carrinho)[0]['quant_items'];
        $descontoTotal = array_values($carrinho)[0]['valor_desconto'];
        $idEndereco = array_values($getEndereco)[0]['id_endereco'];

        $cartProdutos = ProdutoCarrinho::with('produto')->whereHas('produto')->get()->pluck('produto')->toArray();
        $listProdutos = array_flatten($cartProdutos);


        foreach ($listProdutos as $produtoFor) {
            if ($this->finalMessage !== '') {
                $this->finalMessage = $this->finalMessage . '/' . $produtoFor['nome'];
            } else {
                $this->finalMessage = $produtoFor['nome'];
            }
        }


        $checkVendaT = VendaTemporary::all()->where('id_carrinho', $idCarrinho)->toArray();

        if (count($checkVendaT) > 0) {
            $payLink = Auth::user()->charge($valorTotal, $this->finalMessage, [
                'webhook_url' => env('APP_URL') . '/venda/sucesso',
                'custom_message' => $this->finalMessage,
                'quantity_variable' => 0,
                'passthrough' => [
                    "idCarrinho" => $idCarrinho,
                    "idVendaT" => array_values($checkVendaT)[0]['id_temporary_venda']
                ],
                'data-success' => env('APP_URL') . '/venda/sucess'
            ]);
        } else {
            $createTemporary = VendaController::registerTemporary(
                $valorTotal,
                $getFrete['valor'],
                $getFrete['prazo'],
                $quantidade,
                $request->session()->get('user')['id'],
                $idCarrinho,
                $idEndereco,
                $descontoTotal
            );

            $payLink = Auth::user()->charge($valorTotal, $this->finalMessage, [
                'webhook_url' => env('APP_URL') . '/venda/sucesso',
                'custom_message' => $this->finalMessage,
                'quantity_variable' => 0,
                'passthrough' => [
                    "idCarrinho" => $idCarrinho,
                    "idVendaT" => $createTemporary
                ],
                'data-success' => env('APP_URL') . '/venda/sucess'
            ]);
        }


        if ($getFrete) {
            return view('client.finalizar-pagamento')->with([
                'getFrete' => $getFrete,
                'getEndereco' => $getEndereco,
                'carrinho' => $carrinho,
                'carrinhoItens' => $carrinhoItens,
                'arrayImages' => $arrayImages,
                'listProdutos' => $listProdutos,
                'marca' => $marca,
                'inventario' => $inventario,
                'payLink' => $payLink,
                'idCarrinho' => $idCarrinho,
                'idEndereco' => $idEndereco,
                'descontoTotal' => $descontoTotal
            ]);
        } else {
            return redirect()->back()->withErrors('Frete indisponível para o endereço. Por favor selecione outro!');
        }
    }


    public function registerInfoEndereco(Request $request)
    {
        $request->validate([
            'tipo_logradouro' => ['required'],
            'logradouro' => ['required'],
            'bairro' => ['required'],
            'numero' => ['required'],
            'estado' => ['required'],
            'cidade' => ['required'],
            'ponto_ref' => ['required'],
            'cep' => ['required'],
            'complemento',

        ]);

        if ($request->input('tipo_logradouro') == '0') {
            return redirect()->back()->withErrors('Por favor, preencha o tipo do seu logradouro!');
        }


        $idUser = $request->session()->get('user')['id'];

        $enderecoC = (new Endereco())->create([
            'tipo_logradouro' => $request->input('tipo_logradouro'),
            'logradouro' => $request->input('logradouro'),
            'bairro' => $request->input('bairro'),
            'numero' => $request->input('numero'),
            'estado' => $request->input('estado'),
            'cidade' => $request->input('cidade'),
            'ponto_ref' => $request->input('ponto_ref'),
            'cep' => str_replace(['-', '.'], '', $request->input('cep')),
            'complemento' => $request->input('complemento'),
            'id_users' => $idUser,
            'status' => 1
        ]);

        if ($enderecoC) {
            return redirect()->route('list-meusEnderecos')->withErrors('Endereço registrado com sucesso!');
        } else {
            return redirect()->route('list-meusEnderecos')->withErrors('Ocorreu um erro ao inserir seu novo endereço! Por favor, contate o SAC.');
        }
    }

    public function deleteEnderecoInfo(Request $request){
        $deleteAll = Endereco::all()->where('id_endereco', $request->input('id_endereco'))->toQuery();
        $deleteAll->update([
            'status' => 0
        ]);

        if ($deleteAll) {
            return redirect()->route('list-meusEnderecos')->withErrors('Endereço deletado com sucesso');
        }
        return redirect('list-meusEnderecos')->withErrors('Não foi possível deletar o endereço!');
    }
}
