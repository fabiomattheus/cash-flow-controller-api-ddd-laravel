<?php

namespace Tests\Unit\Domain\Aggregates;

use Domain\Aggregates\Address;
use Domain\Aggregates\Contracts\AddressAggregateInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


class AddressTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new Address();

    }

    public function test_fillable()
    {
        $expected = [
        'street',
        'district',
        'lat',
        'long',
        'zip_code',
        'complement',
        'number',
        'city',
        'state',
        'type',
        'addressable_type',
        'addressable_id',
    ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            AddressAggregateInterface::class,
            $this->model
        );
    }


    public function test_rules()
    {
        $expected = [
        'street'=> 'required',
        'district' => 'required',
        'lat' => 'required',
        'long' => 'required',
        'zip_code' => 'required',
        'complement' => 'required',
        'number' => 'nullable',
        'city' => 'required',
        'state' => 'required',
        'type' => 'required',
        'addressable_type'=> 'required',
        'addressable_id' => 'required',
    ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }
}
