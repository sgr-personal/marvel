<section class="section-content padding-bottom mt-5">
    <!--user address-->
    <a href="#" id="scroll"><span></span></a>
    <nav aria-label="breadcrumb"> 
        <ol class="breadcrumb">
            <li class=" item-1"></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('msg.home')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('msg.my_account')); ?></li>
        </ol>   
    </nav>
    <div class="container">
        <div class="row">
            <?php echo $__env->make("themes.$theme.user.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <main class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg">
                                <form method='POST'>
                                    <?php echo csrf_field(); ?>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label><?php echo e(__('msg.name')); ?></label>
                                            <input type="text" name="name" class="form-control" value="<?php echo e($data['profile']['name']); ?>" required>
                                        </div>
                                        <div class="col form-group">
                                            <label><?php echo e(__('msg.email')); ?></label>
                                            <input type="email" name="email" value="<?php echo e($data['profile']['email']); ?>" class="form-control">
                                            
                                        </div>                                       
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label><?php echo e(__('msg.mobile')); ?></label>
                                            <input type="text" value="<?php echo e($data['profile']['mobile']); ?>" class="form-control" disabled="disabled">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mt-4"><?php echo e(__('msg.update')); ?> </button>
                                    </div>         
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>   
        </div>   
    </div>
    <!--end user address-->
</section><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/user/account.blade.php ENDPATH**/ ?>