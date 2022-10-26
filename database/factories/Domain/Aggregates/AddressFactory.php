<?php

namespace Database\Factories\Domain\Aggregates;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Aggregates\Address>
 */
class AddressFactory extends Factory
{
    protected $model = \Domain\Aggregates\Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'street' => 'Phelype',
            'district' => 'vitoria',
            'zip_code' => '29156567',
            'number' => 50,
            'complement' => 'complement',
            'addressable_id' => '',
            'addressable_type' => '',
            'city' => 'city',
            'state' => 'ES',
            'lat'=> '50',
            'long' => '150',
            'type' => 'work',


            // 'street' =>  Str::slug($this->faker->name),
            // 'district' => $this->faker->name,
            // 'number' => $this->faker->randomElement([$this->faker->numberBetween(1,200) ,'s/n']),
            // 'complement' => $this->faker->word,
            // 'city' => $this->faker->city,
            // 'zip_code' =>  $this->faker->randomElement(['29140066' ,'29182807','29171413','29199657','29150530']),
            // 'state' => $this->faker->randomElement(['ES' ,'RJ','SP','MG','RS']),
            // 'lat' => $this->faker->latitude,
            // 'long' => $this->faker->longitude,
            // 'addressable_id' => "",
            // 'addressable_type' => "",
            // 'type' => $this->faker->randomElement(['home', 'work', 'delivery']),
            // 'created_at' => now(),
            // 'updated_at' => now()
        ];
    }
}
