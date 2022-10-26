<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Entities\LegalPerson;
use Illuminate\Support\Facades\Validator;

class LegalPersonValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var LegalPerson $legalPerson*/
        $this->model = $this->app->make('Domain\Entities\LegalPerson');
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
                json_decode(json_encode($this->LegalPerson()->setCnpj(null)), true)
            ],
            [
                json_decode(json_encode($this->LegalPerson()->setCnpj(null)), true)
            ],
            [
                json_decode(json_encode($this->LegalPerson()->setCorporateName(null)), true)
            ],
            [
                json_decode(json_encode($this->LegalPerson()->setStateRegistration(null)), true)
            ],
            [
                json_decode(json_encode($this->LegalPerson()->setCnpj('94.754.675/0001-70')), true)
            ],
            [
                json_decode(json_encode($this->LegalPerson()->setCorporateName('CorporateName')), true)
            ],
            [
                json_decode(json_encode($this->LegalPerson()->setFantasyName('FantasyName')), true)
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
                json_decode(json_encode($this->LegalPerson()->make()), true)
            ],
        ];
    }
}
