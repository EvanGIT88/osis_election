<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\OsisCandidate;

class Vote extends Model
{
        protected $table = 'votes';
    use HasFactory;
    /*
            $table->id();
             $table->unsignedBigInteger('osis_candidate_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('osis_candidate_id')->references('id')->on('osis_candidates')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
    */
    //
      protected $fillable = [
        'osis_candidate_team_id',
        'user_id',
    ];

    public function osisCandidateTeam(): BelongsTo
    {
        return $this->belongsTo(OsisCandidateTeam::class);
    }

        public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
