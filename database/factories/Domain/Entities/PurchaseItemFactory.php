<?php

namespace Database\Factories\Domain\Entities;

use Domain\Aggregates\Tenant;
use Domain\Entities\PurchaseItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Entities\PurchaseItem>
 */
class PurchaseItemFactory extends Factory
{

    protected $model = PurchaseItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'purchase_identifier' => 'purchase_identifier',
            'product_id' => 'product_id',
            'product_name' => 'celular',
            'product_brand' => 'apple',
            'product_amount' => 10,
            'tenant_id' => Tenant::factory(),
        ];
    }
}
