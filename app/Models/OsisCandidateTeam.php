<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\Pairs;

class OsisCandidateTeam extends Model
{
    //
    protected $table = 'osis_candidate_teams';
    use HasFactory;

    protected $fillable = [
        'vision',
        'mission',
        'pair'
    ];

        protected function casts(): array
    {
        return [
            'pair' => Pairs::class
        ];
    }
}
