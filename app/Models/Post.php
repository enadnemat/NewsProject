<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = ['title_en', 'title_ar', 'description_en', 'description_ar', 'photo', 'created_at', 'updated_at', 'type_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public $timestamps = true;

    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id');
    }

}
