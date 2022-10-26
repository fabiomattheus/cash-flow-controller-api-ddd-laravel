<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Entities\PurchaseItem;
use Illuminate\Support\Facades\Validator;

class PurchaseItemValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var PurchaseItem $purchaseItem*/
        $this->model = $this->app->make('Domain\Entities\PurchaseItem');
    }
    /**
     * @dataProvider provideInvalidData
     */
    public function testInvalidData(array $data)
    {
        $validator = Validator::make($data, $this->model->rules());

        $this->assertFalse($validator->passes());
    }

    public function provideInvalidData()
    {
        return [
            [[]],
            [
                json_decode(json_encode($this->PurchaseItem()->setTenantId(123)->setPurchaseIdentifier(null)), true)
            ],
            [
                json_decode(json_encode($this->PurchaseItem()->setTenantId(123)->setProductId(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->PurchaseItem()->setTenantId(123)->setProductName(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->PurchaseItem()->setTenantId(123)->setProductBrand(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->PurchaseItem()->setTenantId(123)->setProductamount(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->PurchaseItem()->setTenantId(123)->setProductamount(0)->make()), true)
            ],
            [
                json_decode(json_encode($this->PurchaseItem()->setTenantId(123)->setProductamount('anything')->make()), true)
            ],
            [
                json_decode(json_encode($this->PurchaseItem()->setTenantid(null)->make()), true)
            ],

       ];
    }

       /**
     * @dataProvider provideValidData
     */
    public function testValidData(array $data)
    {
        $validator = Validator::make($data,$this->model->rules());

        $this->assertTrue($validator->passes());
    }

    public function provideValidData()
    {
        return [
            [
                json_decode(json_encode($this->PurchaseItem()->setTenantId(123)->make()), true)
            ],
         ];
    }
}
