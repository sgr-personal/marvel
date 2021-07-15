
<section class="section-content padding-bottom mt-4 spacingrm">
    <a href="#" id="scroll"><span></span></a>
    <div class="container">
            <?php if(Cache::has('sliders') && is_array(Cache::get('sliders')) && count(Cache::get('sliders'))): ?>
                <div class="col-12 p-0">
                    <div class="slider12">
                        <!-- ================== COMPONENT SLIDER  BOOTSTRAP  ==================  -->
                        <div id="carouselDocumentationIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php for($i =0; $i < count(Cache::get('sliders')); $i++): ?>
                                    <li data-target="#carouselDocumentationIndicators" data-slider-to="<?php echo e($i); ?>" <?php echo e($i == 0 ? 'class="active"' : ''); ?>></i>
                                <?php endfor; ?>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php $__currentLoopData = Cache::get('sliders'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="carousel-item <?php echo e($i == 0 ? 'active' : ''); ?>">
                                        <img src="<?php echo e($s->image); ?>" alt="<?php echo e($s->name); ?>" class="d-block img-fluid" >
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselDocumentationIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only"><?php echo e(__('msg.previous')); ?></span>
                            </a>
                            <a class="carousel-control-next" href="#carouselDocumentationIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only"><?php echo e(__('msg.next')); ?></span>
                            </a>
                        </div>
                    </div>

                </div><!-- col-->
                <!-- ==================  COMPONENT SLIDER BOOTSTRAP end.// ==================  .// -->
            <?php endif; ?>

    </div> <!-- card-body.// -->

</section>
<?php /**PATH /home/thetricu/titalidesingerstudio.com/resources/views/themes/ekart/home.blade.php ENDPATH**/ ?>