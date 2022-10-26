<?php

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Contracts\HelpEntityInterface;
use Domain\Entities\Help;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


class HelpTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new Help();
    }

    public function test_fillable()
    {
        $expected = [
        'label',
        'description',
        'type',
        'requisition_type',
        'parent_id'
    ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            HelpEntityInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'label' => 'required|unique:helps,label',
            'description' => 'required',
            'type' => 'required',
            'requisition_type'=> 'required',
            'parent_id' => 'sometimes|required'
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }

    }
