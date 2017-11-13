<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = ['name', 'route', 'parent_id', 'is_hidden', 'sort', 'status'];
}
