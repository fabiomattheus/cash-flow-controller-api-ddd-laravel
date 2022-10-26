<?php

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Contracts\PhysicalPersonEntityInterface;
use Domain\Entities\PhysicalPerson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;


class PhysicalPersonTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new PhysicalPerson();
        $this->request = new Request();

    }

    public function test_fillable()
    {
        $expected = [
        'name',
        'last_name',
        'cpf',
        'mother_name',
        'father_name',
        'birth_date'
        ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            PhysicalPersonEntityInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'cpf' => 'sometimes|required|cpf|unique:physical_persons,cpf,' .  $this->request->id ?? null,
            'mother_name' => 'required|string',
            'father_name' => 'required|string',
            'birth_date' => 'required|date_format:Y-m-d'
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }

    }