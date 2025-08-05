<x-sidebar>
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <p><span> {{ $date }}日</span><span class="ml-3">{{ $part }}部</span></p>
    <div class="h-75 border">
      <table class="table ">
        <thead>
          <tr class="text-center">
            <th class="w-25">ユーザーID</th>
            <th class="w-25">ユーザー名</th>
            <th class="w-25">予約場所</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($reserveSetting->users as $user)
            <tr class="text-center">
              <td>{{ $user->id }}</td>
              <td>{{ $user->over_name }} {{ $user->under_name }}</td>
              <td>リモート</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center">予約者はいません</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
</x-sidebar>
