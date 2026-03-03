<?php
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\OsisCandidate;

class IsTeamSlotAvailable implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public $role;
    public $isUpdate;
    public $candidate_id;

    public function __construct($role, $candidate_id = null, $isUpdate = false)
    {
      $this->role = $role;
      $this->candidate_id = $candidate_id;
      $this->isUpdate = $isUpdate;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        /*
         use construct to pass id
        Requirements: 
        1 team 2 user only , 
        all user unique (alr in validation), 
        2 user only consist of deputy and chairman,
        candidate team existed (alr in validation)
        */
      $candidates = OsisCandidate::where(["osis_candidate_team_id" => $value])->get(); 

      if ($this->isUpdate) {
        //why two model calling
        $candidates = OsisCandidate::where(["osis_candidate_team_id" => $value])->where('id', '!=', $this->candidate_id)->get(); 
      }

      $totalCandidates = $candidates->count();

      if ($totalCandidates > 1) {
         $fail('The team is full.');
      }
   //in many conditions laravel library functions can't treat/make enum properties the same
   /*
     ex:
     In OsisRole:
     case DEPUTY = 'deputy';
     case CHAIRMAN = 'chairman';
     dd($candidates[0]->role) :
         App\Enums\OsisRole {#728 ▼ // app\Rules\IsTeamSlotAvailable.php:51
         +name: "DEPUTY"
         +value: "deputy"
         }

      dd($this->role) :
      "deputy"

      The problem is if you trying to == operator this two, 
      it wont equal because laravel retrieve it as Class.
      So in some condition it returns Class some not. 

      ex:
        <td>{{ $candidate->role }}</td>
      
      In blade it will return in just "deputy"

      So, its recomended to put "->value" if something goes wrong, accessing the actual value.
   */
      if ($totalCandidates == 1 && $candidates[0]->role->value == $this->role) {
         $fail('The osis role in team occupied.');
      }
    }
}
