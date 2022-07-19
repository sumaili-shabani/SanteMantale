<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class Crud extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;
    protected $table = 'cruds';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price'
    ];
}
