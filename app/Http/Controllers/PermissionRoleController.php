<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use DB;

class PermissionRoleController extends Controller
{
    public function index($rol)
    {
        $role = Role::findOrFail($rol);
        $tablas = DB::select(
            "SELECT * FROM tabla");

        $permisos = DB::select(
            "SELECT * FROM permissions");

        $permisos_role = DB::select(
            "SELECT p.id, p.name, p.id_tabla 
            FROM permissions p 
            JOIN permission_role r 
            ON p.id = r.permission_id 
            WHERE r.role_id = ?", [$rol]);

        foreach ($permisos as $permiso) { 
            foreach($permisos_role as $pr) { 
                if($permiso->id == $pr->id){

                    unset($permisos[$permiso->id - 1]);

                }
            }
        }
        $data = Role::all();
        return view ('simpleViews.roles.permisos', [
            'permisos'=>$permisos,
            "permisos_role" => $permisos_role,
            "tablas" => $tablas,
            "role" => $role,
            'data' => $data]);
    }

    public function store()
    {
        $role = request('id_role');
        $permission = request('id_permiso');

        $cantidad = DB::select(
            "SELECT COUNT(id) 
            FROM public.permission_role 
            WHERE role_id = ? AND permission_id = ?", [$role, $permission]);

        foreach($cantidad as $c){
            if($c->count == 0){
                
                DB::table('permission_role')->insert([
                    ['permission_id' => $permission, 'role_id' => $role]
                ]);

                $usuarios = DB::select(
                    "SELECT user_id 
                    FROM public.role_user 
                    WHERE role_id = ?", [$role]);

                foreach($usuarios as $u){

                    $count = DB::select(
                        "SELECT COUNT(id) 
                        FROM public.permission_user 
                        WHERE user_id = ? AND permission_id = ?", [$u->user_id, $permission]);
            
                    foreach($count as $ct){
                        if($ct->count == 0){
                            DB::table('permission_user')->insert([
                                ['permission_id' => $permission, 'user_id' => $u->user_id]
                            ]);
                        }
                    }

                }

            }
        }
        return redirect()->route('roles.permissions', $role);
    }

    public function destroy()
    {
        $role = request('id_role');
        $permission = request('id_permiso');
        DB::table('permission_role')
        ->whereRaw("role_id = ? AND permission_id = ?", [$role, $permission])
        ->delete();

        $usuarios = DB::select(
            "SELECT user_id 
            FROM public.role_user 
            WHERE role_id = ?", [$role]);

        foreach($usuarios as $u){

            DB::table('permission_user')
            ->whereRaw("user_id = ? AND permission_id = ?", [$u->user_id, $permission])
            ->delete();

        }

        return redirect()->route('roles.permissions', $role);
    }
}
