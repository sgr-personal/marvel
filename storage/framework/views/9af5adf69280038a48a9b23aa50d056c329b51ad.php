<div class="section-content footerfix">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5 padding-bottom"> 
        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php if(count($data['faq'])): ?>
                        <?php $__currentLoopData = $data['faq']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?php echo e($faq->id); ?>">
                                  <h4 class="panel-title">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo e($faq->id); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($faq->id); ?>">
                                    <?php echo e($faq->question); ?>

                                  </a>
                                </h4>
                                </div>
                                <div id="collapse<?php echo e($faq->id); ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo e($faq->id); ?>">
                                  <div class="panel-body">
                                    <?php echo e($faq->answer); ?>

                                  </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="row text-center">
                            <div class="col-12">
                                <br><br>
                                <h3><?php echo e(__('msg.no_faq_found')); ?>.</h3>
                            </div>
                            <div class="col-12">
                                <br><br>
                                <a href="<?php echo e(route('shop')); ?>" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em> <?php echo e(__('msg.continue_shopping')); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
                
        </div>
        
    
        <div class="row mt-2">

            <div class="col">

                <?php if(isset($data['page']) && $data['page'] > 0): ?>

                    <a href="<?php echo e(route('faq'). (intval($data['page']-1) ? '?page='.($data['page']-1) : '')); ?>" class="btn btn-primary"><em class="fa fa-chevron-left"></em> <?php echo e(__('msg.previous')); ?></a>

                <?php endif; ?>

            </div>

            <div class="col text-right">

                <?php if(isset($data['page']) && $data['page'] != intval($data['total']/$data['limit'])): ?>

                    <a href="<?php echo e(route('faq')); ?>?page=<?php echo e($data['page']+1); ?>" class="btn btn-primary"> <?php echo e(__('msg.next')); ?> <em class="fa fa-chevron-right"></em></a>

                <?php endif; ?>

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

  $(".toggle-accordion").on("click", function() {
    var accordionId = $(this).attr("accordion-id"),
      numPanelOpen = $(accordionId + ' .collapse.in').length;
    
    $(this).toggleClass("active");

    if (numPanelOpen == 0) {
      openAllPanels(accordionId);
    } else {
      closeAllPanels(accordionId);
    }
  })

  openAllPanels = function(aId) {
    console.log("setAllPanelOpen");
    $(aId + ' .panel-collapse:not(".in")').collapse('show');
  }
  closeAllPanels = function(aId) {
    console.log("setAllPanelclose");
    $(aId + ' .panel-collapse.in').collapse('hide');
  }
     
});
</script><?php /**PATH /home/thetricu/titalidesingerstudio.com/resources/views/themes/ekart/faq.blade.php ENDPATH**/ ?>