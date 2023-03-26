<?php

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\CashFlow;
use Domain\Entities\Contracts\CashFlowEntityInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

use Tests\TestCase;

class CashFlowTest extends TestCase
{
    use RefreshDatabase;

    protected $model;
    protected $request;
    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new CashFlow();
        $this->request = new Request();

    }

    public function test_fillable()
    {
        $expected = [
            'identifier',
            'note',
            'description',
            'type',
            'movimentation_date',
            'value',
            'departament_id',
            'operation_type_id',
            'employee_id'
        ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            CashFlowEntityInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'identifier' => 'required|string|unique:cash_flows,identifier,' . $this->request->id ?? null,
            'note' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:all,credit,debit',
            'movimentation_date' => 'required|date',
            'value' => 'required|numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'departament_id' => 'required|uuid',
            'operation_type_id' => 'required|uuid',
            'employee_id' => 'required|uuid'
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }
}
