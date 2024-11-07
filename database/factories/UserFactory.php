<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => null,
            'city' => $this->faker->optional()->city(),
            'email_verified_at' => $this->faker->optional()->dateTime(),
            'registration_date' => $this->faker->dateTimeBetween('2000-02-25', '2024-02-25'),
            'password' => bcrypt('password'),
            'status' => $this->faker->boolean(90),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

