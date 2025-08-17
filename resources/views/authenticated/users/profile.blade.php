<x-sidebar>
<div class="vh-100 border">
  <div class="top_area w-75 m-auto pt-5">
    <span>{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span>
    <div class="user_status p-3">
      <p>名前 : <span>{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
      <p>カナ : <span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
      <p>性別 : @if($user->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
      <p>生年月日 : <span>{{ $user->birth_day }}</span></p>
      <div>選択科目:
  @foreach($user->subjects as $subject)
    <span>{{ $subject->subject }}</span>
  @endforeach
</div>
      <div>
  @can('admin')
    <span class="subject_edit_btn">
      選択科目の登録 <span class="arrow">▲</span>
    </span>
    <div class="subject_inner" style="display:none;">
  <form action="{{ route('user.edit') }}" method="post" style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
    @foreach($subject_lists as $subject_list)
      <div style="display: flex; align-items: center; gap: 5px;">
        <label for="subject-{{ $subject_list->id }}" style="margin: 0;">{{ $subject_list->subject }}</label>
        <input type="checkbox" id="subject-{{ $subject_list->id }}" name="subjects[]" value="{{ $subject_list->id }}">
      </div>
    @endforeach

    <input type="submit" value="登録" class="btn btn-primary" style="white-space: nowrap;">
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    {{ csrf_field() }}
  </form>
</div>
  @endcan
</div>

    </div>
  </div>
</div>

</x-sidebar>
