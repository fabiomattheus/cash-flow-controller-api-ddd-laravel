<?php

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Contracts\PurchaseItemEntityInterface;
use Domain\Entities\Help;
use Domain\Entities\PurchaseItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


class PurchaseItemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new PurchaseItem();
    }

    public function test_fillable()
    {
        $expected = [
            'purchase_identifier',
            'product_id',
            'product_name',
            'product_brand',
            'product_amount',
            'tenant_id',
    ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            PurchaseItemEntityInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'purchase_identifier' => 'required',
            'product_id' => 'required',
            'product_name' => 'required',
            'product_brand' => 'required',
            'product_amount' => 'required|integer|min:1',
            'tenant_id' => 'required',
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }

    }
