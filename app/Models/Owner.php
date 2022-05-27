<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Owner extends Model
{
    $role = Role::create(['name' => 'owner']);
    $permission = Permission::create(['name' => 'edit owned submissions']);
}
