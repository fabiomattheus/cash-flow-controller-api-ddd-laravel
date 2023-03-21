<?php

namespace Tests\Feature\Validations;

use Domain\Entities\CashFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class CashFlowValidationTest extends TestCase
{
    protected $request;
    protected $model;
    protected $cashFlowCreated;
    protected $departamentId;
    protected $operationTypeId;
    protected $employeeId;
    protected $relations;

    public function setUp(): void
    {
        parent::setUp();
        /** @var CashFlow $cashFlow*/
        $this->request =  App::make(Request::class);
        $this->model = $this->app->make('Domain\Entities\CashFlow');
        $this->cashFlowCreated =  $this->cashFlow()->setIdentifier('unique')->make();
        $this->relations = ['departament_id' => $this->cashFlowCreated->departament_id,
        'operation_type_id' => $this->cashFlowCreated->operation_type_id,
        'employee_id' =>  $this->cashFlowCreated->employee_id];
          
    }
    /**
     * @dataProvider provideInvalidAddData
     */

    public function testInvalidAddData(array $data)
    {
        $data = array_merge($data, $this->relations);
      //  dd($data);
        $validator = Validator::make($data, $this->model->rules());
       // dd($validator->errors());
        $this->assertFalse($validator->passes());
    }

    public function provideInvalidAddData()
    {
        return [
           [[]],
            [
                $this->cashFlow()->setIdentifier(null)
                    ->setDepartamentId(null)
                    ->setEmployeeId(null)
                    ->setOperationTypeId(null)->make()->getAttributes()
            ],
            [
                $this->cashFlow()->setIdentifier('')
                    ->setDepartamentId($this->departamentId)
                    ->setEmployeeId($this->employeeId)
                    ->setOperationTypeId($this->operationTypeId)->make()->getAttributes()
            ],
            
            [
                $this->cashFlow()->setDescription(null)
                    ->setDepartamentId($this->departamentId)
                    ->setEmployeeId($this->employeeId)
                    ->setOperationTypeId($this->operationTypeId)->make()->getAttributes()
            ],
             [
                $this->cashFlow()->setDescription(null)
                    ->setDepartamentId($this->departamentId)
                    ->setEmployeeId($this->employeeId)
                    ->setOperationTypeId($this->operationTypeId)->make()->getAttributes()
            ],
            [
                $this->cashFlow()->setDescription(1234)
                    ->setDepartamentId($this->departamentId)
                    ->setEmployeeId($this->employeeId)
                    ->setOperationTypeId($this->operationTypeId)->make()->getAttributes()
            ],

            [
                $this->cashFlow()->setNote(null)
                    ->setDepartamentId($this->departamentId)
                    ->setEmployeeId($this->employeeId)
                    ->setOperationTypeId($this->operationTypeId)->make()->getAttributes()
            ],
            
            [
                $this->cashFlow()->setValue(12.0998)
                    ->setDepartamentId(null)
                    ->setEmployeeId(null)
                    ->setOperationTypeId(null)->make()->getAttributes()
            ],

            [
                $this->cashFlow()->setValue(null)
                    ->setDepartamentId($this->departamentId)
                    ->setEmployeeId($this->employeeId)
                    ->setOperationTypeId($this->operationTypeId)->make()->getAttributes()
            ],

            
        ];
    }
    /**
     * @dataProvider provideValidAddData
     */
    public function testValidAddData(array $data)
    {
        $data = array_merge($data, $this->relations);
        $validator = Validator::make($data, $this->model->rules());
        $this->assertTrue($validator->passes());
    }

    public function provideValidAddData()
    {
        return [
            [
                $this->cashFlow()
                ->setDepartamentId(null)
                ->setEmployeeId(null)
                ->setOperationTypeId(null)->make()->getAttributes()
       
            ],
        ];
    }

    /**
     * @dataProvider provideInvalidUpdateData
     */

    /* public function testInvalidUpdateData(array $data)
     {
         $this->request->merge(['id' => $this->cashFlowCreated->id]);
         $data = array_merge($data, $this->request->all());
         $validator = Validator::make($data, $this->model->rules());
         $this->assertFalse($validator->passes());
     }
 
     public function provideInvalidUpdateData()
     {
         return [
             [[]],
             [
                 $this->cashFlow()->setIdentifier(null)->make()->getAttributes()
             ],
             [
                 $this->cashFlow()->setIdentifier('')->make()->getAttributes()
             ],
 
             [
                 $this->cashFlow()->setIdentifier('Oi')->make()->getAttributes()
             ],
              
             [
                 $this->cashFlow()->setIdentifier(123)->make()->getAttributes()
             ],
 
             [
                 $this->cashFlow()->setDescription(null)->make()->getAttributes()
             ],
             [
                 $this->cashFlow()->setDescription('')->make()->getAttributes()
             ],
 
             [
                 $this->cashFlow()->setDescription('Oi')->make()->getAttributes()
             ],
              
             [
                 $this->cashFlow()->setDescription(123)->make()->getAttributes()
             ],
         ];
     } */

    /**
     * @dataProvider provideValidUpdateData
     */

    /* public function testValidUpdateData(array $data)
    {
        $this->request->merge(['id' => $this->cashFlowCreated->id]);
        $data = array_merge($data, $this->request->all());
        $validator = Validator::make($data, $this->model->rules());
        $this->assertTrue($validator->passes());
    }
    
    public function provideValidUpdateData()
    {
        return [
            [
                $this->cashFlow()->make()->getAttributes()
            ],
        ];
    } */
}
