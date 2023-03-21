<?php

namespace Tests\Feature\Validations;

use Domain\Aggregates\OperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class OperationTypeValidationTest extends TestCase
{
    protected $request;
    protected $model;
    protected $operationTypeCreated;
    public function setUp(): void
    {
        parent::setUp();
        /** @var OperationType $operationType*/
        $this->request =  App::make(Request::class);
        $this->model = $this->app->make('Domain\Aggregates\OperationType');
        $this->operationTypeCreated =  $this->operationType()->setLabel('unique')->create();
        
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
                $this->operationType()->setLabel(null)->make()->getAttributes()
            ],
            [
                $this->operationType()->setLabel('')->make()->getAttributes()
            ],

            [
                $this->operationType()->setLabel('Oi')->make()->getAttributes()
            ],
             
            [
                $this->operationType()->setLabel(123)->make()->getAttributes()
            ],

            [
                $this->operationType()->setDescription(null)->make()->getAttributes()
            ],
            [
                $this->operationType()->setDescription('')->make()->getAttributes()
            ],

            [
                $this->operationType()->setDescription('Oi')->make()->getAttributes()
            ],
             
            [
                $this->operationType()->setDescription(123)->make()->getAttributes()
            ],

            [
                $this->operationType()->setLabel('unique')->make()->getAttributes()
            ],

        ];
    }
    /**
     * @dataProvider provideAddValidData
     */
    public function testAddValidData(array $data)
    {
        $validator = Validator::make($data, $this->model->rules());

        $this->assertTrue($validator->passes());
    }

    public function provideAddValidData()
    {
        return [
            [
                $this->operationType()->make()->getAttributes()
            ],
        ];
    }

     /**
     * @dataProvider provideInvalidUpdateData
     */

     public function testInvalidUpdateData(array $data)
     {
         $this->request->merge(['id' => $this->operationTypeCreated->id]);
         $data = array_merge($data, $this->request->all());
         $validator = Validator::make($data, $this->model->rules());
         $this->assertFalse($validator->passes());
     }
 
     public function provideInvalidUpdateData()
     {
         return [
             [[]],
             [
                 $this->operationType()->setLabel(null)->make()->getAttributes()
             ],
             [
                 $this->operationType()->setLabel('')->make()->getAttributes()
             ],
 
             [
                 $this->operationType()->setLabel('Oi')->make()->getAttributes()
             ],
              
             [
                 $this->operationType()->setLabel(123)->make()->getAttributes()
             ],
 
             [
                 $this->operationType()->setDescription(null)->make()->getAttributes()
             ],
             [
                 $this->operationType()->setDescription('')->make()->getAttributes()
             ],
 
             [
                 $this->operationType()->setDescription('Oi')->make()->getAttributes()
             ],
              
             [
                 $this->operationType()->setDescription(123)->make()->getAttributes()
             ],
         ];
     }

       /**
     * @dataProvider provideValidUpdateData
     */

    public function testValidUpdateData(array $data)
    {
        $this->request->merge(['id' => $this->operationTypeCreated->id]);
        $data = array_merge($data, $this->request->all());
        $validator = Validator::make($data, $this->model->rules());
        $this->assertTrue($validator->passes());
    }
    
    public function provideValidUpdateData()
    {
        return [
            [
                $this->operationType()->make()->getAttributes()
            ],
        ];
    }

}
