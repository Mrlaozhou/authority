<?php

namespace Modules\Authority\Transformers\DepartmentHasPermissions;

use Illuminate\Http\Resources\Json\Resource;

class RowResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
