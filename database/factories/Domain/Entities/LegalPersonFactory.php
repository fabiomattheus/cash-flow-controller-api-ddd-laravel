<?php

namespace Database\Factories\Domain\Entities;

use Domain\Entities\LegalPerson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Entities\LegalPerson>
 */
class LegalPersonFactory extends Factory
{
    protected $model = LegalPerson::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'corporate_name' => 'Empresa de Teste LTDA',
            'cnpj' => '94.754.675/0001-70',
            'state_registration' => '34347688-6',
            'fantasy_name' => 'Empresa de Teste',

        ];
    }
}
