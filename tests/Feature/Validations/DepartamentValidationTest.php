<?php

namespace Tests\Feature\Validations;

use Tests\TestCase;
use Domain\Entities\Departament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class DepartamentValidationTest extends TestCase
{
    protected $model;
    protected $departamentCreated;
    protected $request;
    public function setUp(): void
    {
        parent::setUp();
        /** @var Departament $departament*/
        $this->model = $this->app->make('Domain\Entities\Departament');
        $this->request =  App::make(Request::class);
        $this->departamentCreated =  $this->departament()->setTitle('unique')->create();
    }
    /**
     * @dataProvider provideInvalidAddData
     */

    public function testInvalidAddData(array $data)
    {
        $validator = Validator::make($data, $this->model->rules());

        $this->assertFalse($validator->passes());
    }

    public function provideInvalidAddData()
    {
        return [
            [[]],
            [
                $this->departament()->setTitle(null)->make()->getAttributes()
            ],
            [
                $this->departament()->setTitle('')->make()->getAttributes()
            ],
            [
                $this->departament()->setTitle('unique')->make()->getAttributes()
            ],
            [
                $this->departament()->setTitle('Lorem ipsum dolor sit amet . The graphic and typographic operators know this well, in reality all the professions dealing with the universe of communication have a stable relationship with these words, but what is it? Lorem ipsum is a dummy text without any sense.')->make()->getAttributes()
            ],
        ];
    }
    /**
     * @dataProvider provideAddValidData
     */
    public function testAddValidData(array $data)
    {
        $validator = Validator::make($data, $this->model->rules());
        $this->assertTrue($validator->passes());
    }

    public function provideAddValidData()
    {
        return [

            [
                $this->departament()->make()->getAttributes()
            ],

        ];
    }

    /**
     * @dataProvider provideUpdateValidData
     */
    public function testUpdateValidData(array $data)
    {
        $this->request->merge(['id' => $this->departamentCreated->id]);
        $data = array_merge($data, $this->request->all());
        $validator = Validator::make($data, $this->model->rules());
        $this->assertTrue($validator->passes());
    }

    public function provideUpdateValidData()
    {
        return [

            [
                $this->departament()->make()->getAttributes()
            ],

            [
                $this->departament()->setTitle('New Title')->make()->getAttributes()
            ],

            [
                $this->departament()->setTitle('unique')->make()->getAttributes()
            ],
        ];
    }

    /**
     * @dataProvider provideValidUpdateData
     */
    public function testValidUpdateData(array $data)
    {
        $this->request->merge(['id' => $this->departamentCreated->id]);
        $data = array_merge($data, $this->request->all());
        $validator = Validator::make($data, $this->model->rules());
        $this->assertTrue($validator->passes());
    }

    public function provideValidUpdateData()
    {
        return [
            [
                $this->departament()->make()->getAttributes()
            ],

        ];
    }
}
