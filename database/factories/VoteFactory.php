<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\OsisCandidateTeam;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /*
            $table->id();
             $table->unsignedBigInteger('osis_candidate_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('osis_candidate_id')->references('id')->on('osis_candidates')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
    */
    public function definition(): array
    {
        return [
            //
            'osis_candidate_team_id' => OsisCandidateTeam::class,
            'user_id' => User::class
        ];
    }
}
