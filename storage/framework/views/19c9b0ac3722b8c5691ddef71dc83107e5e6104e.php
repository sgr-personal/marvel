<section class="section-content padding-bottom">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5">
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
                                        <div class="form-group col">
                                            <label><?php echo e(__('msg.old_password')); ?></label>
                                            <input class="form-control" name="current_password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label><?php echo e(__('msg.new_password')); ?></label>
                                            <input class="form-control" type="password" name="new_password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label><?php echo e(__('msg.confirm_new_password')); ?></label>
                                            <input class="form-control" type="password" name="new_password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block mt-4"> <?php echo e(__('msg.change_password')); ?> </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>   
        </div>   
    </div>
</section><?php /**PATH /home/thetricu/titalidesingerstudio.com/resources/views/themes/ekart/user/password.blade.php ENDPATH**/ ?>