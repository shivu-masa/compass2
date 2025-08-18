<x-sidebar>
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
       <p>
  @foreach($post->subCategories as $subCategory)
    <span class="sub-category-box">{{ $subCategory->sub_category }}</span>@if(!$loop->last)、@endif
  @endforeach
</p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">

            <i class="fa fa-comment"></i>
<span>{{ $post->post_comments_count }}</span></span>
          </div>

          <!-- いいね -->
          <div>
  @if(Auth::user()->is_Like($post->id))
    <p class="m-0">
      <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
      <span class="like_counts{{ $post->id }}">{{ $post->likes_count }}</span>
    </p>
  @else
    <p class="m-0">
      <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>
      <span class="like_counts{{ $post->id }}">{{ $post->likes_count }}</span>
    </p>
  @endif
</div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="mt-5    other_area  w-25 ">
  <div class="m-4">

    {{-- 投稿ボタン --}}
    <div class="mb-3">
  <a href="{{ route('post.input') }}"
     class="btn w-100"
     style="background-color:#20aacc; border-color:#20aacc; color:white;">
    投稿する
  </a>
</div>

    {{-- キーワード検索 --}}
    <div class="input-group mb-3">
  <input type="text" name="keyword" class="form-control" placeholder="キーワードを検索" form="postSearchRequest">
  <button type="submit" class="btn"
        style="background-color:#20aacc; border-color:#20aacc; color:white;"
        form="postSearchRequest">
  検索
</button>
</div>

    {{-- フィルター --}}
 <div class="mb-3 d-flex gap-2">
  <input type="submit" name="like_posts"
         class="btn w-50"
         value=" いいねした投稿"
         form="postSearchRequest"
         style="color: white; background-color: #e83e8c; border: 1px solid #e83e8c;">

  <input type="submit" name="my_posts"
         class="btn w-50"
         value=" 自分の投稿"
         form="postSearchRequest"
         style="color: white; background-color: #fd7e14; border: 1px solid #fd7e14;">
</div>
<strong>検索ワード</strong>
    {{-- カテゴリー一覧 --}}
    <style>
  .category-toggle {
    cursor: pointer;
     font-size: 1.1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
</style>

<div class="category-list">
  <style>
    .sub-category-list a {
      font-size: 0.85rem;
    }
    .sub-category-list li {
      font-size: 0.85rem;
    }
  </style>

<ul class="list-unstyled">
  @foreach($categories as $index => $main_category)
    {{-- メインカテゴリー --}}
    <li class="fw-bold text-secondary category-toggle" data-target="subcat-{{ $index }}" style="font-size:16px;">
      <span>{{ $main_category->main_category }}</span>
      <span class="arrow">▲</span>
    </li>
    {{-- メインカテゴリーとサブカテゴリーの間に余白付き区切り線 --}}
    <hr style="margin: 8px 0 12px 0; border: 0; border-top: 1px solid #ccc; width: 100%;">

    {{-- サブカテゴリー --}}
    <ul class="ms-3 mb-3 sub-category-list" id="subcat-{{ $index }}" style="margin-left:20px; margin-top:10px;">
  @foreach($main_category->subCategories as $sub_category)
    <li>
      <a href="{{ route('post.show') }}?sub_category_id={{ $sub_category->id }}"
         class="text-decoration-none"
         style="font-size:14px; color:#6c757d;">
        {{ $sub_category->sub_category }}
      </a>
    </li>
    <hr style="margin: 3px 0; border: 0; border-top: 1px solid #ccc; width: 80%; margin-left:0;">
  @endforeach
</ul>
  @endforeach
</ul>


</div>




  {{-- 検索フォーム --}}

  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
</x-sidebar>
