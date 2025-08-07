<x-guest-layout>
  {{-- 全体を中央寄せ --}}
<div class="w-100 vh-100 d-flex flex-column align-items-center justify-content-center bg-light">

  {{-- ★ ロゴ画像（上に浮いて見える） --}}
  <div class="mb-3">
    <img src="{{ asset('image/atlas-black.png') }}" alt="ロゴ" style="height: 60px;">
  </div>

  {{-- ★ フォーム本体（下の箱） --}}
  <form action="{{ route('loginPost') }}" method="POST"
      class="border rounded p-4 bg-white"
      style="width: 320px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);">
    @csrf

    {{-- メールアドレス --}}
    <div class="mb-3">
      <label style="font-size:13px;">メールアドレス</label>
      <div class="border-bottom border-primary">
        <input type="text" class="form-control border-0 p-0" name="mail_address">
      </div>
    </div>

    {{-- パスワード --}}
    <div class="mb-3">
      <label style="font-size:13px;">パスワード</label>
      <div class="border-bottom border-primary">
        <input type="password" class="form-control border-0 p-0" name="password">
      </div>
    </div>

    {{-- ログインボタン --}}
    <div class="d-flex justify-content-end mt-4 mb-4">
  <input type="submit" class="btn btn-primary" value="ログイン">
</div>

    {{-- 新規登録リンク --}}
    <div class="text-center">
      <a href="{{ route('registerView') }}">新規登録</a>
    </div>
  </form>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</x-guest-layout>
