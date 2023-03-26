<?php

namespace Tests\Feature\Api\CashFlow;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\CashFlow;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;

class FindApiAllCashFlowsByDateTest extends TestCase
{
    private  function sendApi($initialDate = null, $finalDate = null, $type=null): TestResponse
    {
        $page = 1;
        return $this->getJson("/api/v1/cash-flow/find-all-by-date/{$initialDate}/{$type}/{$page}/{$finalDate}", ['Accept' => 'application/json']);
    }
    
    protected $initialDate;
    protected $finalDate;
    protected $cashFlow;
    public function setUp(): void
    {
        parent::setUp();
        //$this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $this->initialDate = Carbon::now()->format('Y-m-d');
        $this->finalDate = Carbon::now()->format('Y-m-d');
        $this->cashFlow = $this->cashFlow()->create();
    }

    /** @test */
    public function it_should_return_all_cash_flows_by_date()
    {
        //Arrange
        //Setup()
        //Action
        $response = $this->sendApi($this->cashFlow->movimentation_date, $this->cashFlow->movimentation_date, $this->cashFlow->type)
       // Assert    
           ->assertStatus(200);  
        // convert JSON response string to Array
        $responseArray = json_decode($response->getContent());
        // assert the second page returned the "x" additional data
        $this->assertEquals(count($responseArray->data), 1);  
    }

    /** @test */
    public function it_should_return_invalide_initial_date()
    {
        //Arrange
        //Setup()
        //Action
        $this->sendApi('278677', $this->cashFlow->movimentation_date, $this->cashFlow->type)
       // Assert    
       ->assertJsonValidationErrors(['initialDate' => trans('validation.date', ['attribute' => 'data inicial'])])
       ->assertExactJson(
           [
               'errors' => [
                   "initialDate" => [
                       0 => "O campo data inicial não é uma data válida.",
                   ]
               ]
           ]
       )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);  
    }

    /** @test */
    public function  it_should_return_invalide_final_date()
    {
        //Arrange
        //Setup()
        //Action
        $this->sendApi($this->cashFlow->movimentation_date, '27091999', $this->cashFlow->type)
       // Assert    
       ->assertJsonValidationErrors(['finalDate' => trans('validation.date', ['attribute' => 'data final'])])
       ->assertExactJson(
           [
               'errors' => [
                   "finalDate" => [
                       0 => "O campo data final não é uma data válida.",
                   ]
               ]
           ]
       )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);  
    }

    /** @test */
    public function  it_should_return_invalid_type()
    {
        //Arrange
        //Setup()
        //Action
        $this->sendApi($this->cashFlow->movimentation_date, $this->cashFlow->movimentation_date, 2)
       // Assert    
       ->assertJsonValidationErrors(['type' => trans('validation.in', ['attribute' => 'tipo'])])
       ->assertExactJson(
           [
               'errors' => [
                   "type" => [
                       0 => "O campo tipo selecionado é inválido.",
                   ]
               ]
           ]
       )
       ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);  
    }
}

