<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Aggregates\Chat;
use Illuminate\Support\Facades\Validator;

class ChatValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var Chat $chat*/
        $this->model = $this->app->make('Domain\Aggregates\Chat');
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
                json_decode(json_encode($this->Chat()->setHelpRequestId('1234')->setNote(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->Chat()->setHelpRequestId(null)->make()), true)
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
                $this->chat()->setHelpRequestId('123')->make()->getAttributes()
            ],
        ];
    }
}
