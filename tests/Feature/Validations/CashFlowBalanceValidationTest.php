<?php

namespace Tests\Feature\Validations;

use Domain\Aggregates\CashFlowBalance;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
class CashFlowBalanceValidationTest extends TestCase
{
    
    protected $model;
    protected $cashFlowBalanceCreated;
    protected $request;
    protected $cashFlowId;
    public function setUp(): void
    {
        parent::setUp();
        /** @var CashFlowBalance $cashFlowBalance*/
        $this->request =  App::make(Request::class);
        $this->model = $this->app->make('Domain\Aggregates\CashFlowBalance');
        $this->cashFlowBalanceCreated =  $this->cashFlowBalance()->setBalance('unique')->create();
        $this->cashFlowId = $this->cashFlowBalanceCreated->id; 
    }

    /**
     * @dataProvider provideInvalidAddData
     */

    public function testInvalidAddData(array $data)
    {
    $validator = Validator::make($data, $this->model->rules());
        $this->assertFalse($validator->passes());
    }

    public function provideInvalidAddData()
    {
        return [
            [[]],
            [
                $this->cashFlowBalance()->setBalance(null)->setCashFlowId($this->cashFlowId)->make()->getAttributes()
            ],
            [
                $this->cashFlowBalance()->setBalance('')->setCashFlowId($this->cashFlowId)->make()->getAttributes()
            ],
            [
                $this->cashFlowBalance()->setBalance(2)->setCashFlowId($this->cashFlowId)->make()->getAttributes()
            ],
            [
                $this->cashFlowBalance()->setBalance("teste")->setCashFlowId(null)->make()->getAttributes()
            ],
            [
                $this->cashFlowBalance()->setCashFlowId(1234)->make()->getAttributes()
                
            ],
        ];
    }

    /**
     * @dataProvider provideValidAddData
     */

     public function testValidAddData(array $data)
     {
     $validator = Validator::make($data, $this->model->rules());
         $this->assertFalse($validator->passes());
     }
 
     public function provideValidAddData()
     {
         return [
             [[]],
             [
                 $this->cashFlowBalance()->setCashFlowId($this->cashFlowId)->make()->getAttributes()
             ],
         ];
     }
}
