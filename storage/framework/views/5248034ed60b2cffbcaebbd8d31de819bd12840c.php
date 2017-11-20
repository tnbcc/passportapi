<?php $__env->startSection('title', '错误提示'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-icon sa-error">
        <span class="sa-x-mark animateXMark">
            <span class="sa-line sa-left"></span>
            <span class="sa-line sa-right"></span>
        </span>
</div>
    <h2><?php echo e($message); ?></h2>
    <p>页面将会自动跳转，等待时间：<b id="wait"><?php echo e($wait); ?></b><a id="href" style="display:none" href="<?php echo e($url); ?>">点击跳转</a></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.commons.prompt_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>