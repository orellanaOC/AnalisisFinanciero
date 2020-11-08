<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Sector;
use App\Empresa;
use Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user()->id;
        $sectores = Sector::all();
        $empresa = Empresa::where('user_id', $user)->first();
        return view('profile.edit', [
            "sectores" => $sectores,
            "empresa" => $empresa
        ]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Perfil actualizado correctamente.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Contraseña actualizada correctamente.'));
    }

    public function empresa()
    {
        $user = Auth::user()->id;
        $empresa = Empresa::where('user_id', $user)->first();
        $empresa->nombre = request('empresa');
        $empresa->nit = request('nit');
        $empresa->nrc = request('nrc');
        $empresa->sector_id = request('sector');
        $empresa->user_id = $user;
        $empresa->save();

        return back()->with('empresa_status','Empresa actualizada correctamente.');
    }
}
