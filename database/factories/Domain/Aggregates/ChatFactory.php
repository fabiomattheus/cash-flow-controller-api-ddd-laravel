<?php

namespace Database\Factories\Domain\Aggregates;

use Domain\Aggregates\Chat;
use Domain\Entities\HelpRequest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\Builders\HelpRequestBuilder;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Aggregates\Chat>
 */
class ChatFactory extends Factory
{
    protected $model = Chat::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {  
        return [
            'note' => 'Quero cancelar minha compra',
            'help_request_id' => '123',
        ];
    }
}

