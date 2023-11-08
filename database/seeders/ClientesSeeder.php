<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'nome' => 'Luiz Marcello',
            'email' => 'luizmarcello.codes@gmail.com',
            'endereco' => 'Rua Benjamin Franklin, 730',
            'logradouro' => 'Jardim Jamaica',
            'cep' => '86.063-240',
            'bairro' => 'Jardim Jamaica',
        ]);

        Cliente::create([
            'nome' => 'Luiz Carlos Marcello',
            'email' => 'luizmarcello.codes@gmail.com',
            'endereco' => 'Rua Benjamin Franklin, 730',
            'logradouro' => 'Jardim Jamaica',
            'cep' => '86.063-240',
            'bairro' => 'Jardim Jamaica',
        ]);
    }
}
