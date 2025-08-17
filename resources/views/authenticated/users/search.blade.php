<x-sidebar>
<p>ユーザー検索</p>
<div class="search_content w-100 d-flex">
  <!-- 左：ユーザー一覧 -->
  <div class="reserve_users_area" style="width:75%; display:flex; flex-wrap:wrap;">
    @foreach($users as $user)
    <div class="border one_person"
     style="margin:5px; padding:10px;
            width:280px; height:280px; /* 正方形 */
            box-sizing:border-box;
            display:flex;
            flex-direction:column;
            justify-content:flex-start;
            background-color:white;       /* 背景白 */
            border-radius:10px;           /* 角丸 */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* ドロップシャドウ */
            ">
        <div><span>ID : </span><span>{{ $user->id }}</span></div>
        <div><span>名前 : </span>
            <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                <span>{{ $user->over_name }}</span>
                <span>{{ $user->under_name }}</span>
            </a>
        </div>
        <div><span>カナ : </span><span>({{ $user->over_name_kana }}</span><span>{{ $user->under_name_kana }})</span></div>
        <div>
            @if($user->sex == 1)<span>性別 : </span><span>男</span>
            @elseif($user->sex == 2)<span>性別 : </span><span>女</span>
            @else<span>性別 : </span><span>その他</span>@endif
        </div>
        <div><span>生年月日 : </span><span>{{ $user->birth_day }}</span></div>
        <div>
            @if($user->role == 1)<span>権限 : </span><span>教師(国語)</span>
            @elseif($user->role == 2)<span>権限 : </span><span>教師(数学)</span>
            @elseif($user->role == 3)<span>権限 : </span><span>講師(英語)</span>
            @else<span>権限 : </span><span>生徒</span>@endif
        </div>
        <div>
            @if($user->role == 4)
                <span>選択科目 : </span>
                @foreach($user->subjects as $subject)
                    <span>{{ $subject->subject }}</span>
                @endforeach
            @endif
        </div>
    </div>
    @endforeach
</div>

  <!-- 右：検索バー -->
  <div class="search_area w-25 border" style="padding:10px; margin-left:10px;">
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest">
      <!-- 検索フォームの内容は元のコードそのまま -->
      <div style="margin-bottom:3px;">
        <h3 class="mt-3"><span style="color: #070769ff;">検索</span></h3>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索"
               style="height: 40px; border-radius: 8px; padding: 8px 12px; border: 1px solid #ccc; width: 90%; box-sizing: border-box;">
      </div>
      <div style="margin-bottom:3px;">
        <h6 class="mt-3"><span style="color: #070769ff;">カテゴリ</span></h6>
        <select name="category" style="border-radius: 8px; padding: 8px 12px; border: 1px solid #ccc; box-sizing: border-box;">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div style="margin-bottom:3px;">
        <h6 class="mt-3"><span style="color: #070769ff;">並び替え</span></h6>
        <select name="updown" style="border-radius: 8px; padding: 8px 12px; border: 1px solid #ccc; box-sizing: border-box;">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>


      <div class="mb-3">

        <h6 class="mt-3 search_conditions toggle-btn" style="cursor:pointer;">
          <span style="color: #070769ff;">検索条件の追加</span>
          <span class="arrow-icon">▲</span>
        </h6>
        <hr style="margin: 3px 0; border: 0; border-top: 1px solid #ccc; width: 80%; margin-left:0; margin-bottom:5px;">
        <div class="search_conditions_inner" style="display: none; margin-top:3px;">
          <!-- 性別、権限、選択科目なども元コードそのまま -->
             <div style="margin-bottom:3px;">
                    <h6 class="mt-3 search_conditions toggle-btn" style="cursor:pointer;">
          <span style="color: #070769ff;">性別</h6>
                    <span>男</span><input type="radio" name="sex" value="1">
                    <span>女</span><input type="radio" name="sex" value="2">
                    <span>その他</span><input type="radio" name="sex" value="3">
                </div>
  <div style="margin-bottom:3px;">
                    <h6 class="mt-3 search_conditions toggle-btn" style="cursor:pointer;">
          <span style="color: #070769ff;">権限</h6>
                    <select name="role" class="engineer" style="border-radius: 8px; padding: 8px 12px; border: 1px solid #ccc;">
                        <option selected disabled>----</option>
                        <option value="1">教師(国語)</option>
                        <option value="2">教師(数学)</option>
                        <option value="3">教師(英語)</option>
                        <option value="4">生徒</option>
                    </select>
                </div>

                <div class="selected_engineer" style="margin-bottom:3px;">
                   <h6 class="mt-3 search_conditions toggle-btn" style="cursor:pointer;">
          <span style="color: #070769ff;">選択科目</h6>
                    <div style="display:flex; flex-direction:row; flex-wrap:wrap; gap:10px;">
                        @foreach($subjects as $subject)
                          <label>
                            <input type="checkbox" name="subject[]" value="{{ $subject->id }}">
                            {{ $subject->subject }}
                          </label>
                        @endforeach
                    </div>


        </div>
      </div>
      <div style="margin-bottom:3px;">
        <input type="submit" name="search_btn" value="検索"
               style="background-color: #20aacc; color: white; width: 100%; padding: 10px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
      </div>
      <div style="margin-top: 8px; text-align: center;">
        <a href="#" onclick="document.getElementById('userSearchRequest').reset(); return false;"
           style="color: #007bff; text-decoration: underline; cursor: pointer;">リセット</a>
      </div>
    </form>
  </div>
</div>

</x-sidebar>
