<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Enums\Role;
use Illuminate\Validation\Rule;
use App\Enums\Classes;
use App\Enums\Major;
use Illuminate\Validation\Rules\Enum;

class UsersController extends Controller
{
    protected function gate() {
                if (! Gate::allows('check-role', ["superuser", "admin"])) {
             return view('abort');
        }
    }
    //
    public function index () {
        $this->gate();
        $users = User::all();
        return view('users.index', compact('users'));
    }


    public function createPage() {
        $this->gate();
    $roleEnum = Role::assArray();
        $classEnum = Classes::assArray();
            $majorEnum = Major::assArray();
       return view("users.create", compact("roleEnum", "classEnum", "majorEnum"));
    }

    public function updatePage(User $user) {
        $this->gate();
        $roleEnum = Role::assArray();
                $classEnum = Classes::assArray();
            $majorEnum = Major::assArray();
        return view('users.update', compact('user', "roleEnum", "classEnum", "majorEnum"));
    }

    protected function validator(array $data, null|string $type = null, null|int $id = null)
    {
                /*
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nis' => ['required','digits:10','unique:students'],
            'class'=> ['required', new Enum(Classes::class), 'string'],
            'major' => ['required', new Enum(Major::class), 'string'],
            'full_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'role' => [Rule::enum(Role::class)]
        ]);
        */
        return Validator::make($data, [
            
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore($id)],
            'password' => ['nullable','string', 'min:8', Rule::requiredIf($type == "create" )],
            'nis' => ['integer','required','digits:13', Rule::unique('users')->ignore($id)],
            'class'=> ['required', new Enum(Classes::class), 'string'],
            'major' => ['required', new Enum(Major::class), 'string'],
            'full_name' => 'required|regex:/^[\pL\s]+$/u|min:3', //CANNOT CONTAIN DOTS / ".", IGNORED CUZ HTML INPUT AUTOMATICALLY DELETES IT
            'role' => [Rule::enum(Role::class)]
        ]);
    }

    protected function create(Request $request)
    {
        $this->gate();
        $validated = $this->validator($request->all(), "create", null)->validate();
        User::create($validated);
        return redirect('/users/index')->with('status', 'User created!');
    }

    public function update(Request $request, $id){
        $this->gate();
        $validated = $this->validator($request->all(),null, $id)->validate();
        $user = User::find($id);
        if (!$user) {
        return back()->withErrors(['message' => 'User not found.']);
        } 
        $user->update(array_filter($validated));
        return redirect('/users/index')->with('status', 'User updated!');
    }

    public function delete ($id){
        $this->gate();
        $user = User::find($id);
        if (!$user) {
          return back()->withErrors(['message' => 'User not found.']);
        } 
        $user->delete();
        return redirect('/users/index')->with("status", "User deleted!");
    }

}
