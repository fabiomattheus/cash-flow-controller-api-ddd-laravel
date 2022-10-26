<?php
namespace Database\Factories\Domain\Entities;

use Domain\Entities\Help;

use Illuminate\Database\Eloquent\factories\Factory;
class HelpFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Help::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => 'Produto com defeito',
            'description' => 'text',
            'type' => 'sale',
            'requisition_type' => 'customer',
            'parent_id' => 'Menu',
        ];
    }
}
