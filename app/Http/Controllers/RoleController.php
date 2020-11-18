<?php

namespace App\Http\Controllers;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use DB;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Role::all();
        return view ('simpleViews.roles.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Role::all();
        return view ('simpleViews.roles.crear', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validacion de los datos      
        request()->validate([
            'name'=> 'required',
            'slug'=> 'required',
        ],
        [
            'name.required' => "El username es obligatorio.",
            'slug.required' => "El slug es obligatoria.",
        ]);
        

        //Se asignan las variables al nuevo role
        
        $rol = new Role();
        $rol->name = request('name');
        $rol->slug = request('slug');

        $rol->save();

        return redirect('/roles');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= Role::all();
       
        //Buscar el usuario con el id de entrada
        $role= Role::findOrFail($id);
        
        //Buscar nombre de rol y tipo de recurso
       //S $role=Role::findOrFail($->id_tipo);
        
        //Retornar la vista
        return view ('simpleViews.roles.show', [
            'role'=>$role,
            'data'=>$data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= Role::all();
    
        //Buscar rol
        $role= Role::findOrFail($id);
      
        return view ('simpleViews.roles.editar',[
            'role' => $role, 
            'data' => $data,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validacion de los datos      
        request()->validate([
            'name'=> 'required',
            'slug'=> 'required',
        ],
        [
            'name.required' => "El nombre es obligatorio.",
            'slug.required' => "El slug es obligatoria.",
        ]);      

        $role = Role::findOrFail($id);
        $role->name = request('name');
        $role->slug = request('slug');
        $role->save();

        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role= Role::findOrFail($id);
       
        DB::table('permission_role')->where('role_id', $id)->delete();
        DB::table('role_user')->where('role_id', $id)->delete();
        $role->delete();
        return redirect('/roles');
    }

    
}
