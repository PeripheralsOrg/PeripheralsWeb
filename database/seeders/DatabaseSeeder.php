<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AdmUsers;
use App\Models\VendaStatus;

class DatabaseSeeder extends Seeder
{

    private $senhaAdm = 'Gizona123@';

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(vendaStatusSeeder::class);

        AdmUsers::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make($this->senhaAdm),
            'poder' => 9,
            'status' => 1,
        ]);
    }
}
