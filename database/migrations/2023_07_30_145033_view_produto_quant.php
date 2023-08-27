<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('CREATE VIEW `view_produto_quant` AS
SELECT
    `users_produtos`.`id_produtos` AS `id_produtos`,
    `users_produtos`.`nome` AS `nome`,
    `users_produtos`.`marca` AS `marca`,
    `users_produtos`.`modelo` AS `modelo`,
    `users_produtos`.`preco` AS `preco`,
    `users_produtos`.`status` AS `status`,
    `users_produtos`.`is_promocao` AS `is_promocao`,
    `users_produtos`.`descricao` AS `descricao`,
    `users_produtos`.`created_at` AS `created_at`,
    `users_produto_categoria`.`categoria` AS `categoria`,
    `users_produto_inventario`.`quantidade` AS `quantidade`,
    `users_produto_inventario`.`status` AS `inventario_status`,
    COUNT(`users_produto_carrinho`.`id_produto`) AS `quantidade_no_carrinho`
FROM
    `users_produtos`
    INNER JOIN `users_produto_categoria` ON (
        `users_produtos`.`id_categoria` = `users_produto_categoria`.`id_categoria`
    )
    INNER JOIN `users_produto_inventario` ON (
        `users_produtos`.`id_inventario` = `users_produto_inventario`.`id_inventario`
    )
    INNER JOIN `users_produto_carrinho` ON (
        `users_produto_carrinho`.`id_produto` = `users_produtos`.`id_produtos`
    )
GROUP BY
    `users_produtos`.`id_produtos`,
    `users_produtos`.`nome`,
    `users_produtos`.`marca`,
    `users_produtos`.`modelo`,
    `users_produtos`.`preco`,
    `users_produtos`.`status`,
    `users_produtos`.`is_promocao`,
    `users_produtos`.`descricao`,
    `users_produtos`.`created_at`,
    `users_produto_categoria`.`categoria`,
    `users_produto_inventario`.`quantidade`,
    `users_produto_inventario`.`status`');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW view_produto_quant");
    }
};
