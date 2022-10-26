<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Aggregates\Address;
use Illuminate\Support\Facades\Validator;

class AddressValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var Address $address*/
        $this->model = $this->app->make('Domain\Aggregates\Address');
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
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setStreet(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setNumber(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setDistrict(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setComplement(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setCity(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setState(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setType(null)), true)
            ],

            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setCity(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setState(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setZipCode(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setAddressableId(null)), true)
            ],

            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setAddressableType(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setLat(null)), true)
            ],
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                    ->setAddressableType('Customer')->setLong(null)), true)
            ],


        ];
    }
    /**
     * @dataProvider provideValidData
     */
    public function testValidData(array $data)
    {
        $validator = Validator::make($data, $this->model->rules());

        $this->assertTrue($validator->passes());
    }

    public function provideValidData()
    {
        return [
            [
                json_decode(json_encode($this->address()->setAddressableId('123')
                ->setAddressableType('Customer')->make()), true)
            ],
        ];
    }
}
