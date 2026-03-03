<?php

namespace App\Http\Controllers;

use App\Rules\PairLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\OsisCandidateTeam;
use App\Enums\Pairs;
use Illuminate\Validation\Rule;

//REMINDER: CHANGE $user to $candidateTeam in future
class OsisCandidateTeamsController extends Controller
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
        $osisCandidateTeams = OsisCandidateTeam::all();
        return view('osis-candidate-teams.index', compact('osisCandidateTeams'));
    }

    public function createPage() {
        $this->gate();
        $pairs = Pairs::assArray();
       return view("osis-candidate-teams.create", compact("pairs"));
    }

    public function updatePage(OsisCandidateTeam $osisCandidateTeam) {
        $this->gate();
                $pairs = Pairs::assArray();
        return view('osis-candidate-teams.update', compact('osisCandidateTeam', "pairs"));
    }

    public function validator(array $data, null|int $id = null): array
     {
         $validated = Validator::make($data, [
          'vision' => 'required|regex:/^[\pL\s]+$/u|min:20|max:50',
          'mission' => 'required|regex:/^[\pL\s]+$/u|min:20|max:50',
           'pair' => ['required', Rule::enum(Pairs::class), new PairLimit($id), Rule::unique("osis_candidate_teams", "pair")->ignore($id)]
         ])->validate();

         return $validated;
    }

    protected function create(Request $request)
     {
        $this->gate();
    $validated = $this->validator($request->all());

        OsisCandidateTeam::create($validated);
    return redirect('/osis-candidate-teams/index')->with('status', 'Candidate Team created!');
    }

    public function update(Request $request, $id){
        $this->gate();
       $validated = $this->validator($request->all(), $id);
        $user = OsisCandidateTeam::find($id);
        if (!$user) {
        return back()->withErrors(['message' => 'Candidate Team not found.']);
        } 
        $user->update(array_filter($validated));
        return redirect('/osis-candidate-teams/index')->with('status', 'Candidate Team updated!');
    }

    public function delete ($id){
        $this->gate();
        $user = OsisCandidateTeam::find($id);
        if (!$user) {
          return back()->withErrors(['message' => 'Candidate Team not found.']);
        } 
        $user->delete();
        return redirect('/osis-candidate-teams/index')->with("status", "Candidate Team deleted!");
    }
}
