<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AtlasBulletinBoard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="all_content">
        <div class="d-flex">
            <div class="sidebar">
    <p>
        <a href="{{ route('top.show') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" style="margin-right:3px;margin-left:3px; vertical-align:middle;">
    <path d="M3 12L12 3l9 9h-3v9h-12v-9H3z" fill="none" stroke="#ffffff" stroke-width="2"/>
</svg>
            トップ
        </a>
    </p>
   <p>
    <a href="/logout" class="d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="margin-right:3px; margin-left:3px; vertical-align:middle;">
            <path d="M16 17l5-5-5-5M21 12H9" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 19H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h7" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        ログアウト
    </a>
</p>

<p>
    <a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}" class="d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="margin-right:3px; margin-left:3px; vertical-align:middle;">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" fill="none" stroke="white" stroke-width="2"/>
            <line x1="16" y1="2" x2="16" y2="6" fill="none" stroke="white" stroke-width="2"/>
            <line x1="8" y1="2" x2="8" y2="6" fill="none" stroke="white" stroke-width="2"/>
            <line x1="3" y1="10" x2="21" y2="10" fill="none" stroke="white" stroke-width="2"/>
        </svg>
        スクール予約
    </a>
</p>

    {{-- 講師（role: 1, 2, 3）のみ表示 --}}
    @if(in_array(Auth::user()->role, [1, 2, 3]))
    <p>
        <a href="{{ route('calendar.admin.show', ['user_id' => Auth::id()]) }}" class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="margin-right:3px; margin-left:3px; vertical-align:middle;">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" fill="none" stroke="white" stroke-width="2"/>
                <path d="M3 8h18" fill="none" stroke="white" stroke-width="2"/>
            </svg>
            スクール予約確認
        </a>
    </p>
    <p>
        <a href="{{ route('calendar.admin.setting', ['user_id' => Auth::id()]) }}" class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="margin-right:3px; margin-left:3px; vertical-align:middle;">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" fill="none" stroke="white" stroke-width="2"/>
                <line x1="3" y1="10" x2="21" y2="10" fill="none" stroke="white" stroke-width="2"/>
            </svg>
            スクール枠登録
        </a>
    </p>
@endif

<p>
    <a href="{{ route('post.show') }}" class="d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="margin-right:3px; margin-left:3px; vertical-align:middle;">
            <circle cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="2"/>
            <path d="M8 12h8M8 16h5" fill="none" stroke="white" stroke-width="2"/>
        </svg>
        掲示板
    </a>
</p>

<p>
    <a href="{{ route('user.show') }}" class="d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="margin-right:3px; margin-left:3px; vertical-align:middle;">
            <circle cx="12" cy="8" r="4" fill="none" stroke="white" stroke-width="2"/>
            <path d="M4 20c0-4 4-6 8-6s8 2 8 6" fill="none" stroke="white" stroke-width="2"/>
        </svg>
        ユーザー検索
    </a>
</p>
</div>
            <div class="main-container">
                {{ $slot }}
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
        <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
        <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
    </body>
</html>
