<?php
namespace Modules\Authority;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Authority\Entities\Permission;

class PermissionManager
{
    protected static $cacheKey         =   'mrlaozhou.authority.permission';

    /**
     * @param bool $cache
     *
     * @return \Mrlaozhou\Indulge\Collection
     */
    public static function getPermissions ($cache = true) :\Mrlaozhou\Indulge\Collection
    {
        if( ! config('authority.permission.cache.enable') || ! $cache ) {
            self::refreshPermissions();
        }
        return Cache::remember(self::$cacheKey, config('authority.permission.cache.expire'), function () {
                return Permission::query()
                    ->select('id', 'label', 'operate', 'guard', 'type', 'pid', 'created_at', 'updated_at' )
                    ->get();
            } );
    }

    /**
     * 刷新缓存
     *
     * @return bool
     */
    public static function refreshPermissions ()
    {
        return Cache::forget( self::$cacheKey );
    }

    /**
     * 是否存在权限
     * @param $permission
     *
     * @return bool
     */
    public static function isStoredPermission ($permission)
    {
        //  模型
        if( $permission instanceof Permission ) {
            return self::getPermissions()->contains('id', $permission->getKey());
        }
        //  ID
        if( is_int($permission) ) {
            return self::getPermissions()->contains('id', $permission);
        }
        //  operate
        if( is_string($permission) ) {
            return self::getPermissions()->contains('operate', $permission);
        }
        return false;
    }
}