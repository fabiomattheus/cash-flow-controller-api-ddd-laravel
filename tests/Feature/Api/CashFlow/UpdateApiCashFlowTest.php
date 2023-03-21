<?php

namespace Tests\Feature\Api\CashFlow;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Aggregates\CashFlowBalance;
use Domain\Entities\CashFlow;
use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;


class UpdateApiCashFlowTest extends TestCase
{
    private  function sendApi(CashFlow $cashFlow, CashFlowBalance $cashFlowBalance): TestResponse
    {  
        $data = Arr::add($cashFlow->getAttributes(), 'CashFlowBalance', $cashFlowBalance->getAttributes());
        return $this->putJson("/api/v1/cash-flow/update", $data, ['Accept' => 'application/json']);
    }

    protected $cashFlow;
    protected $cashFlowBalance;
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $this->cashFlow = $this->CashFlow()->create();
        $this->cashFlowBalance = $this->cashFlowBalance()->setCashFlowId($this->cashFlow->id)->create();
    }

    /** @test */
    public function it_should_update_help()
    {
        $this->sendApi($this->cashFlow, $this->cashFlowBalance)
            //Assert    
            ->assertStatus(200);
    }
}
