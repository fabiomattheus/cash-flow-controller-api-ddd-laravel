<?php

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Requester;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Domain\Entities\Contracts\RequesterEntityInterface;


class RequesterTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new Requester();
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
            RequesterEntityInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'photo' => 'required',
            'personable_id' => 'required',
            'personable_type' => 'required'
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }

    }