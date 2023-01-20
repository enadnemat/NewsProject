<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = "types";

    protected $fillable = ['name_ar', 'name_en', 'type_id'];

    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'type_id', 'id');
    }



}
