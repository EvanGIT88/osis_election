<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\OsisCandidate;
use App\Enums\OsisRole;
use App\Models\User;
use App\Models\OsisCandidateTeam;
use App\Rules\IsTeamSlotAvailable;

use App\Enums\Role;
use Illuminate\Validation\Rule;
use App\Enums\Classes;
use App\Enums\Major;
use Illuminate\Validation\Rules\Enum;

//REMINDER: CHANGE $user to $osisCandidate in future
class OsisCandidatesController extends Controller
{
    //
    /*
    protected $fillable = [
        'user_id',
        'osis_candidate_team_id',
        'role'
    ];

       public function users(): HasOne
    {
        return $this->hasOne(User::class);
    }

       public function osis_candidate_teams(): BelongsTo
    {
        return $this->belongsTo(OsisCandidateTeam::class);
    }
    */
        protected function gate() {
                if (! Gate::allows('check-role', ["superuser", "admin"])) {
             return view('abort');
        }
    }
    //
    public function index () {
        $this->gate();
        $osisCandidates = OsisCandidate::all();
        return view('osis-candidates.index', compact('osisCandidates'));
    }

    public function createPage() {
        $this->gate();
       $osisRole = OsisRole::assArray();
       $teams = OsisCandidateTeam::all();
       $users = User::all();
       return view("osis-candidates.create", compact("osisRole", "teams", "users"));
    }

    public function updatePage(OsisCandidate $osisCandidate) {
        $this->gate();
        $osisRole = OsisRole::assArray();
       $teams = OsisCandidateTeam::all();
       $users = User::all();
        return view('osis-candidates.update', compact('osisCandidate', "osisRole", "teams", "users"));
    }

    public function validator(array $data, null|string $type = null, null|int $id = null)
    {
        $validated = Validator::make($data, [
         'user_id' => ['required', 'integer', 'exists:users,id', Rule::unique('osis_candidates')->ignore($id)],
         'role' => ['required', Rule::enum(OsisRole::class)],
         'osis_candidate_team_id' => ['required', 'integer', 'exists:osis_candidate_teams,id', new IsTeamSlotAvailable($data["role"], $id, $type) ],
        ])->validate();

        return $validated;
    }

    protected function create(Request $request)
    {
        $this->gate();
       $validated = $this->validator($request->all());
       OsisCandidate::create($validated);
       return redirect('/osis-candidates/index')->with('status', 'Candidate created!');
    }

    public function update(Request $request, $id){
        $this->gate();
       $validated = $this->validator($request->all(),true, $id);
        $user = OsisCandidate::find($id);
        if (!$user) {
        return back()->withErrors(['message' => 'Osis Candidate not found.']);
        } 
        $user->update(array_filter($validated));
        return redirect('/osis-candidates/index')->with('status', 'Osis Candidate updated!');
    }

    public function delete ($id){
        $this->gate();
        $user = OsisCandidate::find($id);
        if (!$user) {
          return back()->withErrors(['message' => 'Osis Candidate not found.']);
        } 
        $user->delete();
        return redirect('/osis-candidates/index')->with("status", "Osis Candidate deleted!");
    }
}
