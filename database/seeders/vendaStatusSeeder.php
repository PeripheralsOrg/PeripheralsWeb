<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendaStatus;
use Illuminate\Support\Facades\DB;

class vendaStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users_venda_status')->insert([
            ['status_venda' => 'Pendente'],
            ['status_venda' => 'Em Processamento'],
            ['status_venda' => 'Confirmada'],
            ['status_venda' => 'Em Preparação'],
            ['status_venda' => 'Enviada'],
            ['status_venda' => 'Entregue'],
            ['status_venda' => 'Cancelada'],
            ['status_venda' => 'Devolvida'],
            ['status_venda' => 'Reembolsada'],
            ['status_venda' => 'Aguardando Pagamento'],
            ['status_venda' => 'Pagamento Pendente'],
            ['status_venda' => 'Pagamento Recusada'],
            ['status_venda' => 'Pagamento incompleto'],
            ['status_venda' => 'Pagamento Confirmado'],
            ['status_venda' => 'Em Espera'],
            ['status_venda' => 'Problema Identificado'],
            ['status_venda' => 'Aguardando Retirada'],
            ['status_venda' => 'Entrega Atrasada'],
            ['status_venda' => 'Em Trânsito'],
            ['status_venda' => 'Concluído']
        ]);
    }
}
