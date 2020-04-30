<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(url('admin/module/user/store/'.($row->id ?? -1))); ?>" method="post" class="needs-validation" novalidate>
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? 'Edit: '.$row->getDisplayName() : 'Add new user'); ?></h1>
                </div>
            </div>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('User Info')); ?></strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("First name")); ?></label>
                                        <input type="text" required value="<?php echo e(old('first_name',$row->first_name)); ?>" name="first_name" placeholder="<?php echo e(__("First name")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Last name")); ?></label>
                                        <input type="text" required value="<?php echo e(old('last_name',$row->last_name)); ?>" name="last_name" placeholder="<?php echo e(__("Last name")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Email')); ?></label>
                                        <input type="email" required value="<?php echo e(old('email',$row->email)); ?>" placeholder="<?php echo e(__('Email')); ?>" name="email" class="form-control" <?php echo e($row->id ? 'readonly="readonly"' : ''); ?> >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Phone')); ?></label>
                                        <input type="text" value="<?php echo e(old('phone',$row->phone)); ?>" placeholder="<?php echo e(__('Phone')); ?>" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Birthday')); ?></label>
                                        <input type="text" value="<?php echo e(old('phone',$row->birthday)); ?>" placeholder="<?php echo e(__('Birthday')); ?>" name="birthday" class="form-control has-datepicker input-group date" id='datetimepicker1'>

                                    </div>
                                </div>
                                <div class="col-md-6">&nbsp;</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Address Line 1')); ?></label>
                                        <input type="text" value="<?php echo e(old('address',$row->address)); ?>" placeholder="<?php echo e(__('Address')); ?>" name="address" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Address Line 2')); ?></label>
                                        <input type="text" value="<?php echo e(old('address2',$row->address2)); ?>" placeholder="<?php echo e(__('Address 2')); ?>" name="address2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 field-Foreign_FirstName">
                                    <div class="form-group"> 
                                        <label ><?php echo e(__("Гадаад паспортын нэр /Англиар/")); ?> </label>
                                        <input type="text" value="<?php echo e(old('Foreign_FirstName',$row->Foreign_FirstName)); ?>" placeholder="<?php echo e(__('Гадаад паспортын нэр 2')); ?>" name="Foreign_FirstName" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 field-Foreign_LastName">
                                    <div class="form-group"> 
                                        <label ><?php echo e(__("Гадаад паспортын овог /Англиар/")); ?> </label>
                                        <input type="text" value="<?php echo e(old('Foreign_LastName',$row->Foreign_LastName)); ?>" placeholder="<?php echo e(__('Гадаад паспортын овог 2')); ?>" name="Foreign_LastName" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 field-Foreign_Registration">
                                    <div class="form-group"> 
                                        <label ><?php echo e(__("Гадаад паспортын дугаар")); ?> <span class="required">*</span></label>
                                        <input type="text" value="<?php echo e(old('Foreign_Registration',$row->Foreign_Registration)); ?>" placeholder="<?php echo e(__('Гадаад паспортын дугаар')); ?>" name="Foreign_Registration" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 field-travel-destination">
                                    <div class="form-group">
                                        <label ><?php echo e(__("Регистрийн дугаар")); ?> <span class="required">*</span> </label>
                                        <input type="text" value="<?php echo e(old('Registration',$row->Registration)); ?>" placeholder="<?php echo e(__('Паспортын дугаар')); ?>" name="Registration" class="form-control">
                                    </div>
                                </div>
        
                                <div class="col-md-6 field-travel-country">
                                    <div class="form-group">
                                        <label ><?php echo e(__("Гадаад паспорт олгосон өдөр")); ?> <span class="required">*</span> </label>
                                        <input type="text" value="<?php echo e(old('Foreign_Start_Date',$row->Foreign_Start_Date)); ?>" placeholder="<?php echo e(__('Гадаад паспорт олгосон өдөр')); ?>" name="Foreign_Start_Date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 field-travel-destination">
                                    <div class="form-group">
                                        <label ><?php echo e(__("Гадаад паспортын дуусах хугацаа")); ?> <span class="required">*</span> </label>
                                        <input type="text" value="<?php echo e(old('Foreign_End_Date',$row->Foreign_End_Date)); ?>" placeholder="<?php echo e(__('Гадаад паспортын дуусах хугацаа')); ?>" name="Foreign_End_Date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 field-travel-destination">
                                    <div class="form-group">
                                        <label ><?php echo e(__("Иргэний үнэмлэхний зураг")); ?> <span class="required">*</span> </label>
                                        <?php echo \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('Registration_image',old('Registration_image',$row->Registration_image)); ?>

                                    </div>
                                </div>
                                <div class="col-md-12 field-travel-destination">
                                    <div class="form-group">
                                        <label ><?php echo e(__("Гадаад паспортын зураг")); ?> <span class="required">*</span> </label>
                                        <?php echo \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('Foreign_Registration_image',old('Foreign_Registration_image',$row->Foreign_Registration_image)); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo e(__('Biographical')); ?></label>
                                <div class="">
                                    <textarea name="bio" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e(old('bio',$row->bio)); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label><?php echo e(__('Status')); ?></label>
                                <select required class="custom-select" name="status">
                                    <option value=""><?php echo e(__('-- Select --')); ?></option>
                                    <option <?php if(old('status',$row->status) =='publish'): ?> selected <?php endif; ?> value="publish"><?php echo e(__('Publish')); ?></option>
                                    <option <?php if(old('status',$row->status) =='blocked'): ?> selected <?php endif; ?> value="blocked"><?php echo e(__('Blocked')); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Role')); ?></label>
                                <select required class="custom-select" name="role_id">
                                    <option value=""><?php echo e(__('-- Select --')); ?></option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>" <?php if(!old('role_id') && $row->hasRole($role)): ?> selected <?php elseif(old('role_id')  == $role->id ): ?> selected <?php endif; ?> ><?php echo e(ucfirst($role->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Avatar')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('avatar_id',old('avatar_id',$row->avatar_id)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span></span>
                <button class="btn btn-primary" type="submit"><?php echo e(__('Save Change')); ?></button>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script.body'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\travel\modules/User/Views/admin/detail.blade.php ENDPATH**/ ?>