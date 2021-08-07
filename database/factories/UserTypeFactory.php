<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Customer',
            'created_at' => '2021-04-01 00:00:00',
            'updated_at' => NULL,
        ];
    }
}
