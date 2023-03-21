<?php

namespace Tests\Feature\Api\CashFlow;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\CashFlow;
use Illuminate\Testing\TestResponse;

class DeleteApiCashFlowTest extends TestCase
{
    private  function sendApi(CashFlow $cashFlow = null): TestResponse
    {
        return $this->deleteJson("/api/v1/cash-flow/delete/",$cashFlow->getAttributes(), ['Accept' => 'application/json']);
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
    public function it_should_delete_help()
    {
        //Arrange
        $this->sendApi($this->cashFlow)
            //Assert
            ->assertStatus(200);
        $this->assertDatabaseMissing(
            'cash_flows',
            [json_encode($this->cashFlow->getAttributes())]
        );
    }
}
