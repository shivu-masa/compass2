<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\SubCategoryRequest;

use Auth;

class PostsController extends Controller
{
   public function show(Request $request)
{
    $categories = MainCategory::with('subCategories')->get();
    $keyword = $request->keyword;
    $subCategoryId = $request->sub_category_id;
    $likePosts = $request->has('like_posts');
    $myPosts = $request->has('my_posts');
    $userId = auth()->id();

    $posts = Post::with(['user', 'postComments', 'subCategories'])
        ->withCount(['likes', 'postComments'])
        ->when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('post_title', 'like', '%' . $keyword . '%')
                  ->orWhere('post', 'like', '%' . $keyword . '%')
                  ->orWhereHas('subCategories', function ($subQuery) use ($keyword) {
                      $subQuery->where('sub_category', 'like', '%' . $keyword . '%');
                  });
            });
        })
        ->when($subCategoryId, function ($query) use ($subCategoryId) {
            $query->whereHas('subCategories', function ($subQuery) use ($subCategoryId) {
                $subQuery->where('sub_categories.id', $subCategoryId);
            });
        })
        ->when($likePosts, function ($query) use ($userId) {
            $query->whereHas('likes', function ($likeQuery) use ($userId) {
                $likeQuery->where('user_id', $userId);
            });
        })
        ->when($myPosts, function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->get();

    $like = new Like;
    $post_comment = new Post;

    return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
}

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
         $main_categories = MainCategory::with('subCategories')->get();

        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }

    public function postCreate(PostFormRequest $request){


    $post = Post::create([
        'user_id' => Auth::id(),
        'post_title' => $request->post_title,
        'post' => $request->post_body,
    ]);

$post->subCategories()->attach($request->sub_category_id);

    return redirect()->route('post.show');
}

    public function postEdit(Request $request){

        $request->validate([
            'post_title' => ['required', 'string', 'max:100'],
            'post_body' => ['required', 'string', 'max:2000'],
        ]);


        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }

    public function mainCategoryCreate(MainCategoryRequest $request){
        $request->validate([
        'main_category_name' => 'required|string|max:50'
    ]);
        MainCategory::create(['main_category' => $request->main_category_name
    ]);
         return redirect()->route('post.input');
    }
    public function showPostInput()
{
    dd(MainCategory::with('subCategories')->get());
    $main_categories = MainCategory::with('subCategories')->get();

    return view('post.input', compact('main_categories'));
}


public function subCategoryCreate(SubCategoryRequest $request){
    $request->validate([
        'main_category_id' => 'required|exists:main_categories,id',
        'sub_category_name' => 'required|string|max:50'
    ]);

    SubCategory::create([
        'main_category_id' => $request->main_category_id,
        'sub_category' => $request->sub_category_name
    ]);
    return redirect()->route('post.input');
}
    public function commentCreate(Request $request){
        $request->validate([
            'comment' => ['required', 'string', 'max:250'],
        ]);
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->withCount('likes')->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->withCount('likes')->whereIn('id', $like_post_id)->get();
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
