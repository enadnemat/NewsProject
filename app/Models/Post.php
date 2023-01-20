<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = ['title_en', 'title_ar', 'description_en', 'description_ar', 'created_at', 'updated_at', 'type_id', 'sub_type'];

    protected $hidden = ['created_at', 'updated_at'];

    public $timestamps = true;

    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id','id');
    }
    public function photos()
    {
        return $this->hasMany('App\Models\Photo', 'post_id', 'id');
    }

}
