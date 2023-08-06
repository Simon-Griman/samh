<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit($id)
    {
        $user = User::find($id);

        $roles = Role::all();

        $myuser = Auth::User();

        $rolUsers = $myuser->getRoleNames();

        $superAdminRol = false;
        $adminRol = false;
        $cont = 1;

        foreach($rolUsers as $rolUser){
            if ($rolUser == 'Super-Admin'){
                $superAdminRol = true;
                break;
            }
            elseif ($rolUser == 'Admin'){
                $adminRol = true;
                break;
            }
        }

        return view('users.edit', compact('user', 'roles', 'superAdminRol', 'adminRol', 'cont'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->roles()->sync($request->roles);

        return redirect()->route('users.edit', $user)->with('info', 'Se asigno los roles correctamente');
    }
}
