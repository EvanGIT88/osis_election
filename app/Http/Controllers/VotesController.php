<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\OsisCandidate;
use App\Enums\OsisRole;
use App\Models\User;
use App\Models\Vote;
use App\Models\OsisCandidateTeam;
use App\Rules\IsTeamSlotAvailable;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Enums\Pairs;

//REMINDER: CHANGE $user to $osisCandidate in future
class VotesController extends Controller
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

          protected $fillable = [
        'osis_candidate_team_id',
        'user_id',
    ];
    */
        protected function gate() {
                if (! Gate::allows('check-role', ["superuser", "admin"])) {
             return view('abort');
        }
    }
    //
    public function index () {
        $this->gate();
        $votes = Vote::all();
        return view('votes.index', compact( 'votes'));
    }

    public function createPage() {
         $this->gate();
       $teams = OsisCandidateTeam::all();
       $users = User::all();
       return view("votes.create", compact("teams", "users"));
    }

    public function updatePage(Vote $vote) {
        $this->gate();
       $teams = OsisCandidateTeam::all();
       $users = User::all();
        return view('votes.update', compact('vote', "users", "teams"));
    }

    //this validator immune to create&update&pick function, it still filters shii
    public function validator(array $data, null|string $type = null, null|int $id = null)
    {
        $validated = Validator::make($data, [
        'osis_candidate_team_id' => ['required', 'integer', 'exists:osis_candidate_teams,id'],
        'user_id' => ['required', 'integer', 'exists:users,id',  Rule::unique("votes", "user_id")->ignore($id)]
        ])->validate();

        return $validated;
    }

    protected function create(Request $request)
    {
        $this->gate();
       $validated = $this->validator($request->all());
       Vote::create($validated);
       return redirect('/votes/index')->with('status', 'Vote created!');
    }

    public function update(Request $request, $id){
        $this->gate();
       $validated = $this->validator($request->all(),true, $id);
        $user = Vote::find($id);
        if (!$user) {
        return back()->withErrors(['message' => 'Osis Candidate not found.']);
        } 
        $user->update(array_filter($validated));
        return redirect('/votes/index')->with('status', 'Vote updated!');
    }

    public function delete ($id){
        $this->gate();
        $user = Vote::find($id);
        if (!$user) {
          return back()->withErrors(['message' => 'Vote not found.']);
        } 
        $user->delete();
        return redirect('/votes/index')->with("status", "Vote deleted!");
    }

        public function pick ($teamId){
        $team = OsisCandidateTeam::find($teamId);
        if (!$team) {
          return back()->withErrors(['message' => 'Team not found.']);
        } 

        $constructedRequest = [
            "osis_candidate_team_id" => $team->id,
            "user_id" => Auth::id()
        ];

        $validated = $this->validator($constructedRequest);
        Vote::create($validated);
        return redirect('/pick-page')->with("status", "Voted!");
    }

        public function pickPage () {
        $teams = OsisCandidateTeam::all();
        return view('pick-team', compact( 'teams'));
    }

     public function statisticsPage () {
        $this->gate();
        //this can be better by using foreach so itsnot hardcoded like this
        $pairOne = OsisCandidateTeam::where(["pair" => Pairs::ONE])->first();
        $pairTwo = OsisCandidateTeam::where(["pair" => Pairs::TWO])->first();
        $pairThree = OsisCandidateTeam::where(["pair" => Pairs::THREE])->first();

        $voteOne = $pairOne ? Vote::where(["osis_candidate_team_id" => $pairOne->id])->count() : "Team Unavailable";
        $voteTwo = $pairTwo ? Vote::where(["osis_candidate_team_id" => $pairTwo->id])->count() : "Team Unavailable";
        $voteThree = $pairThree ? Vote::where(["osis_candidate_team_id" => $pairThree->id])->count() : "Team Unavailable";
        return view('statistics', compact( 'voteOne', "voteTwo", "voteThree"));
     }
}
