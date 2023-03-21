<?php
namespace Database\Factories\Domain\Aggregates;

use Domain\Aggregates\CashFlowBalance;
use Domain\Entities\CashFlow;
use Illuminate\Database\Eloquent\factories\Factory;

class CashFlowBalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CashFlowBalance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'balance' => 19.58,
            'cash_flow_id' => CashFlow::factory(),        
        ];
    }
}

