<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    protected $fillable = [
        'name','category_id'
    ];


    public function job(){
        return $this->hasMany(Job::class,'subcategory_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }


}
