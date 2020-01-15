<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\User\Entities\User;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); 
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('user::permissions.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('user::permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Permission::create($request->all());
        return redirect()->route('permissions.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('user::permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
