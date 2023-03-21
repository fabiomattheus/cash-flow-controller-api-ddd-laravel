<?php

namespace Tests\Feature\Api\CashFlow;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\CashFlow;
use Illuminate\Testing\TestResponse;


class FindApiAllCashFlowsByDateTest extends TestCase
{
    private  function sendApi($inititialDate = null, $finalDate = null, $type=null): TestResponse
    {
        $page = 1;
        return $this->getJson("/api/v1/cash-flow/find-all-by-date/{$inititialDate}/{$finalDate}/{$type}/{$page}", ['Accept' => 'application/json']);
    }
    
    protected $initialDate;
    protected $finalDate;
    protected $cashFlow;
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $this->initialDate = Carbon::now()->format('Y-m-d');
        $this->finalDate = Carbon::now()->format('Y-m-d');
        $this->cashFlow = $this->cashFlow()->create();
    }

    /** @test */
    public function it_should_find_cash_flow_by_id()
    {
        //Arrange
        $response = $this->sendApi($this->cashFlow->movimentation_date, $this->cashFlow->movimentation_date, $this->cashFlow->type)
       // Assert    
           ->assertStatus(200);  
        // convert JSON response string to Array
        $responseArray = json_decode($response->getContent());
        // assert the second page returned the "x" additional data
        $this->assertEquals(count($responseArray->data), 1);  
    }
}

