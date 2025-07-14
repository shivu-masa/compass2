<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'user_id',
        'post_title',
        'post',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function postComments(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }

 public function subCategories()
{
    return $this->belongsToMany(
        \App\Models\Categories\SubCategory::class,  // 関連モデル
        'post_sub_categories',                      // 中間テーブル名
        'post_id',                                  // このモデルの外部キー（postsテーブルのidを参照）
        'sub_category_id'                           // 関連モデルの外部キー
    );
}

    // コメント数
    public function commentCounts($post_id){
        return Post::with('postComments')->find($post_id)->postComments();
    }

    public function likes()
{
    return $this->hasMany(\App\Models\Posts\Like::class, 'like_post_id');
}
}
