<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\OsisCandidateTeam;
use App\Enums\OsisRole;

class OsisCandidate extends Model
{
    //
    protected $table = 'osis_candidates';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'osis_candidate_team_id',
        'role'
    ];

       public function users(): HasOne
    {
        return $this->hasOne(User::class, "id");
    }

       public function osis_candidate_teams(): BelongsTo
    {
        return $this->belongsTo(OsisCandidateTeam::class, "id");
    }

        protected function casts(): array
    {
        return [
            'role' => OsisRole::class
        ];
    }


        public static function getRandomOsisCandidate() {
        return OsisCandidate::get("id")->random();
    }
}
