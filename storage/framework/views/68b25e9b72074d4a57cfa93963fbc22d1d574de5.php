<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title>AtlasBulletinBoard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <body class="all_content">
        <div class="d-flex">
            <div class="sidebar">
                <p><a href="<?php echo e(route('top.show')); ?>">トップ</a></p>
                <p><a href="/logout">ログアウト</a></p>
                <p><a href="<?php echo e(route('calendar.general.show',['user_id' => Auth::id()])); ?>">スクール予約</a></p>
                <p><a href="<?php echo e(route('calendar.admin.show',['user_id' => Auth::id()])); ?>">スクール予約確認</a></p>
                <p><a href="<?php echo e(route('calendar.admin.setting',['user_id' => Auth::id()])); ?>">スクール枠登録</a></p>
                <p><a href="<?php echo e(route('post.show')); ?>">掲示板</a></p>
                <p><a href="<?php echo e(route('user.show')); ?>">ユーザー検索</a></p>
            </div>
            <div class="main-container">
                <?php echo e($slot); ?>

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="<?php echo e(asset('js/register.js')); ?>" rel="stylesheet"></script>
        <script src="<?php echo e(asset('js/bulletin.js')); ?>" rel="stylesheet"></script>
        <script src="<?php echo e(asset('js/user_search.js')); ?>" rel="stylesheet"></script>
        <script src="<?php echo e(asset('js/calendar.js')); ?>" rel="stylesheet"></script>
    </body>
</html>
<?php /**PATH C:\Users\User\mine_work\Compass_ver9\AtlasManagementSystem_ver9_neo2\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>