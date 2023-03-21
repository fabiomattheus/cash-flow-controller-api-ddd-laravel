<?php
namespace Database\Factories\Domain\Entities;

use Illuminate\Database\Eloquent\factories\Factory;

use Domain\Entities\Employee;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'photo'=> 'photo',
            'personable_id' => Str::uuid(),
            'personable_type' => 'PhysicalPerson',
        ];
    }
}

