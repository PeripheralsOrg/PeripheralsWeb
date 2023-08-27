<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE VIEW `view_produto` AS
select
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
    `users_detalhes_produto`.`fonte_energia` AS `fonte_energia`,
    `users_detalhes_produto`.`codigo` AS `codigo`,
    `users_detalhes_produto`.`tipo_tela` AS `tipo_tela`,
    `users_detalhes_produto`.`tipo_audio` AS `tipo_audio`,
    `users_detalhes_produto`.`tamanho` AS `tamanho`,
    `users_detalhes_produto`.`resolucao` AS `resolucao`,
    `users_detalhes_produto`.`tecnologia` AS `tecnologia`,
    `users_detalhes_produto`.`conexao` AS `conexao`,
    `users_detalhes_produto`.`microfone` AS `microfone`,
    `users_detalhes_produto`.`frequencia` AS `frequencia`,
    `users_detalhes_produto`.`dpi` AS `dpi`,
    `users_detalhes_produto`.`cor` AS `cor`,
    `users_detalhes_produto`.`material` AS `material`,
    `users_detalhes_produto`.`peso` AS `peso`,
    `users_detalhes_produto`.`garantia` AS `garantia`,
    `users_detalhes_produto`.`info_adicional` AS `info_adicional`,
    `users_detalhes_produto`.`status` AS `detalhes_status`,
    `users_produto_imgs`.`link_img` AS `link_img`,
    `users_produto_imgs`.`img_principal` AS `img_principal`,
    ifnull(
        round(
            sum(
                `users_comentario`.`avaliacao`
            ) / count(
                `users_comentario`.`avaliacao`
            ),
            0
        ),
        0
    ) AS `avaliacao_media`
from ( ( ( ( (
                        `users_produtos`
                        left join `users_produto_categoria` on(
                            `users_produtos`.`id_categoria` = `users_produto_categoria`.`id_categoria`
                        )
                    )
                    left join `users_produto_inventario` on(
                        `users_produtos`.`id_inventario` = `users_produto_inventario`.`id_inventario`
                    )
                )
                left join `users_detalhes_produto` on(
                    `users_produtos`.`id_detalhes` = `users_detalhes_produto`.`id_detalhes`
                )
            )
            left join `users_produto_imgs` on(
                `users_produtos`.`id_produtos` = `users_produto_imgs`.`id_produto`
            )
        )
        left join `users_comentario` on(
            `users_produtos`.`id_produtos` = `users_comentario`.`id_produto` or `users_comentario`.`id_produto` is null
        )
    )
where
    `users_produto_imgs`.`img_principal` = 1
group by
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
    `users_produto_inventario`.`status`,
    `users_detalhes_produto`.`fonte_energia`,
    `users_detalhes_produto`.`codigo`,
    `users_detalhes_produto`.`tipo_tela`,
    `users_detalhes_produto`.`tipo_audio`,
    `users_detalhes_produto`.`tamanho`,
    `users_detalhes_produto`.`resolucao`,
    `users_detalhes_produto`.`tecnologia`,
    `users_detalhes_produto`.`conexao`,
    `users_detalhes_produto`.`microfone`,
    `users_detalhes_produto`.`frequencia`,
    `users_detalhes_produto`.`dpi`,
    `users_detalhes_produto`.`cor`,
    `users_detalhes_produto`.`material`,
    `users_detalhes_produto`.`peso`,
    `users_detalhes_produto`.`garantia`,
    `users_detalhes_produto`.`info_adicional`,
    `users_detalhes_produto`.`status`,
    `users_produto_imgs`.`link_img`,
    `users_produto_imgs`.`img_principal`');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW view_produto");
    }
};
