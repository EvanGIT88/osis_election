<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\OsisCandidateTeam;
use App\Enums\OsisRole;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OsisCandidate>
 */
class OsisCandidateFactory extends Factory
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
            'user_id' => User::class,
            'osis_candidate_team_id' => OsisCandidateTeam::class,
             'role' => OsisRole::class,
        ];
    }
}
