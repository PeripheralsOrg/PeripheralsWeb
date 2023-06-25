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
        DB::statement(
            'CREATE VIEW `view_produto` AS
                SELECT 
                    users_produtos.id_produtos,
                    users_produtos.nome,
                    users_produtos.marca,
                    users_produtos.modelo,
                    users_produtos.preco,
                    users_produtos.status,
                    users_produtos.is_promocao,
                    users_produtos.descricao,
                    users_produtos.created_at,
                    users_produto_categoria.categoria,
                    users_produto_inventario.quantidade,
                    users_produto_inventario.status AS inventario_status,
                    users_detalhes_produto.fonte_energia,
                    users_detalhes_produto.codigo,
                    users_detalhes_produto.tipo_tela,
                    users_detalhes_produto.tipo_audio,
                    users_detalhes_produto.tamanho,
                    users_detalhes_produto.resolucao,
                    users_detalhes_produto.tecnologia,
                    users_detalhes_produto.conexao,
                    users_detalhes_produto.microfone,
                    users_detalhes_produto.frequencia,
                    users_detalhes_produto.dpi,
                    users_detalhes_produto.cor,
                    users_detalhes_produto.material,
                    users_detalhes_produto.peso,
                    users_detalhes_produto.garantia,
                    users_detalhes_produto.info_adicional,
                    users_detalhes_produto.status 
                    AS detalhes_status

                FROM users_produtos
                LEFT JOIN users_produto_categoria
                ON users_produtos.id_categoria = users_produto_categoria.id_categoria

                LEFT JOIN users_produto_inventario
                ON users_produtos.id_inventario = users_produto_inventario.id_inventario

                LEFT JOIN users_detalhes_produto
                ON users_produtos.id_detalhes = users_detalhes_produto.id_detalhes'
                
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW view_produto");
    }
};
