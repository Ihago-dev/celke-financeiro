<?php

namespace Database\Seeders;

use App\Models\Conta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Conta::where('nome', 'Energia')->first()){
            Conta::create([
                'nome' => 'Energia',
                'valor' => '350.72',
                'vencimento' => '2025-05-01',
            ]);
        }

        if(!Conta::where('nome', 'Imposto Estadual')->first()){
            Conta::create([
                'nome' => 'Imposto Estadual',
                'valor' => '500.00',
                'vencimento' => '2025-05-01',
            ]);
        }
    }
}