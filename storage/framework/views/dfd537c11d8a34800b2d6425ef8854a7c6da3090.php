
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>添加权限</h5>
        </div>
        <div class="ibox-content">
            <a href="<?php echo e(route('rules.index')); ?>">
                <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 权限管理
                </button>
            </a>
            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
            <form class="form-horizontal m-t-md" action="<?php echo e(route('rules.update',$rule->id)); ?>" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">上级权限：</label>
                    <div class="col-sm-2">
                        <select name="parent_id" class="form-control">
                            <option value="0">顶级权限</option>
                            <?php $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item['id']); ?>" <?php if($rule->parent_id == $item['id']): ?> selected="selected"<?php endif; ?> ><?php echo e($item['_name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">权限名称：</label>
                    <div class="col-sm-3">
                        <input type="text" name="name" value="<?php echo e($rule->name); ?>" class="form-control" required
                               data-msg-required="请输入权限名称">
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">权限路径：</label>
                    <div class="col-sm-3">
                        <input type="text" name="route" value="<?php echo e($rule->route); ?>" class="form-control">
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">排序：</label>
                    <div class="col-sm-1">
                        <input type="text" name="sort" value="<?php echo e($rule->sort); ?>" required class="form-control">
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否隐藏：</label>
                    <div class="col-sm-2">
                        <select name="is_hidden" class="form-control">
                            <option value="0" <?php if($rule->is_hidden == 0): ?>selected="selected" <?php endif; ?> >显示</option>
                            <option value="1" <?php if($rule->is_hidden == 1): ?>selected="selected" <?php endif; ?>>隐藏</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态：</label>
                    <div class="col-sm-2">
                        <select name="status" class="form-control">
                            <option value="1" <?php if($rule->status == 1): ?>selected="selected" <?php endif; ?>>启用</option>
                            <option value="0" <?php if($rule->status == 0): ?>selected="selected" <?php endif; ?>>禁用</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp;保 存
                        </button>
                        　
                        <button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php echo e(method_field('PATCH')); ?>

                <?php echo e(csrf_field()); ?>

            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>