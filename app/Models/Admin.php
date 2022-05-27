<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Admin extends Model
{

    $role = Role::create(['name' => 'admin']);
    $permission = Permission::create(['name' => 'edit submissions']);
}
