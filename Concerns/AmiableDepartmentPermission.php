<?php
namespace Modules\Authority\Concerns;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Authority\Entities\DepartmentHasPermissions;

trait AmiableDepartmentPermission
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departmentHasPermissions ()
    {
        return $this->hasMany(
            DepartmentHasPermissions::class , 'department_id', 'id'
        );
    }

    /**
     * @param int ...$permission
     *
     * @return \Illuminate\Support\Collection
     */
    public function refreshPermissionTo (int ...$permission)
    {
        if( $this->getKey() ) {
            $this->revokePermission();
            return $this->addPermissionTo( $permission );
        }
        throw new ModelNotFoundException();
    }

    /**
     * @param $permissions
     *
     * @return \Illuminate\Support\Collection
     */
    private function addPermissionTo ($permissions)
    {
        return collect( $permissions )->filter()->map(function ($item) {
            return DepartmentHasPermissions::create( [
                'department_id'=>$this->getKey(), 'permission_id' => $item
            ] );
        });
    }

    /**
     * @return mixed
     */
    private function revokePermission ()
    {
        return $this->departmentHasPermissions()->delete();
    }

}