<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'name' => $this->faker->name,
			'email' => $this->faker->unique()->safeEmail,
			'type' => $this->faker->randomElement(['admin', 'user']),
			'password' => bcrypt('1234'), // password
			// 'remember_token' => \str()->random(10),
		];
	}
}
