<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Aggregates\ChatFile;
use Illuminate\Support\Facades\Validator;

class ChatFileValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var ChatFile $chatFile*/
        $this->model = $this->app->make('Domain\Aggregates\ChatFile');
    }
    /**
     * @dataProvider provideInvalidData
     */

    public function testInvalidData(array $data)
    {
    // dd($data);   
        $validator = Validator::make($data, $this->model->rules());

        $this->assertFalse($validator->passes());
    }

    public function provideInvalidData()
    {

        
        return [
            [[]],
            [
                json_decode(json_encode($this->chatFile()->setFilePath(null)->setChatId('123')->make()), true)
            ],
            [
                json_decode(json_encode($this->chatFile()->setChatId(null)->make()), true)
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
                $this->chatFile()->setChatId('2345')->make()->getAttributes()
            ],
        ];
    }
}
