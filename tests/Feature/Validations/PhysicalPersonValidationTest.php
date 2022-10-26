<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Entities\PhysicalPerson;
use Illuminate\Support\Facades\Validator;

class PhysicalPersonValidationTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        /** @var PhysicalPerson $physicalPerson*/
        $this->model = $this->app->make('Domain\Entities\PhysicalPerson');
        $this->physicalPerson()->setCpf('60053680014')->create();
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
                json_decode(json_encode($this->physicalPerson()->setCpf(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setCpf('11111111111')->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setCpf('00000000000')->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setCpf('60053680014')->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setCpf('123')->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setName(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setName(1234)->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setLastName(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setLastName(1234)->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setMotherName(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setMotherName(1234)->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setFatherName(null)->make()), true)
            ],
            [
                json_decode(json_encode($this->physicalPerson()->setFatherName(1234)->make()), true)
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
                json_decode(json_encode($this->physicalPerson()->make()), true)
            ],
         ];
    }
}
