<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Enums\Role;
use Illuminate\Validation\Rule;
use App\Enums\Classes;
use App\Enums\Major;
use Illuminate\Validation\Rules\Enum;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
                $classesEnum = Classes::assArray();
        $majorEnum = Major::assArray();
        return view('tablar::auth.register', compact("classesEnum", "majorEnum"));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    protected function validator(array $data)
    {
        /*
            $table->bigInteger("nis")->unique();
            $table->string("class");
            $table->string("major");
            $table->string("full_name");
        */
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nis' => ['required','digits:13','unique:users'],
            'class'=> ['required', new Enum(Classes::class), 'string'],
            'major' => ['required', new Enum(Major::class), 'string'],
            'full_name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'role' => [Rule::enum(Role::class)]
        ]);
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validator($request->all())->validate();

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('pick-page',  absolute: false));
    }
}
