<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $__env->yieldContent('title'); ?></title>

        <link href="<?php echo e(theme('css/error.css')); ?>"  rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                <?php echo $__env->yieldContent('code'); ?>
            </div>

            <div class="message p-5">
                <?php echo $__env->yieldContent('message'); ?>
            </div>
        </div>
    </body>
</html>
<?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/errors/minimal.blade.php ENDPATH**/ ?>