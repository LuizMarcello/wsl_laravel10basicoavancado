<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Venda;

class VendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Venda::create([
            'numero_da_venda' => 1,
            'produto_id' => 5,
            'cliente_id' => 7,
        ]);

        Venda::create([
            'numero_da_venda' => 2,
            'produto_id' => 10,
            'cliente_id' => 16,
        ]);
    }
}
