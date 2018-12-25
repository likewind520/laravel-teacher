<?php

namespace App\Policies;

use App\Models\Admin;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function delete( Admin $admin , Role $role )
    {
        return $role['name'] != 'webmaster';
    }

    public function update(Admin $admin , Role $role )
    {
        return $role['name'] != 'webmaster';
    }
}
