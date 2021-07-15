<div class="container section-content padding-bottom footerfix mt-5">
    <a href="#" id="scroll"><span></span></a>
    <div class="row">
        <?php echo $__env->make("themes.".get('theme').".user.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-md-9">
            <!-- address list -->
            <?php if(isset($data['address']) && is_array($data['address']) && count($data['address'])): ?>
            <div class="row">
                <div class="col-md-12" id="address">
                    <div class="card shadow mb-4">
                        <p class="product-name pb-0 font-weight-bold head" id="myDec"><?php echo e(__('msg.delivery_address')); ?></p>
                        <hr class="mb-0">
                        <table class="table table-borderless table-shopping-cart" aria-describedby="myDec" aria-hidden="true">
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if(isset($data['address']['error']) && $data['address']['error'] == true): ?>
                                                <div class="alert alert-danger"><?php echo e($data['address']['message'] ?? __('msg.user_address_not_exist')); ?></div>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $data['address']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($a->id) && intval($a->id)): ?>
                                                        <div class="row delivery-address">
                                                            <span class="form-group edit-delete">
                                                                <button class="btn editAddress" data-data='<?php echo e(json_encode($a)); ?>'> <em class="fa fa-pencil-alt"></em></button>
                                                                <a href="<?php echo e(route('address-remove', $a->id)); ?>" class="btn"> <em class="fas fa-times text-danger"></em></a>
                                                            </span>
                                                            <span class="form-group ml-3">
                                                                <label>
                                                                    <strong><?php echo e($a->name ?? ''); ?></strong><br>
                                                                    <label class="badge badge-primary"><?php echo e($a->type); ?></label> <?php echo e($a->address ?? ''); ?>, <?php echo e($a->area_name ?? ''); ?><br>
                                                                    <?php echo e($a->city_name ?? ''); ?> - <?php echo e($a->pincode ?? ''); ?><br>
                                                                    <?php echo e(__('msg.mobile')); ?>: <?php echo e(($a->country_code ?? '') ." ". ($a->mobile ?? '-')); ?>

                                                                </label>
                                                            </span>
                                                        </div>
                                                        <hr class="p-0">
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <div class="form-group mb-0 text-right">
                                                <button onclick="address()" class="btn btn-primary text-uppercase"><?php echo e(__('msg.add_new_address')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!--end address list-->
            </div>
            <div class="row padding-bottom">
                <!-- edit address -->
                <div class="col-md-12" id="editAddress">
                    <div class="card">
                        <p class="product-name pb-0 font-weight-bold head"><?php echo e(__('msg.edit_address')); ?></p>
                        <hr class="mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg">
                                    <form action='<?php echo e(route('address-add')); ?>' id='formEditAddress' method="POST">
                                        <input type="hidden" name="id">
                                        <input type="hidden" name="latitude" value="0">
                                        <input type="hidden" name="longitude" value="0">
                                        <input type="hidden" name="country_code" value="0">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.name')); ?></label>
                                                <input class="form-control" name="name" type="text">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.mobile_no')); ?></label>
                                                <input class="form-control" id='editPhone' type="number" name="mobile">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.alternate_mobile_no')); ?></label>
                                                <input class="form-control" type="number" name="alternate_mobile">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.address')); ?></label>
                                                <input class="form-control" type="text" name="address">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.landmark')); ?></label>
                                                <input class="form-control" type="text" name="landmark">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.pincode')); ?></label>
                                                <input class="form-control" type="number" name="pincode">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.select_city')); ?></label>
                                                <br>
                                                <select name='city' class="form-control" required>
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.select_area')); ?></label>
                                                <br>
                                                <select name='area' class="form-control" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.state')); ?></label>
                                                <input class="form-control" type="text" name="state" required>
                                            </div>
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.country')); ?></label>
                                                <input class="form-control" type="text" name="country" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label class="radio-inline">
                                              <input class="mr-2" type="radio" name="type" checked value="Home"><?php echo e(__('msg.home')); ?>

                                            </label>
                                            <label class="radio-inline  ml-5">
                                              <input class="mr-2" type="radio" name="type" value="Work"><?php echo e(__('msg.work')); ?>

                                            </label>
                                            <label class="radio-inline  ml-5">
                                              <input class="mr-2" type="radio" name="type" value="Other"><?php echo e(__('msg.other')); ?>

                                            </label>
                                        </div>
                                        <div class="form-row mb-4 mt-3">
                                            <input type="checkbox" name="is_default" class="mt-1" />
                                            <label class="control-label" for="default-address"> <?php echo e(__('msg.set_as_default_address')); ?></label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block text-uppercase"> <?php echo e(__('msg.update')); ?></button>
                                            <button class="btn btn-primary btn-block text-uppercase AddEditAddressCancel"> <?php echo e(__('msg.cancel')); ?> </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end edit address -->
            </div>
            <?php else: ?>

            <?php endif; ?>
            <div class="row padding-bottom">
                <!-- add address -->
                <div class="col-md-12" id="addAddress">
                    <div class="card">
                        <p class="product-name pb-0 font-weight-bold head"><?php echo e(__('msg.add_new_address')); ?></p>
                        <hr class="mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg">
                                    <form action='<?php echo e(route('address-add')); ?>' id='formAddAddress' method='POST'>
                                        <input type="hidden" name="latitude" value="0">
                                        <input type="hidden" name="longitude" value="0">
                                        <input type="hidden" name="country_code" value="0">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.name')); ?></label>
                                                <input class="form-control" name="name" type="text" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.mobile_no')); ?></label>
                                                <input class="form-control" id='addPhone' type="number" name="mobile" placeholder="Mobile No" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.alternate_mobile_no')); ?></label>
                                                <input class="form-control" type="number" placeholder="Alternate Mobile No" name="alternate_mobile">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.address')); ?></label>
                                                <input class="form-control" type="text" placeholder="Address" name="address" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.landmark')); ?></label>
                                                <input class="form-control" type="text" name="landmark" placeholder="Landmark" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.pincode')); ?></label>
                                                <input class="form-control" type="number" name="pincode" placeholder="Pincode" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.select_city')); ?></label>
                                                <br>
                                                <select name='city' class="form-control" required>
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.select_area')); ?></label>
                                                <br>
                                                <select name='area' class="form-control" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.state')); ?></label>
                                                <input class="form-control" type="text" name="state" placeholder="City" required>
                                            </div>
                                            <div class="form-group col">
                                                <label><?php echo e(__('msg.country')); ?></label>
                                                <input class="form-control" type="text" name="country" placeholder="Country" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label class="radio-inline">
                                                <input class="mr-2" type="radio" name="type" value="Home" checked><?php echo e(__('msg.home')); ?>

                                            </label>
                                            <label class="radio-inline  ml-5">
                                                <input class="mr-2" type="radio" name="type" value="Work"><?php echo e(__('msg.work')); ?>

                                            </label>
                                            <label class="radio-inline  ml-5">
                                                <input class="mr-2" type="radio" name="type" value="Other"><?php echo e(__('msg.other')); ?>

                                            </label>
                                        </div>
                                        <div class="form-row mb-4 mt-3">
                                            <input type="checkbox" name="is_default" class=" mt-1" />
                                            <label class="control-label" for="default-address"> <?php echo e(__('msg.set_as_default_address')); ?></label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block text-uppercase"> <?php echo e(__('msg.add_new_address')); ?> </button>
                                            <button class="btn btn-primary btn-block text-uppercase AddEditAddressCancel"> <?php echo e(__('msg.cancel')); ?> </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end add address -->
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('js/address.js')); ?>"></script><?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/user/addresses.blade.php ENDPATH**/ ?>