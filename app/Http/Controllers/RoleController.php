<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequestController;
use App\Http\Requests\RoleUpdateRequestController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $all = Role::all();
        return view('admin.role.index', compact('all'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * @param RoleRequestController $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoleRequestController $request)
    {
        Role::create($request->safe()->only(['name']));
        $message = 'created a new Role';
        return redirect(route('role.index'))->with('success', $message);
    }

    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }

    public function show()
    {
        return abort(404);
    }

    public function update(RoleUpdateRequestController $request, Role $role)
    {
        $role->update(['name' => $request->name]);
        $message = 'Updated a Role';
        return redirect(route('role.index'))->with('success', $message);
    }


    public function destroy()
    {
        return abort(404);
    }

}
