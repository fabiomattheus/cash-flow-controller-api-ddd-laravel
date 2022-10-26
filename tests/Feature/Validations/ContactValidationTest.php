<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Aggregates\Contact;
use Illuminate\Support\Facades\Validator;

class ContactValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var Contact $contact*/
        $this->model = $this->app->make('Domain\Aggregates\Contact');
        $this->errors = json_decode(json_encode($this->contact()->setCellPhone(null)->make()), true);
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
                json_decode(json_encode($this->contact()->setCellPhone(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->contact()->setEmail(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->contact()->setEmail('fabio@')->make()), true)
            ],
            [
                json_decode(json_encode($this->contact()->setPhone(null)->make()), true)
            ]
        ];
    }

    /**
     * @dataProvider provideValidData
     */
    public function testValidData(array $data)
    {
        $validator = Validator::make($data, $this->model->rules());

        $this->assertFalse($validator->passes());
    }

    public function provideValidData()
    {
        return [
            [
                json_decode(json_encode($this->contact()->make()), true)
            ],
        ];
    }
}
