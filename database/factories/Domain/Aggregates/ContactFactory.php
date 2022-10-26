<?php

namespace Database\Factories\Domain\Aggregates;

use Domain\Aggregates\Contact;

use Illuminate\Database\Eloquent\factories\Factory;
class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => '2730904677',  
            'cell_phone' => '27999995534' ,
            'email' => 'fulano@gmail.com',
            'contactable_id' => '',
            'contactable_type' => '', 
        ];
    }    
}


