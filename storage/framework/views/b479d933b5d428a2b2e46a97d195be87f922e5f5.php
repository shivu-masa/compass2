<?php if (isset($component)) { $__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa = $component; } ?>
<?php $component = App\View\Components\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Sidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<p>ユーザー検索</p>
<div class="search_content w-100 border d-flex">
  <div class="reserve_users_area">
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="border one_person">
      <div>
        <span>ID : </span><span><?php echo e($user->id); ?></span>
      </div>
      <div><span>名前 : </span>
        <a href="<?php echo e(route('user.profile', ['id' => $user->id])); ?>">
          <span><?php echo e($user->over_name); ?></span>
          <span><?php echo e($user->under_name); ?></span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span>(<?php echo e($user->over_name_kana); ?></span>
        <span><?php echo e($user->under_name_kana); ?>)</span>
      </div>
      <div>
        <?php if($user->sex == 1): ?>
        <span>性別 : </span><span>男</span>
        <?php elseif($user->sex == 2): ?>
        <span>性別 : </span><span>女</span>
        <?php else: ?>
        <span>性別 : </span><span>その他</span>
        <?php endif; ?>
      </div>
      <div>
        <span>生年月日 : </span><span><?php echo e($user->birth_day); ?></span>
      </div>
      <div>
        <?php if($user->role == 1): ?>
        <span>権限 : </span><span>教師(国語)</span>
        <?php elseif($user->role == 2): ?>
        <span>権限 : </span><span>教師(数学)</span>
        <?php elseif($user->role == 3): ?>
        <span>権限 : </span><span>講師(英語)</span>
        <?php else: ?>
        <span>権限 : </span><span>生徒</span>
        <?php endif; ?>
      </div>
      <div>
        <?php if($user->role == 4): ?>
        <span>選択科目 :</span>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <div class="search_area w-25 border">
    <div class="">
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div>
        <lavel>カテゴリ</lavel>
        <select form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <label>並び替え</label>
        <select name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="">
        <p class="m-0 search_conditions"><span>検索条件の追加</span></p>
        <div class="search_conditions_inner">
          <div>
            <label>性別</label>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
          </div>
          <div>
            <label>権限</label>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <label>選択科目</label>
          </div>
        </div>
      </div>
      <div>
        <input type="reset" value="リセット" form="userSearchRequest">
      </div>
      <div>
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest">
      </div>
    </div>
    <form action="<?php echo e(route('user.show')); ?>" method="get" id="userSearchRequest"></form>
  </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa)): ?>
<?php $component = $__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa; ?>
<?php unset($__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa); ?>
<?php endif; ?>
<?php /**PATH C:\Users\User\mine_work\Compass_ver9\AtlasManagementSystem_ver9_neo2\resources\views/authenticated/users/search.blade.php ENDPATH**/ ?>