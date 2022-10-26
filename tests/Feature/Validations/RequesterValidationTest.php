<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Entities\Requester;
use Illuminate\Support\Facades\Validator;

class RequesterValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var Requester $requester*/
        $this->model = $this->app->make('Domain\Entities\Requester');
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
                json_decode(json_encode($this->Requester()->setPhoto(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->Requester()->setPersonableId(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->Requester()->setPersonableType(null)->make()), true)
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
                json_decode(json_encode($this->Requester()->make()), true)
            ],
         ];
    }
}
