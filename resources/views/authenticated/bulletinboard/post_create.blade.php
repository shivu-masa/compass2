<x-sidebar>
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="">
      <p class="mb-0">カテゴリー</p>
<select class="w-100" form="postCreate" name="post_category_id" required>
  @foreach($main_categories as $main_category)
    {{-- メインカテゴリー（選択不可・グレー表示） --}}
    <optgroup label="{{ $main_category->main_category }}" style="color: gray;">
      @foreach($main_category->subCategories as $sub_category)
        {{-- サブカテゴリー（選択可能・黒表示） --}}
        <option value="{{ $sub_category->id }}" style="color: black;">
          {{ $sub_category->sub_category }}
        </option>
      @endforeach
    </optgroup>
  @endforeach
</select>
    </div>
    <div class="mt-3">
      @if($errors->first('post_title'))
      <span class="error_message">{{ $errors->first('post_title') }}</span>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
    </div>
    <div class="mt-3">
      @if($errors->first('post_body'))
      <span class="error_message">{{ $errors->first('post_body') }}</span>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
    <form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
  </div>
@php
    // 講師かどうかを判断（国語:1, 数学:2, 英語:3）
    $isTeacher = in_array(Auth::user()->role, [1, 2, 3]);
@endphp

  @can('admin')
  <div class="w-25 ml-auto mr-auto">
    <div class="category_area mt-5 p-5">
      <div class="mt-3">
        @if ($errors->has('main_category_name'))
  <p class="text-danger">{{ $errors->first('main_category_name') }}</p>
@endif
    <p class="m-0">メインカテゴリー</p>
    <form action="{{ route('main.category.create') }}" method="POST" id="mainCategoryRequest">
      @csrf
      <input type="text" class="w-100 mb-2" name="main_category_name" placeholder="例: プログラミング">
      <input type="submit" value="追加" class="w-100 btn btn-primary p-0">
    </form>
  </div>
     {{-- サブカテゴリー追加 --}}
  <div class="mt-4">
    @if ($errors->has('sub_category_name'))
  <p class="text-danger">{{ $errors->first('sub_category_name') }}</p>
@endif
    <p class="m-0">サブカテゴリー</p>
    <form action="{{ route('sub.category.create') }}" method="POST">
        @csrf
        <input type="hidden" name="main_category_id" value="{{ $main_category->id }}">
        <input type="text" name="sub_category_name" class="form-control mb-1" placeholder="サブカテゴリー名を入力">
        <input type="submit" value="追加" class="w-100 btn btn-primary p-0 mt-1">
      </form>
  </div>
  @endcan
</div>
</x-sidebar>
