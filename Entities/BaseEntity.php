<?php

namespace Modules\Authority\Entities;

use Illuminate\Database\Eloquent\Model;

abstract class BaseEntity extends Model
{
    protected $dates        =   ['deleted_at'];

    protected $guarded  =   [
        'deleted_at', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
