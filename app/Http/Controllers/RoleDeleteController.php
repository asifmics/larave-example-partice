<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Role::where("id", $request->modal_id)->delete();
        $message = 'Deleted a Role';
        return redirect(route('role.index'))->with('success', $message);
    }
}
