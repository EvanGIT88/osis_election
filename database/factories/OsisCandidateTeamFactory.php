<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Pairs;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OsisCandidate>
 */
class OsisCandidateTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /*
            $table->id();
            $table->unsignedBigInteger('user_id');
                       $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('vision');
                 $table->text('mission');
                       $table->timestamps();
    */
    public function definition(): array
    {
        return [
            //
            'vision' => fake()->name(),
            'mission' => fake()->name(),
            'pair' => Pairs::class
        ];
    }
}
