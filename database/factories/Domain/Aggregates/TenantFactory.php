<?php

namespace Database\Factories\Domain\Aggregates;

use Domain\Aggregates\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Aggregates\Tenant>
 */
class TenantFactory extends Factory
{
    protected $model = Tenant::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'logo' => 'logo',
            'personable_id' => 'personable_id',
            'personable_type' => 'personable_type',
        ];
    }
}
