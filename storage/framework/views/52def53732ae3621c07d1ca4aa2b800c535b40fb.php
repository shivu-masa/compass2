<?php if (isset($component)) { $__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa = $component; } ?>
<?php $component = App\View\Components\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Sidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="post_area border w-75 m-auto p-3">
      <p><span><?php echo e($post->user->over_name); ?></span><span class="ml-3"><?php echo e($post->user->under_name); ?></span>さん</p>
      <p><a href="<?php echo e(route('post.detail', ['id' => $post->id])); ?>"><?php echo e($post->post_title); ?></a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class=""></span>
          </div>
          <div>
            <?php if(Auth::user()->is_Like($post->id)): ?>
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="<?php echo e($post->id); ?>"></i><span class="like_counts<?php echo e($post->id); ?>"></span></p>
            <?php else: ?>
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="<?php echo e($post->id); ?>"></i><span class="like_counts<?php echo e($post->id); ?>"></span></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <div class="other_area border w-25">
    <div class="border m-4">
      <div class=""><a href="<?php echo e(route('post.input')); ?>">投稿</a></div>
      <div class="">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
      <ul>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="main_categories" category_id="<?php echo e($category->id); ?>"><span><?php echo e($category->main_category); ?><span></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  </div>
  <form action="<?php echo e(route('post.show')); ?>" method="get" id="postSearchRequest"></form>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa)): ?>
<?php $component = $__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa; ?>
<?php unset($__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa); ?>
<?php endif; ?>
<?php /**PATH C:\Users\User\mine_work\Compass_ver9\AtlasManagementSystem_ver9\resources\views/authenticated/bulletinboard/posts.blade.php ENDPATH**/ ?>