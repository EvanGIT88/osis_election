<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\Role;
use App\Enums\Major;
use App\Enums\Classes;

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
        /*
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum("role", Role::indexArray())->default("student");
            $table->bigInteger("nis")->unique();
            $table->enum("class", Classes::indexArray());
            $table->enum("major", Major::indexArray());
            $table->string("full_name");
            $table->rememberToken();
            $table->timestamps();
        */

                    $userRoles = Role::indexArray();
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => $userRoles[rand(1,2)],
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            "nis" => rand(1111111111111,9999999999999),
            "class" => Classes::TEN,
            "major" => Major::PPLG,
            "full_name" => fake()->name(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
