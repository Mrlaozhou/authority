<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Authority\Entities\Permission::class, function (Faker $faker) {
    return [
        //
        'label'         =>  $faker->word,
        'operate'       =>  $faker->word . '.' . $faker->word . '.' . $faker->word,
        'guard'         =>  'api',
        'type'          =>  $faker->randomElement( config('authority.permission.type') ),
        'pid'           =>  0,
    ];
});
