<?php

namespace Tests\Unit\Domain\Aggregates;

use Domain\Aggregates\Contracts\OperationTypeAggregateInterface;
use Domain\Aggregates\OperationType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class OperationTypeTest extends TestCase
{
    use RefreshDatabase;

    protected $model;
    protected $request;
    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new OperationType();
        $this->request = new Request();
   
    }

    public function test_fillable()
    {
        $expected = [
            'label',
            'description'
        ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            OperationTypeAggregateInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'label' => 'required|string|min:3|max:500|unique:operation_types,label,' . $this->request->id ?? null,
            'description' => 'required|string|min:3|max:500',
      
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }
}
