<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Entities\Help;
use Illuminate\Support\Facades\Validator;

class HelpValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var Help $help*/
        $this->model = $this->app->make('Domain\Entities\Help');
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
                json_decode(json_encode($this->Help()->setLabel(null)), true)
            ],
            [
                json_decode(json_encode($this->Help()->setDescription(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->Help()->setType(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->Help()->setParentId(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->Help()->setRequisitionType(null)->make()), true)
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
                json_decode(json_encode($this->Help()->make()), true)
            ],
         ];
    }
}
