<?php

namespace Database\Factories\Domain\Aggregates;

use Domain\Aggregates\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Aggregates\ChatFile>
 */
class ChatFileFactory extends Factory
{
    protected $model = \Domain\Aggregates\ChatFile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'file_path' => 'file_path',
            'chat_id' => Chat::factory(),
        ];
    }
}
