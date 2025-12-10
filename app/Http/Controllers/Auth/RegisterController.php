<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/home';

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
            'icnumber' => ['required', 'string', 'size:12'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255', 'in:Men,Women'],
            'contact' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'ic_docs' => ['required', 'pdf', 'max:10240'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $contact = (int) $data['contact'];

        $user = User::create([
            'role_id' => 3,
            'user_name' => $data['name'],
            'user_ic' => $data['icnumber'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_gender' => $data['gender'],
            'user_contact' => $contact,
            'user_verification' => isset($path) ? $path : 'path',
        ]);

        if (request()->hasFile('ic_docs')) {
            $file = request()->file('ic_docs');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('Parent Verification', $fileName, 'public');
            $user->user_verification = $path;
            $user->save();
        }

        return $user;
    }
}