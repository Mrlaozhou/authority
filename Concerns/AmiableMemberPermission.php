<?php
namespace Modules\Authority\Concerns;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Authority\Entities\MemberHasPermissions;
use Modules\Authority\PermissionManager;

trait AmiableMemberPermission
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasDirectPermissions ()
    {
        return $this->hasMany(
            MemberHasPermissions::class,
            'member_id',
            'id'
        );
    }

    /**
     * @param int ...$permission
     *
     * @return \Illuminate\Support\Collection
     */
    public function refreshPermissionTo (int ...$permission)
    {
        $this->revokePermission();
        return $this->addPermissionTo( $permission ?: [] );
    }

    /**
     * @param array $permission
     *
     * @return \Illuminate\Support\Collection
     */
    private function addPermissionTo ($permission)
    {
        return collect($permission)->filter()->map(function ($item) {
                return MemberHasPermissions::create(['permission_id' => $item, 'member_id' => $this->getKey()]);
            });
    }

    /**
     * @return mixed
     */
    private function revokePermission ()
    {
        return $this->hasDirectPermissions()->delete();
    }
}