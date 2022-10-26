<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Entities\HelpRequest;
use Illuminate\Support\Facades\Validator;

class HelpRequestValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var HelpRequest $helpRequest*/
        $this->model = $this->app->make('Domain\Entities\HelpRequest');
        $this->errors = json_decode(json_encode($this->HelpRequest()->setIdentifier('Identifier')->setStatus(null)), true);
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
                json_decode(json_encode($this->HelpRequest()
                    ->setHelpId('123')->setPurchaseItemId('123')->setRequesterId('123')->setIdentifier(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->HelpRequest()->setHelpId('123')->setPurchaseItemId('123')->setRequesterId('123')->setStatus(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->HelpRequest()->setPurchaseItemId('123')->setRequesterId('123')->setHelpId(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->HelpRequest()->setHelpId('123')->setPurchaseItemId('123')->setRequesterId(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->HelpRequest()->setHelpId('123')->setRequesterId('123')->setPurchaseItemId(null)->make()), true)
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
                $this->HelpRequest()->setHelpId('123')->setPurchaseItemId('123')->setRequesterId('123')->make()->getAttributes()
            ]
        ];
    }
}
