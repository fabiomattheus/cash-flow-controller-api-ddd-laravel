<?php

namespace Tests\Feature\Api\CashFlow;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\CashFlow;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteApiCashFlowTest extends TestCase
{
    private  function sendApi(CashFlow $cashFlow = null): TestResponse
    {
        return $this->deleteJson("/api/v1/cash-flow/delete/", $cashFlow->getAttributes(), ['Accept' => 'application/json']);
    }
    protected $cashFlow;
    public function setUp(): void
    {
        parent::setUp();
        // $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $this->cashFlow = $this->cashFlow()->create();
    }

    /** @test */
    public function it_should_delete_cash_flow()
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

    /** @test */
    public function it_should_return_id_required_validation_exception()
    {
        //Arrange
        //Setup()
        //Action
        /** @var CashFlow $cashFlow*/
        $this->sendApi($this->cashFlow()->make())
            //Assert
            ->assertJsonValidationErrors(['id' => trans('validation.required', ['attribute' => 'id'])])
            ->assertExactJson(
                [
                    'errors' => [
                        "id" => [
                            0 => "O campo id é obrigatório.",
                        ]
                    ]
                ]
            )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
