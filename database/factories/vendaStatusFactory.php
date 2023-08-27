<?php

namespace Database\Factories;

use App\Models\VendaStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\vendaStatus>
 */
class vendaStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = VendaStatus::class;

    public function definition(): array
    {
        return [
            'status_venda' => fake()->randomElements(['Teste']),
            'created_at' => Carbon::now('America/Sao_Paulo'),
            'updated_at' => Carbon::now('America/Sao_Paulo')
        ];
    }
}
