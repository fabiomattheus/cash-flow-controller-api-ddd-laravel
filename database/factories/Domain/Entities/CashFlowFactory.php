<?php
namespace Database\Factories\Domain\Entities;

use Carbon\Carbon;
use Domain\Aggregates\OperationType;
use Illuminate\Database\Eloquent\factories\Factory;

use Domain\Entities\CashFlow;
use Domain\Entities\Departament;
use Domain\Entities\Employee;

class CashFlowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CashFlow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'identifier' => 'identifier',
            'description' => 'text',
            'type' => 'all',
            'value' => 10.00,
            'note' => 'text',
            'movimentation_date' => Carbon::now()->format('Y-m-d'),
            'departament_id' => Departament::factory(),
            'operation_type_id' => OperationType::factory(),
            'employee_id' => Employee::factory(),
        ];
    }
}
