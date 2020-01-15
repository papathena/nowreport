<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\User\Entities\User;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
	
	/***** Start Here User Management *****/
	public function __construct() {
		$this->middleware(['auth', 'isAdmin']);	
	}
						   
	public function index() {
		$users = User::all(); 
        return view('user::users.index')->with('users', $users);	
	}
						   
	public function show() {
		return redirect('users');	
	}
						  
	public function edit($id) {
		$user = User::findOrFail($id);
		$roles = Role::get();
		return view('user::users.edit', compact('user', 'roles'));
	}

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);
        return redirect()->route('users.index');
    }
						   
	public function destroy($id) {
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()->route('users.index')
			->with('flash_message', 'User successfully deleted.');
	}

	public function listProviderUser(Request $request){
	  $users = User::orderBy('id','DESC')->paginate(5);
	 return view('user::users.list',compact('users'))->with('i', ($request->input('page', 1) - 1) * 5);;
	}

    /**
     * Display a listing of the resource.
     * @return Response
     */
    /*
    public function index()
    {
        return view('user::index');
    }
    */

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    /*
    public function create()
    {
        return view('user::create');
    }
    */

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    /*
    public function store(Request $request)
    {
    }
    */

    /**
     * Show the specified resource.
     * @return Response
     */
    /*
    public function show()
    {
        return view('user::show');
    }
    */

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    /*
    public function edit()
    {
        return view('user::edit');
    }
    */
    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    /*
    public function update(Request $request)
    {
    }
    */

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    /*
    public function destroy()
    {
    }
    */
}
