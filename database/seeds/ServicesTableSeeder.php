<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name' => 'Corte Feminino', 'base_cost' => '40', 'description' => 'Corte, escova nao inclusa.'],
            ['name' => 'Corte Feminino com Escova', 'base_cost' => '50', 'description' => 'Corte, escova inclusa.'],
            ['name' => 'Corte Masculino', 'base_cost' => '25', 'description' => 'Tesoura e Maquina.'],
            ['name' => 'Corte (Bordado)', 'base_cost' => '70', 'description' => 'Remoção de pontas duplas, sem mecher no comprimento do cabelo.'],
            ['name' => 'Coloração (Retoque)', 'base_cost' => '70', 'description' => 'Retoque de raiz.'],
            ['name' => 'Coloração', 'base_cost' => '130', 'description' => 'Primeira aplicação.'],
            ['name' => 'Coloração (Aplicação)', 'base_cost' => '50', 'description' => 'Aplicação de coloração da cliente.'],
            ['name' => 'Maquiagem', 'base_cost' => '90', 'description' => ''],
            ['name' => 'Penteado', 'base_cost' => '80', 'description' => ''],
            ['name' => 'Escova Progressiva', 'base_cost' => '100', 'description' => 'Alisamento com formol.'],
            ['name' => 'Escova Botox', 'base_cost' => '70', 'description' => 'Alisamento sem formol.'],
            ['name' => 'Escova', 'base_cost' => '30', 'description' => 'Lisa ou modelada'],
            ['name' => 'Escova + Prancha', 'base_cost' => '35', 'description' => 'Lisa ou modelada.'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // factory('App\Service', mt_rand(5, 30))->create();
    }
}
