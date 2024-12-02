<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $title = 'Role';
        return view('panel.role.index', compact('roles', 'title'));

    }
    public function create()
    {
        $title = 'Adauga Categorie';
        return view('panel.category.create', compact( 'title'));
    }
    public function show(User $user)
    {
//        $manager = User::where('id', $user->manager_id)->first();
//        return view('user.manager.show', compact('user', 'manager'));
    }
    public function store(Request $request)
    {

    }

    public function edit(User $user)
    {

    }

    public function update(Request $request, User $user)
    {


    }

    public function delete(User $user)
    {

        $user->delete();
        return redirect()->route('manager.index');
    }
}
