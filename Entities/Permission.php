<?php

namespace Modules\Authority\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Organize\Entities\Department;
use Mrlaozhou\Indulge\Collection;

class Permission extends BaseEntity
{
    /**
     * 属于那些部门
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bstDepartments ()
    {
        return $this->belongsToMany(
            Department::class,
            'department_has_permissions'
        );
    }

    public function getPermissionType ()
    {
        return config('authority.permission.type');
    }

    public static function permissionType ()
    {
        return config('authority.permission.type');
    }

    /**
     * @param array $models
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Mrlaozhou\Indulge\Collection
     */
    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }
}
