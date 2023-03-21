<?php

namespace Database\Factories\Domain\Aggregates;

use Domain\Aggregates\OperationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationTypeFactory extends Factory
{
    protected $model = OperationType::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {  
        return [
            'label' => 'label',
            'description' => 'description',
        ];
    }
}

