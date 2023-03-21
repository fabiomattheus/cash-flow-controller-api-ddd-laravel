<?php

namespace Tests\Feature\Api\CashFlow;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Aggregates\CashFlowBalance;
use Domain\Entities\CashFlow;
use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;


class AddApiCashFlowTest extends TestCase
{
    private  function sendApi(CashFlow $cashFlow, CashFlowBalance $cashFlowBalance): TestResponse
    {     
        $data = Arr::add($cashFlow->getAttributes(), 'CashFlowBalance', $cashFlowBalance->getAttributes());
        return $this->postJson('/api/v1/cash-flow/add', $data, ['Accept' => 'application/json']);
    }

    protected $cashFlow;
    protected $cashFlowBalance;
    public function setUp(): void
    {
        //Arrange
        parent::setUp();
        $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $this->cashFlow = $this->CashFlow()->make();
        $this->cashFlowBalance = $this->cashFlowBalance()->setCashFlowId(null)->make();
    }

    /** @test */
    public function it_should_create_a_cash_flow()
    {
        //Act
        $this->sendApi($this->cashFlow, $this->cashFlowBalance)
            //Assert
            ->assertStatus(201);
        // $this->assertDatabaseHas(
        //     'help_requests',
        //     [
        //         "status" => $this->helpRequest->status,
        //         "help_id" => $this->helpRequest->help_id,
        //         "requester_id" => $this->helpRequest->requester_id
        //     ]
        // );
        // $this->assertDatabaseHas(
        //     'purchase_items',
        //     $this->purchaseItem->getAttributes()
        // );
        // $this->assertDatabaseHas(
        //     'chats',
        //     ['note' => $this->chat->note,]
        // );
    }
}
