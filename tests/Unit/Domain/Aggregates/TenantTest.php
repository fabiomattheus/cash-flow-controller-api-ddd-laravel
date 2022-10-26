<?php

namespace Tests\Unit\Domain\Aggregates;

use Domain\Aggregates\Contracts\TenantAggregateInterface;
use Domain\Aggregates\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


class TenantTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new Tenant();

    }

    public function test_fillable()
    {
        $expected = [
            'logo',
            'personable_id',
            'personable_type'

        ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            TenantAggregateInterface::class,
            $this->model
        );
    }


    public function test_rules()
    {
        $expected = [
            'logo' => 'required',
            'personable_id' => 'required',
            'personable_type' => 'required',
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }
}