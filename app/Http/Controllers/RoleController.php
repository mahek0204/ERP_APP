<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $roles = Role::all(); 
        $permission = Permission::all();
        $rolePermissions = []; // 👈 Define empty variable to avoid undefined error

    //return view('roles.roles', compact('roles', 'permission', ));// or use Role::paginate(10) if you want pagination
    return view('roles.roles', compact('roles','permission','rolePermissions'));
        // $roles = Role::orderBy('id','DESC')->paginate(5);
        // return view('roles.roles',compact('roles'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    //$roles = Role::pluck('name', 'id')->all();
    $permission = Permission::all(); // 👈 Fetch all permissions

    return view('roles.roles', compact('permission'));
}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
    
        $roles = Role::create(['name' => $request->input('name')]);
        $roles->syncPermissions($permissionsID);
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $roles = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.roles',compact('roles','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $roles = Role::find($id);
        $permission = Permission::all();
        $rolePermissions = $roles->permissions->pluck('id')->toArray(); // pre-selected
    
        return view('roles.roles',compact('roles','permission','rolePermissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
            
        ]);
    
        $roles = Role::find($id);
        $roles->name = $request->input('name');
        $roles->save();

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
    
        $roles->syncPermissions($permissionsID);
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
                        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }

    // public function delete($id): RedirectResponse
    // {
    //     $roles = Role::find($id);
    //     if ($roles) {
    //         $roles->delete();
    //     }
    //     return redirect()->route('roles')
    //                   ->with('success','Role deleted successfully');
    // }
}
