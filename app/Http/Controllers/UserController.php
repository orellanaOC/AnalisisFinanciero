<?php

namespace App\Http\Controllers;

use App\User;
use App\RolUsuario;
use Caffeinated\Shinobi\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(){
        $data = User::all();
        return view ('users.index',[
            'data' => $data
        ]);
    }

    public function create(){
        $roles = DB::select('SELECT * FROM roles');
        $data = User::all();
        return view ('users.crear', [
            'roles'=> $roles, 
            'data' => $data
        ]);
    }

    public function store(){
         //Validacion de los datos      
        request()->validate([
            'name'=> 'required',
            'email'=> ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=> 'required',
            'rol' => 'required',
        ],
        [
            'name.required' => "El username es obligatorio.",
            'email.required' => "El email es obligatoria.",
            'password.required' => "Establecer contraseña.",
            'rol.required' => "Seleccione el rol.",
        ]);
      

        //Se asignan las variables al nuevo usuario
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        $role = Role::where('name', request('rol'))->first();;

        DB::table('role_user')->insert(
            array('role_id' => $role->id, 'user_id' => $user->id)
        );

        $objetos = DB::select('SELECT * FROM permission_role WHERE role_id = ?', [$role->id]);

        foreach ($objetos as $objeto) {
            DB::table('permission_user')->insert([
                'permission_id' => $objeto->permission_id,
                'user_id' => $user->id,
            ]);
        }

        return redirect('/users');

    }

    public function show($id)
    {
        $data= User::all();
       
        //Buscar el usuario con el id de entrada
        $user= User::findOrFail($id);
        
        //Retornar la vista
        return view ('users.show', [
            'user'=>$user,
            'data'=>$data,
        ]);
    }

    public function edit($id)
    {
        $data= User::all();
        $roles= DB::select('SELECT * FROM roles');
    
        //Buscar user y su respectivo rol
        $user= User::findOrFail($id);
        $roleuser= RolUsuario::where('user_id', $id)->first();
       
        return view ('users.editar',[
            'user'=>$user, 
            'roles' => $roles, 
            'data' => $data,
            'roleuser'=>$roleuser
            ]);
    }

    public function update($id){
        request()->validate([
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', Rule::unique('users')->ignore($id)],
            'rol' => 'required',
        ],
        [
            'name.required' => "El username es obligatorio.",
            'email.required' => "El email es obligatoria.",
            'rol.required' => "Seleccione el rol.",
        ]);
      

        //Modificar datos de usuario
        $user = User::findOrFail($id);

        $user->name=request('name');
        $user->email=request('email');
        if(!empty(request('password'))){
            $user->password=Hash::make(request('password'));
        }
        $user->save();

        $role = Role::where('name', request('rol'))->first();;

        DB::table('role_user')->where('user_id', $id)->update(['role_id' => $role->id]);

        $objetos = DB::select('SELECT * FROM permission_role WHERE role_id = ?', [$role->id]);

        //Borrado de permisos por cambio de rol
        DB::table('permission_user')->where('user_id', $id)->delete();
       
        foreach ($objetos as $objeto) {
            DB::table('permission_user')->insert([
                'permission_id' => $objeto->permission_id,
                'user_id' => $id,
            ]);
        }

        return redirect('/users');
    }

    public function destroy($id)
    {
        //dd($id);
        $user= User::findOrFail($id);
       
        DB::table('permission_user')->where('user_id', $id)->delete();
        DB::table('role_user')->where('user_id', $id)->delete();
        $user->delete();
        return redirect('/users');
    }

}
