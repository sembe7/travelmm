<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('module/booking/css/checkout.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <div id="bravo-checkout-page" >
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="form-title"><?php echo e(__('Booking Submission')); ?></h3>
                         <div class="booking-form">
                             <?php echo $__env->make($service->checkout_form_file ?? 'Booking::frontend/booking/checkout-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="booking-detail">
                            <?php echo $__env->make($service->checkout_booking_detail_file ?? '', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="col-md-6">
                                <button style="width: 320px" type="button" class="create-modal btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    Хамтран аялагчийн мэдээлэл нэмэх 
                                    
                                </button>
                            </div>
                            
                            <?php echo $__env->make('Booking::frontend/booking/add_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            

                            
        
        <div class="col-md-12" id="table_refresh">
            <div class="form-group">
 
                    <div class="table table-responsive">
                        <table class="table table-bordered " id="table">
                            <tr>
                                <th>№</th>
                                <th style="width:400px">Нэр</th>
                                
                                <th> 
                                    
                                </th>
                                <th > 
                                    
                                </th>
                            </tr>
                            <?php echo e(csrf_field()); ?>

                            <?php
                                $childrens = $user->children()->get();
                                $no=1; 
                            ?>
                            
                            
                                <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <tr>
                                    <td><?php echo e($no++); ?>  </td>
                                    <td><?php echo e($item->name); ?>  </td>
                                    
                                    <td> 
                                        
                                        <button type="button" value=<?php echo e($item->id); ?> class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo e($item->id); ?>"
                                            data-id="<?php echo e($ids = $item->id); ?>" >
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <?php echo $__env->make('Booking::frontend/booking/edit_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                        <td>
                                    <form method="post" class="delete-form" action="<?php echo e(action('\Modules\User\Controllers\UserController@delete',$item->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                            <button type="submit" class="delete-modal btn btn-danger" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            
                        </table>
                    </div>
                
            </div>
        </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="<?php echo e(asset('module/booking/js/checkout.js')); ?>"></script>
    <script type="text/javascript">
        jQuery(function () {
            $.ajax({
                'url': bookingCore.url + '/booking/<?php echo e($booking->code); ?>/check-status',
                'cache': false,
                'type': 'GET',
                success: function (data) {
                    if (data.redirect !== undefined && data.redirect) {
                        window.location.href = data.redirect
                    }
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\travel\modules/Booking/Views/frontend/checkout.blade.php ENDPATH**/ ?>