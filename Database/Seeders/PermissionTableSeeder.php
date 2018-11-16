<?php

namespace Modules\Authority\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Authority\Entities\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory( Permission::class, 100 )->create();
        $sub21      =   Permission::query()->whereBetween('id', [2,10])
            ->update(['pid'=>1]);
        $sub31      =   Permission::query()->whereBetween('id', [11,20])
            ->update(['pid'=>2]);
        $sub32      =   Permission::query()->whereBetween('id', [21,30])
            ->update(['pid'=>11]);
        $sub41      =   Permission::query()->whereBetween('id', [31, 65])
            ->update(['pid'=>21]);
        $sub42      =   Permission::query()->whereBetween('id', [55, 100])
                                  ->update(['pid'=>30]);
    }
}
