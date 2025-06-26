<?php if (isset($component)) { $__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa = $component; } ?>
<?php $component = App\View\Components\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Sidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container">
      <div class="p-3">
        <div class="detail_inner_head">
          <div>
          </div>
          <div>
            <span class="edit-modal-open" post_title="<?php echo e($post->post_title); ?>" post_body="<?php echo e($post->post); ?>" post_id="<?php echo e($post->id); ?>">編集</span>
            <a href="<?php echo e(route('post.delete', ['id' => $post->id])); ?>">削除</a>
          </div>
        </div>

        <div class="contributor d-flex">
          <p>
            <span><?php echo e($post->user->over_name); ?></span>
            <span><?php echo e($post->user->under_name); ?></span>
            さん
          </p>
          <span class="ml-5"><?php echo e($post->created_at); ?></span>
        </div>
        <div class="detsail_post_title"><?php echo e($post->post_title); ?></div>
        <div class="mt-3 detsail_post"><?php echo e($post->post); ?></div>
      </div>
      <div class="p-3">
        <div class="comment_container">
          <span class="">コメント</span>
          <?php $__currentLoopData = $post->postComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="comment_area border-top">
            <p>
              <span><?php echo e($comment->commentUser($comment->user_id)->over_name); ?></span>
              <span><?php echo e($comment->commentUser($comment->user_id)->under_name); ?></span>さん
            </p>
            <p><?php echo e($comment->comment); ?></p>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="w-50 p-3">
    <div class="comment_container border m-5">
      <div class="comment_area p-3">
        <p class="m-0">コメントする</p>
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="<?php echo e($post->id); ?>">
        <input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
        <form action="<?php echo e(route('comment.create')); ?>" method="post" id="commentRequest"><?php echo e(csrf_field()); ?></form>
      </div>
    </div>
  </div>
</div>
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="<?php echo e(route('post.edit')); ?>" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <input type="text" name="post_title" placeholder="タイトル" class="w-100">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary d-block" value="編集">
        </div>
      </div>
      <?php echo e(csrf_field()); ?>

    </form>
  </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa)): ?>
<?php $component = $__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa; ?>
<?php unset($__componentOriginalee6f77ea8284c9edd154cd0c9b3b80eff04c2bfa); ?>
<?php endif; ?>
<?php /**PATH C:\Users\User\mine_work\Compass_ver9\AtlasManagementSystem_ver9_neo2\resources\views/authenticated/bulletinboard/post_detail.blade.php ENDPATH**/ ?>