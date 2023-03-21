<?php

namespace Tests\Unit\Domain\Entities;

use Domain\Aggregates\Contracts\DepartamentAggregateInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

use Domain\Entities\Departament;
use Illuminate\Http\Request;

class DepartamentTest extends TestCase
{
    use RefreshDatabase;
    
    protected $model;
    protected $request;
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new Departament();
        $this->request = new Request();

    }

    public function test_fillable()
    {

        $expected = [ 
            'title'
    ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            DepartamentAggregateInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'title' => 'required|string|min:1|max:200|unique:departaments,title,' . $this->request->id ?? null,
       
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }

    }