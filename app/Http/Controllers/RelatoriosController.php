<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class RelatoriosController extends Controller
{
    public function getRelatorios(){
        $chart_options = [
            'chart_title' => 'Vendas por mês',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Venda',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => '200, 60, 60',
            'date_format' => 'd/m/Y',
        ];
        $chartVenda = new LaravelChart($chart_options);

        $chart_options2 = [
            'chart_title' => 'Maiores vendas no mês',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Venda',
            'group_by_field' => 'created_at',
            'chart_type' => 'line',
            'chart_color' => '226, 135, 67',
            'filter_days' => 30,
            'aggregate_function' => 'sum',
            'aggregate_field' => 'valor_total',
            'stacked' => true,
            'date_format' => 'd/m/Y',
            'top_results' => 10,
        ];

        $optionsUser = [
            'chart_title' => 'Usuários cadastrados no mês',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'chart_type' => 'bar',
            'chart_color' => '200, 60, 60',
            'filter_days' => 30,
            'stacked' => true,
            'date_format' => 'd/m/Y',
        ];

        $optionsProduto = [
            'chart_title' => 'Avaliação Média',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\ProdutoView',
            'group_by_field' => 'avaliacao_media',
            'chart_type' => 'bar',
            'chart_color' => '226, 135, 67',
            'filter_days' => 30,
            'stacked' => true,
            'date_format' => 'd/m/Y',
        ];

        $getProdutoQuant = [
            'chart_title' => 'Número de vendas',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\ProdutoQuantView',
            'group_by_field' => 'nome',
            'chart_type' => 'bar',
            'chart_color' => '200, 60, 60',
            'filter_days' => 30,
            'stacked' => true,
            'date_format' => 'd/m/Y',
            'aggregate_field' => 'quantidade_no_carrinho',
            'aggregate_function' => 'sum',
            'top_results' => 10,
        ];

        $chartVenda = new LaravelChart($chart_options);
        $chartVenda2 = new LaravelChart($chart_options2);
        $chartUsers = new LaravelChart($optionsUser);
        $chartProduto = new LaravelChart($optionsProduto);
        $chartProdutoQuant = new LaravelChart($getProdutoQuant);

        // return view('admin.list.listRelatorios', compact('chartVenda', 'chartVenda2', 'chartUsers', 'chartProduto', 'chartProdutoQuant'));
        return view('admin.list.listRelatorios')->with([
            'chartVenda' => $chartVenda,
            'chartVenda2' => $chartVenda2,
            'chartUsers' => $chartUsers,
            'chartProduto' => $chartProduto,
            'chartProdutoQuant' => $chartProdutoQuant,
        ]);

    }
}
