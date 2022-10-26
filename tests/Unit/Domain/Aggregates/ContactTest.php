<?php

namespace Tests\Unit\Domain\Aggregates;

use Domain\Aggregates\Contact;
use Domain\Aggregates\Contracts\ContactAggregateInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new Contact();
        $this->request = new Request();


    }

    public function test_fillable()
    {
        $expected = ['phone', 'cell_phone', 'email', 'contactable_id', 'contactable_type'];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            ContactAggregateInterface::class,
            $this->model
        );
    }


    public function test_rules()
    {
        $expected = ['phone' => 'nullable',
        'cell_phone' => 'required',
        'email' => 'required|email',
        'contactable_id' => 'required',
        'contactable_type' => 'required',];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }




    

    // public function test_validate_rules()
    // {
    //     $this->request->merge([
    //         'phone' => null,
    //         'cell_phone' => null,
    //         'email' => Str::random(50),
    //         'contactable_id' => Str::uuid(),
    //         'contactable_type' => 'anything',
    //     ]); 
        
    //     // App::shouldReceive('make')
    //     //     ->once()
    //     //     ->andReturn($this->request);

        
    //     $validator = Validator::make($this->request->only($this->model->getfillable()), $this->model->rules());

    //     // if ($validator->fails()) {
    //     //     throw new ValidationException($validator);
    //     // }

        
    //   $this->assertTrue($validator->fails());

    //   $expected = ['cell_phone' => str::random(10)];

    // }
    
}
