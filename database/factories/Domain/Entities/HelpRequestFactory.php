<?php

namespace Database\Factories\Domain\Entities;

use Domain\Entities\Help;
use Domain\Entities\HelpRequest;
use Domain\Entities\PurchaseItem;
use Domain\Entities\Requester;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Entities\HelpRequest>
 */
class HelpRequestFactory extends Factory
{
    protected $model = HelpRequest::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'identifier' => 'identifier',
            'status' => 'analyzing',
            'help_id' => Help::factory(),
            'requester_id' => Requester::factory(),
            'purchase_item_id' => PurchaseItem::factory(),

        ];
    }
}
