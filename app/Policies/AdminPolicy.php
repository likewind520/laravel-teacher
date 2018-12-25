<?php

namespace App\Policies;

use App\Models\Admin;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;


    public function delete( User $user , Admin $admin )
    {
        return $admin[ 'id' ] != 1;//管理员删除时候,不允许删除超级管理员(站长)
    }
}
