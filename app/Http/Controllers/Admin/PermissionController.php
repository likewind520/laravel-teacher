<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    public function index()
    {
        admin_has_permission('Admin-permission');
        $modules=Module::all();

        return view( 'admin.permission.index' , compact( 'modules' ) );
    }

    public function forgetPermissionCache()
    {
        admin_has_permission('Admin-permission');
//        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return back()->with( 'success' , '缓存清除成功' );
    }
}
