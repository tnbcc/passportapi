<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'remark', 'order', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admin()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
