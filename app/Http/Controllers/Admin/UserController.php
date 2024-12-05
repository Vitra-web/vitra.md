<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function selectRole() {
        $roleName = Auth::user()->role->name;
        if($roleName =='admin') {
            $roles=Role::query()->orderBy('sort_order')->get();
        }elseif($roleName =='content-manager')
            $roles=Role::whereIn('name',  ['content-manager', 'manager', 'user'])->orderBy('sort_order')->get();
        elseif($roleName =='director managers')
            $roles=Role::whereIn('name',  ['manager', 'user'])->orderBy('sort_order')->get();
        else  $roles=Role::where('name',  'user')->orderBy('sort_order')->get();
        return $roles;
    }
    public function index()
    {

        if(Auth::user()->role_id == 5) {
            $users = User::where('role_id', 3)->get();
        } else $users = User::all();
        $title = trans('panel.users');
        return view('panel.user.index', compact('users', 'title'));

    }
    public function create()
    {
        $title = trans('panel.add_user');
        $roles = $this->selectRole();

        return view('panel.user.create', compact( 'title', 'roles'));
    }
    public function show(User $user)
    {
        return view('panel.user.show', compact( 'user'));
    }
    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        $user = User::firstOrCreate(['email' => $data['email']], $data);

      if($user) {
          return redirect()->route('user');
      } else {
          return back()->with('flash_message_error', 'Utilizator n-a fost creat');
      }
    }

    public function edit(User $user)
    {
        $title = trans('panel.edit_user');
        $roles = $this->selectRole();

        return view('panel.user.edit', compact( 'title', 'roles', 'user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
//        dd($data);

        if(!isset($data['password'])) {
            unset($data['password']);
        }
        $user->update($data);
        if($user->role_id == 3) {
            return redirect()->route('statistic');
        } else  return redirect()->route('user');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('user');
    }
}
