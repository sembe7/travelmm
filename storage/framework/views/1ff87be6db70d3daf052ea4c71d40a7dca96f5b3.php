
<div class="form-checkout" id="form-checkout" >
    <input type="hidden" name="code" value="<?php echo e($booking->code); ?>">
    <div class="form-section">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label ><?php echo e(__("First Name")); ?> <span class="required">*</span></label>
                    <input type="text" placeholder="<?php echo e(__("First Name")); ?>" class="form-control" value="<?php echo e($user->first_name ?? ''); ?>" name="first_name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label ><?php echo e(__("Last Name")); ?> <span class="required">*</span></label>
                    <input type="text" placeholder="<?php echo e(__("Last Name")); ?>" class="form-control" value="<?php echo e($user->last_name ?? ''); ?>" name="last_name">
                </div>
            </div>
            <div class="col-md-6 field-email">
                <div class="form-group">
                    <label ><?php echo e(__("Email")); ?> <span class="required">*</span></label>
                    <input type="email" placeholder="<?php echo e(__("email@domain.com")); ?>" class="form-control" value="<?php echo e($user->email ?? ''); ?>" name="email">
                </div>
            </div>
            <div class="col-md-6 field-phone">
                <div class="form-group">
                    <label ><?php echo e(__("Phone")); ?> <span class="required">*</span></label>
                    <input type="text" placeholder="<?php echo e(__("Your Phone")); ?>" class="form-control" value="<?php echo e($user->phone ?? ''); ?>" name="phone">
                </div>
            </div>
            <div class="col-md-6 field-address-line-1">
                <div class="form-group">
                    <label ><?php echo e(__("Address line 1")); ?> </label>
                    <input type="text" placeholder="<?php echo e(__("Address line 1")); ?>" class="form-control" value="<?php echo e($user->address ?? ''); ?>" name="address_line_1">
                </div>
            </div>
            <div class="col-md-6 field-address-line-2">
                <div class="form-group">
                    <label ><?php echo e(__("Address line 2")); ?> </label>
                    <input type="text" placeholder="<?php echo e(__("Address line 2")); ?>" class="form-control" value="<?php echo e($user->address2 ?? ''); ?>" name="address_line_2">
                </div>
            </div>
            <div class="col-md-6 field-city">
                <div class="form-group">
                    <label ><?php echo e(__("City")); ?> </label>
                    <input type="text" class="form-control" value="<?php echo e($user->city ?? ''); ?>" name="city" placeholder="<?php echo e(__("Your City")); ?>">
                </div>
            </div>
            <div class="col-md-6 field-state">
                <div class="form-group">
                    <label ><?php echo e(__("State/Province/Region")); ?> </label>
                    <input type="text" class="form-control" value="<?php echo e($user->state ?? ''); ?>" name="state" placeholder="<?php echo e(__("State/Province/Region")); ?>">
                </div>
            </div>
            <div class="col-md-6 field-zip-code">
                <div class="form-group">
                    <label ><?php echo e(__("ZIP code/Postal code")); ?> </label>
                    <input type="text" class="form-control" value="<?php echo e($user->zip_code ?? ''); ?>" name="zip_code" placeholder="<?php echo e(__("ZIP code/Postal code")); ?>">
                </div>
            </div>
            <div class="col-md-6 field-country">
                <div class="form-group">
                    <label ><?php echo e(__("Country")); ?> </label>
                    <select name="country" class="form-control">
                        <option value=""><?php echo e(__('-- Select --')); ?></option>
                        <?php $__currentLoopData = get_country_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(($user->country ?? '') == $id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="form-group">
                    <hr style="border-top: 1px solid red">
                </div>
            </div>
            <div class="col-md-6 field-Foreign_FirstName">
                <div class="form-group"> 
                    <label ><?php echo e(__("Гадаад паспортын нэр /Англиар/")); ?> <span class="required">*</span></label>
                    <input type="text" class="form-control" required="" value="<?php echo e($user->Foreign_FirstName ?? ''); ?>" name="Foreign_FirstName" placeholder="<?php echo e(__("Гадаад паспортын нэр /Англиар/")); ?>">
                </div>
            </div>
            <div class="col-md-6 field-Foreign_LastName">
                <div class="form-group">
                    <label ><?php echo e(__("Гадаад паспортын овог /Англиар/")); ?> <span class="required">*</span> </label>
                    <input type="text" class="form-control" value="<?php echo e($user->Foreign_LastName ?? ''); ?>" name="Foreign_LastName" placeholder="<?php echo e(__("Гадаад паспортын овог /Англиар/")); ?>">
                </div>
            </div>
            <div class="col-md-6 field-Foreign_Registration">
                <div class="form-group"> 
                    <label ><?php echo e(__("Гадаад паспортын дугаар")); ?> <span class="required">*</span></label>
                    <input type="text" class="form-control" required="" value="<?php echo e($user->Foreign_Registration ?? ''); ?>" name="Foreign_Registration" placeholder="<?php echo e(__("Гадаад паспортын дугаар")); ?>">
                </div>
            </div>
            <div class="col-md-6 field-travel-destination">
                <div class="form-group">
                    <label ><?php echo e(__("Регистрийн дугаар")); ?> <span class="required">*</span> </label>
                    <input type="text" class="form-control" value="<?php echo e($user->Registration ?? ''); ?>" name="Registration" placeholder="<?php echo e(__("Регистрийн дугаар")); ?>">
                </div>
            </div>
            
            <div class="col-md-6 field-travel-country">
                <div class="form-group">
                    <label ><?php echo e(__("Гадаад паспорт олгосон өдөр")); ?> <span class="required">*</span> </label>
                    <input type="date" class="form-control" value="<?php echo e($user->Foreign_Start_Date ?? ''); ?>" name="Foreign_Start_Date" placeholder="<?php echo e(__("Гадаад паспортын олгосон өдөр")); ?>">
                </div>
            </div>
            <div class="col-md-6 field-Foreign_End_Date">
                <div class="form-group">
                    <label ><?php echo e(__("Гадаад паспортын дуусах хугацаа")); ?> <span class="required">*</span> </label>
                    <input type="date" class="form-control" value="<?php echo e($user->Foreign_End_Date ?? ''); ?>" name="Foreign_End_Date" placeholder="<?php echo e(__("Гадаад паспортын дуусах хугацаа")); ?>">
                </div>
            </div>
        
        
  

            <div class="col-md-12">
                <label ><?php echo e(__("Special Requirements")); ?> </label>
                <textarea name="customer_notes" cols="30" rows="6" class="form-control" placeholder="<?php echo e(__('Special Requirements')); ?>"></textarea>
            </div>
        </div>
    </div>
    <?php echo $__env->make($service->checkout_form_payment_file ?? 'Booking::frontend/booking/checkout-payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $term_conditions = setting_item('booking_term_conditions');
    ?>

    <div class="form-group">
        <label class="term-conditions-checkbox">
            <input type="checkbox" name="term_conditions"> <?php echo e(__('I have read and accept the')); ?>  <a target="_blank" href="<?php echo e(get_page_url($term_conditions)); ?>"><?php echo e(__('terms and conditions')); ?></a>
        </label>
    </div>
    <?php if(setting_item("booking_enable_recaptcha")): ?>
        <div class="form-group">
            <?php echo e(recaptcha_field('booking')); ?>

        </div>
    <?php endif; ?>

    <p class="alert-text mt10" v-show=" message.content" v-html="message.content" :class="{'danger':!message.type,'success':message.type}"></p>

    <div class="form-actions">
        <button class="btn btn-danger" @click="doCheckout"><?php echo e(__('Submit')); ?>

            <i class="fa fa-spin fa-spinner" v-show="onSubmit"></i>
        </button>
    </div>
</div>

<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\travel\modules/Booking/Views/frontend/booking/checkout-form.blade.php ENDPATH**/ ?>