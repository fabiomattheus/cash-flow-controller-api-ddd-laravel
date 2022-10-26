<?php

namespace Database\Factories\Domain\Entities;

use Domain\Entities\PhysicalPerson;
use Illuminate\Database\Eloquent\factories\Factory;
class PhysicalPersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhysicalPerson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "Phelype",
            'last_name' => "Morais",
            'birth_date' => now()->format('Y-m-d'),
            'cpf' => '57328663537',
            'mother_name' => 'Maria',
            'father_name' => 'João'];
    }    
}


