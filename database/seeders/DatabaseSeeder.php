<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\OsisCandidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use App\Models\OsisCandidateTeam;
use App\Enums\OsisRole;
use App\Enums\Pairs;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

    //creates candidate team with its chairman and deputy
    //starting ids
    $firstUserId = 1;
    $secondUserId = 2;
    $osisRole = OsisRole::indexArray();
    $pairs = Pairs::indexArray();
    for($i = 0; $i <= 2; $i++) {
   OsisCandidateTeam::factory(1)->create(["pair" => $pairs[$i]]); 
    }
    for ($i = 1; $i <= 3; $i++) {
       User::factory(2)->create(); //first id must be 1 and 2
       //now that two child table available, create the candidate
       OsisCandidate::factory(1)->create(['user_id' => $firstUserId, 'osis_candidate_team_id' => $i, 'role' => $osisRole[0]]);
       OsisCandidate::factory(1)->create(['user_id' => $secondUserId, 'osis_candidate_team_id' => $i,  'role' => $osisRole[1]]);
       //next must be 3 and 4, so add 2 every loop so it matches the user factory increment id
       $firstUserId += 2;
       $secondUserId += 2;
    }

    User::factory(50)
    ->create();

    for ($i = 1; $i <= 53; $i++) {
        Vote::factory(1)->create(['osis_candidate_team_id' => 1, 'user_id' => $i]);
    }

        User::factory(100)
    ->create();

    for ($i = 54; $i <= 153; $i++) {
        Vote::factory(1)->create(['osis_candidate_team_id' => 2, 'user_id' => $i]);
    }

    User::factory(80)
    ->create();

    //get the start $i = 154 from $i = total factory or factory(50) + 1
    //ex: last total is 153 then yu add 1 to get the start point for the next iteration or ($i)
    for ($i = 154; $i <= 233; $i++) {
        Vote::factory(1)->create(['osis_candidate_team_id' => 3, 'user_id' => $i]);
    }
    
    }
}
