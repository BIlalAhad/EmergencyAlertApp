<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'organization_id' => ['nullable', 'exists:organizations,id'],
        ]);
    }

    /**
     * Display the registration view.
     */
    public function showRegistrationForm()
    {
        $organizations = Organization::all();
        return view('auth.register', compact('organizations'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // $user = new User;
        // $User->name = $data['name'];
        // $User->email = $data['email'];
        // $User->password = Hash::make($data['password']);
        // $User->organization_id = $data['organization_id'];
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];
        
        // Check if 'organization_id' key exists in $data
        if (isset($data['organization_id'])) {
            $userData['organization_id'] = $data['organization_id'];
        }
        
        $user = User::create($userData);
        
        $user->assignRole('user');
        return $user;
    }
}