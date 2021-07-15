<?php if($errors->any()): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(session()->has('suc') && session()->get('suc') != ""): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo e(session()->get('suc')); ?>

                </div>
            </div>
        </div>
    </div>
    <?php
    session()->put('suc', '');
    ?>
<?php endif; ?>
<?php if(session()->has('err') && session()->get('err') != ""): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo e(session()->get('err')); ?>

                </div>
            </div>
        </div>
    </div>
    <?php
    session()->put('err', '');
    ?>
<?php endif; ?><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/common/msg.blade.php ENDPATH**/ ?>