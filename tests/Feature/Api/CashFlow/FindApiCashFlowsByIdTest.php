<?php

namespace Tests\Feature\Api\CashFlow;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\CashFlow;
use Illuminate\Testing\TestResponse;


class FindApiCashFlowsByIdTest extends TestCase
{
    private  function sendApi(CashFlow $cashFlow = null): TestResponse
    {
        return $this->getJson("/api/v1/cash-flow/find/{$cashFlow->id}", ['Accept' => 'application/json']);
    }

    protected $cashFlow;
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $this->cashFlow = $this->cashFlow()->create();
    }

    /** @test */
    public function it_should_find_cash_flow_by_id()
    {
        //Arrange
        $result = $this->sendApi($this->cashFlow)
            //Assert    
        ->assertStatus(200);
    }
}

