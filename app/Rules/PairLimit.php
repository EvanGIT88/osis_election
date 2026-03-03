<?php
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\OsisCandidateTeam;

//REMINDER: EXCEPTION IN THIS RULES IS NOT CATCHED BY LARAVEL
class PairLimit implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public $team_id;

    public function __construct($team_id = null)
    {
      $this->team_id = $team_id;
    }

  public function validate(string $attribute, mixed $value, Closure $fail): void
{
    $totalTeam = OsisCandidateTeam::where('id', '!=', $this->team_id)
        ->count();

    if ($totalTeam >= 3) {
        $fail('The maximum number of teams for this pair is 3.');
    }
}
}
