<x-sidebar>
<p>ユーザー検索</p>
<div class="search_content w-100 border d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div>
        <span>ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span>性別 : </span><span>女</span>
        @else
        <span>性別 : </span><span>その他</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span>講師(英語)</span>
        @else
        <span>権限 : </span><span>生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span>選択科目 : @foreach($user->subjects as $subject)
    <span>{{ $subject->subject }}</span>
  @endforeach</span>
        @endif
      </div>
    </div>
    @endforeach
  </div>

  <div class="search_area w-25 border">
    <div class="">
      <div>
        <h3>検索</h3>
        <input
  type="text"
  class="free_word"
  name="keyword"
  placeholder="キーワードを検索"
  form="userSearchRequest"
  style="height: 40px; border-radius: 8px; padding: 8px 12px; border: 1px solid #ccc; width: 90%; box-sizing: border-box;">
      </div>
      <div>

        <h6>カテゴリ</h6>
        <select
  form="userSearchRequest"
  name="category"
  style="border-radius: 8px; padding: 8px 12px; border: 1px solid #ccc; box-sizing: border-box;"
>
  <option value="name">名前</option>
  <option value="id">社員ID</option>
</select>
      </div>
      <div>
        <h6>並び替え</h6>
        <select
  name="updown"
  form="userSearchRequest"
  style="border-radius: 8px; padding: 8px 12px; border: 1px solid #ccc; box-sizing: border-box;"
>
  <option value="ASC">昇順</option>
  <option value="DESC">降順</option>
</select>
      </div>

      <div class="">
  <h6 class="m-0 search_conditions toggle-btn" style="cursor: pointer;">
    <span>検索条件の追加</span> <span class="arrow-icon">△</span>
  </h6>

  <div class="search_conditions_inner" style="display: none;">
    <div>
      <h6>性別</h6>
      <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
      <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
      <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
    </div>

    <div>
      <h6>権限</h6>
      <select name="role" form="userSearchRequest" class="engineer" style="border-radius: 8px; padding: 8px 12px; border: 1px solid #ccc;">
        <option selected disabled>----</option>
        <option value="1">教師(国語)</option>
        <option value="2">教師(数学)</option>
        <option value="3">教師(英語)</option>
        <option value="4">生徒</option>
      </select>
    </div>

    <div class="selected_engineer">
  <h6>選択科目</h6>
  <div style="display: flex; flex-direction: row; flex-wrap: wrap; gap: 10px;">
    @foreach($subjects as $subject)
      <label>
        <input type="checkbox" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest">
        {{ $subject->subject }}
      </label>
    @endforeach
  </div>
</div>
  </div>
</div>

      <input type="submit"
         name="search_btn"
         value="検索"
         form="userSearchRequest"
         style="background-color: #4fc3f7;
                color: white;
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;">
</div>

<div style="margin-top: 8px; text-align: center;">
  <!-- リセットリンク -->
  <a href="#"
     onclick="document.getElementById('userSearchRequest').reset(); return false;"
     style="color: #007bff;
            text-decoration: underline;
            cursor: pointer;">
    リセット
  </a>
</div>

    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>


</x-sidebar>
