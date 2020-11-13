<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Sector;
use App\Empresa;

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
            'nombre' => ['required', 'string', 'max:255', 'unique:empresa'],
            'nit' => ['required', 'max:14', 'unique:empresa'],
            'nrc' => ['required',  'max:14', 'unique:empresa'],
        ],
        [
            'name.required' => "El nombre de usuario es requerido.",
            'email.required' => "El correo electrónico es requerido.",
            'password.required' => "La contraseña es obligatoria",
            'nit.required' => "Ingrese el NIT con el formato correcto.",
            'nrc.required' => "Ingrese el NRC con el formato correcto.",
            'empresa.required' => "El nombre de la empresa es requerido.",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function showRegistrationForm()
    {
        $sectores = Sector::all();
        return view("auth.register", [
            "sectores" => $sectores
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        //Para asignar rol a usuario
        DB::table('role_user')->insert([
            'role_id' => 2, 'user_id' => $user->id
        ]);

        $objetos = DB::select('SELECT * FROM permission_role WHERE role_id = 2');

        foreach ($objetos as $objeto) {
            DB::table('permission_user')->insert([
                'permission_id' => $objeto->permission_id,
                'user_id' => $user->id,
            ]);
        }

        $empresa = new Empresa();
        $empresa->nombre = $data['nombre'];
        $empresa->nit = $data['nit'];
        $empresa->nrc = $data['nrc'];
        $empresa->sector_id = $data['sector'];
        $empresa->user_id = $user->id;
        $empresa->save();

        return $user;
    }
}
