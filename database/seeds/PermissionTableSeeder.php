<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*-------------------------------------- users ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'users.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 1,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'users.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 1,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'users.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 1,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'users.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 1,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'users.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 1,
        ]);


    /*-------------------------------------------------------------------------------------------------*/
    
    /*-------------------------------------- permission_user ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'permission_user.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 2,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'permission_user.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 2,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'permission_user.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 2,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'permission_user.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 2,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'permission_user.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 2,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- permission_role ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'permission_role.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 3,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'permission_role.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 3,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'permission_role.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 3,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'permission_role.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 3,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'permission_role.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 3,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- role ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'role.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 4,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'role.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 4,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'role.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 4,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'role.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 4,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'role.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 4,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- role_user ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'role_user.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 5,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'role_user.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 5,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'role_user.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 5,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'role_user.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 5,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'role_user.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 5,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- sector ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'sector.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 6,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'sector.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 6,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'sector.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 6,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'sector.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 6,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'sector.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 6,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- empresa ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'empresa.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 7,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'empresa.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 7,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'empresa.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 7,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'empresa.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 7,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'empresa.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 7,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- periodo ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'periodo.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 8,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'periodo.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 8,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'periodo.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 8,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'periodo.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 8,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'periodo.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 8,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- balance_general ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'balance_general.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 9,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'balance_general.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 9,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'balance_general.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 9,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'balance_general.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 9,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'balance_general.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 9,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- estado_resultado ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'estado_resultado.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 10,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'estado_resultado.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 10,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'estado_resultado.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 10,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'estado_resultado.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 10,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'estado_resultado.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 10,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- tipo_cuenta ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'tipo_cuenta.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 11,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'tipo_cuenta.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 11,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'tipo_cuenta.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 11,
        ]);
    
        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'tipo_cuenta.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 11,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'tipo_cuenta.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 11,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- cuenta ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'cuenta.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 12,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'cuenta.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 12,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'cuenta.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 12,
        ]);

        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'cuenta.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 12,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'cuenta.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 12,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- cuenta_periodo ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'cuenta_periodo.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 13,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'cuenta_periodo.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 13,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'cuenta_periodo.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 13,
        ]);

        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'cuenta_periodo.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 13,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'cuenta_periodo.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 13,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- tipo_parametro ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'tipo_parametro.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 14,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'tipo_parametro.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 14,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'tipo_parametro.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 14,
        ]);

        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'tipo_parametro.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 14,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'tipo_parametro.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 14,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- parametro ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'parametro.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 15,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'parametro.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 15,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'parametro.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 15,
        ]);

        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'parametro.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 15,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'parametro.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 15,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- analisis ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'analisis.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 16,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'analisis.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 16,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'analisis.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 16,
        ]);

        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'analisis.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 16,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'analisis.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 16,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    /*-------------------------------------- razon ---------------------------------------------------*/
        
        Permission::create([
            'name'          => 'Crear',
            'slug'          => 'razon.create',
            'description'   => 'Crea un registro',
            'id_tabla' => 17,
        ]);

        Permission::create([
            'name'          => 'Navegar',
            'slug'          => 'razon.index',
            'description'   => 'Navega todos los registros',
            'id_tabla' => 17,
        ]);

        Permission::create([
            'name'          => 'Ver detalle',
            'slug'          => 'razon.show',
            'description'   => 'Ver detalles de un registro',
            'id_tabla' => 17,
        ]);

        Permission::create([
            'name'          => 'Editar',
            'slug'          => 'razon.edit',
            'description'   => 'Edita los datos de un registro',
            'id_tabla' => 17,
        ]);

        Permission::create([
            'name'          => 'Eliminar',
            'slug'          => 'razon.destroy',
            'description'   => 'Elimina un registro',
            'id_tabla' => 17,
        ]);


    /*-------------------------------------------------------------------------------------------------*/

    }
}
