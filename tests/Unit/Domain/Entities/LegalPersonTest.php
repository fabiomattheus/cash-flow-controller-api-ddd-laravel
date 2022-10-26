<?php

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Contracts\LegalPersonEntityInterface;
use Domain\Entities\LegalPerson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;


class LegalPersonTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new LegalPerson();
        $this->request = new Request();

    }

    public function test_fillable()
    {
        $expected = ['corporate_name',
        'fantasy_name',
        'cnpj',
        'state_registration',];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            LegalPersonEntityInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'corporate_name' => 'required|unique:legal_persons,corporate_name,',
            'fantasy_name' => 'required|unique:legal_persons,fantasy_name,',
            'cnpj' => 'required|cnpj|unique:legal_persons,cnpj,',
            'state_registration' => 'nullable'
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }

    }
