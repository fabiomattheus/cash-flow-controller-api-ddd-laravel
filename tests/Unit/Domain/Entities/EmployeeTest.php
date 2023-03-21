<?php

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Contracts\EmployeeEntityInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

use Domain\Entities\Employee;
use Illuminate\Http\Request;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;
    
    protected $model;
    protected $request;
    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new Employee();
        $this->request = new Request();

    }

    public function test_fillable()
    {
        $expected = [ 
            'photo',
            'personable_id',
            'personable_type'
    ];

        $fillable =  $this->model->getFillable();
        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            EmployeeEntityInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'photo' => 'required|string',
            'personable_id' => 'required|uuid',
            'personable_type' => 'required',
        ];

        $rules =  $this->model->rules();
        $this->assertEquals($expected, $rules);
    }

    }