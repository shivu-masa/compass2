<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];
    public function mainCategory()
{
    return $this->belongsTo(MainCategory::class);
}
    public function posts()
{
    return $this->belongsToMany(Post::class, 'post_sub_categories');
}
}
