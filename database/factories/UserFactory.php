<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomNumber = fake()->unique()->numberBetween(1, 999);
        return [
            'name' => fake()->name(),
            'user_code' => fake()->unique()->numerify('P00'.$randomNumber),
            'username' => fake()->unique()->userName(),
            'password' => Hash::make('pengguna'),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'thumbnail' => fake()->imageUrl(),
            'birthday' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'is_active' => fake()->boolean(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
            'is_active' => false,
        ]);
    }
}
