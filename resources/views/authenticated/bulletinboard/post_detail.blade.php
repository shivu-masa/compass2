<x-sidebar>
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container">
      <div class="p-3">
        <div class="detail_inner_head">
          <div>
          </div>
          <div>

          @if(Auth::id() === $post->user_id)
            <span class="edit-modal-open" post_title="{{ $post->post_title }}" post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</span>
            @endif
            @if(Auth::id() === $post->user_id)
            <a href="#" class="delete-modal-open" data-post-id="{{ $post->id }}">削除</a>
            @endif
          </div>
        </div>
        <div class="w-100 mb-2">
    @if ($errors->has('post_title'))
      <div class="text-danger">{{ $errors->first('post_title') }}</div>
    @endif
    @if ($errors->has('post_body'))
      <div class="text-danger">{{ $errors->first('post_body') }}</div>
    @endif
  </div>
        <div class="contributor d-flex">
          <p>
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
          </p>
          <span class="ml-5">{{ $post->created_at }}</span>
        </div>
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <div class="mt-3 detsail_post">{{ $post->post }}</div>
      </div>
      <div class="p-3">
        <div class="comment_container">
          <span class="">コメント</span>
          @foreach($post->postComments as $comment)
          <div class="comment_area border-top">
            <p>
              <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
              <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
            </p>
            <p>{{ $comment->comment }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="w-50 p-3">
    <div class="comment_container border m-5">
      <div class="comment_area p-3">
        <p class="m-0">コメントする</p>
        {{-- バリデーションエラー表示 --}}
  @if ($errors->has('comment'))
    <div class="text-danger">{{ $errors->first('comment') }}</div>
  @endif
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
        <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
      </div>
    </div>
  </div>
</div>
{{-- 編集モーダル --}}
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      {{ csrf_field() }}
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <input type="text" name="post_title" placeholder="タイトル" class="w-100">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary d-block" value="編集">
        </div>
      </div>
    </form>
  </div>
</div>

{{-- ✅削除モーダル：別に独立 --}}
<div class="modal delete-modal js-delete-modal" style="display: none;">
  <div class="modal__bg js-delete-modal-close"></div>
  <div class="modal__content">
  <form id="delete-form" method="POST" action="">
      @csrf
      @method('DELETE')
      <p class="text-center">この投稿を削除してもよろしいですか？</p>
      <div class="d-flex justify-content-center">
        <a class="btn btn-secondary js-delete-modal-close mx-2" href="#">キャンセル</a>
        <button type="submit" class="btn btn-danger mx-2">OK
        </button>
      </div>
    </form>
  </div>
</div>
</x-sidebar>
