<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

//changesd code from userlogin controller to user just alternated the code 
class UserController extends Controller
{

    // Display user list
    
        public function list(): View
{
    $result = User::with('roles')->get();
    $roles = Role::pluck('name','id')->all(); // id => name
    return view('user.user', compact('result', 'roles'));
}

        
    public function create()
{
    $roles = Role::pluck('name', 'id');
    return view('user.user', compact('roles'));
}


    // Show edit form
    public function edit($id): View|RedirectResponse
    {
        $userdata = User::find($id);
        if (!$userdata) {
            return redirect('/user')->with('error', 'User not found');
        }

        $roles = Role::pluck('name', 'name')->all();
        $result = User::all();
        // Fetch the roles assigned to the user
$userRole = $userdata->roles->pluck('id')->toArray();


        return view('user.user', compact('userdata', 'result', 'roles', 'userRole'))->with('openModal', true);
        $result = User::all();
    }

    // Update user
    public function update(Request $request, $id): RedirectResponse
{
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'roles' => 'required',
        'password' => 'nullable|same:confirm-password',
    ]);

    $data = User::find($id);
    $data->name = $request->name;
    $data->email = $request->email;

    if (!empty($request->password)) {
        $data->password = Hash::make($request->password);
    }

    $data->save();

    // Sync role using role names
    DB::table('model_has_roles')->where('model_id', $id)->delete();
    $roleNames = Role::whereIn('id', $request->input('roles'))->pluck('name')->toArray();
    $data->assignRole($roleNames);

    return redirect('user');
}

    public function store(Request $request): RedirectResponse
    {
       

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'required|array'
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Assign roles
        

$roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
$user->assignRole($roleNames);

    
        // Redirect or return response
        return redirect('/user');
    
    }

    // Delete user
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('user');
        }
    
        return redirect('user')->with('error', 'User not found');
    }
}




