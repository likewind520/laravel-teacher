<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        admin_has_permission('Admin-role');
        $roles=Role::paginate( 10 );

        return view( 'admin.role.index' , compact( 'roles' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        admin_has_permission('Admin-role');
        return view( 'admin.role.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request,Role $role)
    {
        admin_has_permission('Admin-role');
        $role->title     =$request->title;
        $role->name      =$request->name;
        $role->guard_name='admin';
        $role->save();

        return redirect()->route( 'admin.role.index' )->with( 'success' , '角色添加成功' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        admin_has_permission('Admin-role');
        return view( 'admin.role.edit' , compact( 'role' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request,Role $role)
    {
        admin_has_permission('Admin-role');
        $this->authorize( 'update' , $role );
        $role->title=$request->title;
        $role->name =$request->name;
        $role->save();

        return redirect()->route( 'admin.role.index' )->with( 'success' , '角色编辑成功' );
    }


    public function destroy(Role $role)
    {
        admin_has_permission('Admin-role');
        $this->authorize( 'delete' , $role );
        $role->delete();

        return redirect()->route( 'admin.role.index' )->with( 'success' , '角色删除成功' );
    }
    public function show(Role $role)
    {
        admin_has_permission('Admin-role');
        $modules=Module::all();

        return view( 'admin.role.set_role_permission' , compact( 'modules' , 'role' ) );
    }
    public function setRolePermission( Role $role , Request $request )
    {
        admin_has_permission('Admin-role');
        $this->authorize( 'update' , $role );
        $role->syncPermissions( $request->permissions );

        return back()->with( 'success' , '操作成功' );
    }
}
