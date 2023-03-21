<?php

namespace Tests\Unit\Domain\Aggregates;

use Domain\Aggregates\CashFlowBalance;
use Domain\Aggregates\Contracts\CashFlowBalanceAggregateInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


class CashFlowBalanceTest extends TestCase
{
    use RefreshDatabase;

    protected $model;
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new CashFlowBalance();
    }

    public function test_fillable()
    {
        $expected = [
            'balance',
            'cash_flow_id'    
        ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            CashFlowBalanceAggregateInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'cash_flow_id' => 'required|uuid',
            'balance' => 'required|numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }
}
