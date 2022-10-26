<?php

namespace Database\Factories\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Entities\Requester>
 */
class RequesterFactory extends Factory
{
    protected $model = \Domain\Entities\Requester::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'photo'=> 'photo',
            'personable_id' => 'personable_id',
            'personable_type' => 'personable_type',

        ];
    }
}
