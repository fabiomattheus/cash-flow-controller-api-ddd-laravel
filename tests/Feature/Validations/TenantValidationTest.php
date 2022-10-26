<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Aggregates\Tenant;
use Illuminate\Support\Facades\Validator;

class TenantValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var Tenant $tenant*/
        $this->model = $this->app->make('Domain\Aggregates\Tenant');
        $this->errors = json_decode(json_encode($this->Tenant()->setLogo('logo')->setPersonableId(null)), true);
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
                json_decode(json_encode($this->Tenant()->setLogo(null)), true)
            ],
            [
                json_decode(json_encode($this->Tenant()->setPersonableId(null)), true)
            ],
            [
                json_decode(json_encode($this->Tenant()->setPersonableType(null)), true)
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
                json_decode(json_encode($this->Tenant()->make()), true)
            ],
         ];
    }
}
