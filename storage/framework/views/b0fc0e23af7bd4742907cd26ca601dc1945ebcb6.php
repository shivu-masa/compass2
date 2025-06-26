<?php if (isset($component)) { $__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa = $component; } ?>
<?php $component = App\View\Components\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Sidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="">
      <p class="mb-0">カテゴリー</p>
      <select class="w-100" form="postCreate" name="post_category_id">
        <?php $__currentLoopData = $main_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <optgroup label="<?php echo e($main_category->main_category); ?>"></optgroup>
        <!-- サブカテゴリー表示 -->
        </optgroup>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>
    <div class="mt-3">
      <?php if($errors->first('post_title')): ?>
      <span class="error_message"><?php echo e($errors->first('post_title')); ?></span>
      <?php endif; ?>
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="<?php echo e(old('post_title')); ?>">
    </div>
    <div class="mt-3">
      <?php if($errors->first('post_body')): ?>
      <span class="error_message"><?php echo e($errors->first('post_body')); ?></span>
      <?php endif; ?>
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body"><?php echo e(old('post_body')); ?></textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
    <form action="<?php echo e(route('post.create')); ?>" method="post" id="postCreate"><?php echo e(csrf_field()); ?></form>
  </div>
  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
  <div class="w-25 ml-auto mr-auto">
    <div class="category_area mt-5 p-5">
      <div class="">
        <p class="m-0">メインカテゴリー</p>
        <input type="text" class="w-100" name="main_category_name" form="mainCategoryRequest">
        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="mainCategoryRequest">
      </div>
      <!-- サブカテゴリー追加 -->
      <form action="<?php echo e(route('main.category.create')); ?>" method="post" id="mainCategoryRequest"><?php echo e(csrf_field()); ?></form>
    </div>
  </div>
  <?php endif; ?>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa)): ?>
<?php $component = $__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa; ?>
<?php unset($__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa); ?>
<?php endif; ?>
<?php /**PATH C:\Users\User\mine_work\Compass_ver9\AtlasManagementSystem_ver9_neo2\resources\views/authenticated/bulletinboard/post_create.blade.php ENDPATH**/ ?>