<?php 
    use Illuminate\Support\Facades\DB;
?>
<div class="modal fade" id="modal-booking-<?php echo e($booking->id); ?>">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__("Booking ID")); ?>: #<?php echo e($booking->id); ?></h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#booking-detail-<?php echo e($booking->id); ?>"><?php echo e(__("Booking Detail")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#booking-customer-<?php echo e($booking->id); ?>"><?php echo e(__("Your Information")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#booking-with-<?php echo e($booking->id); ?>"><?php echo e(__("Хамтран аялагчид")); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="booking-detail-<?php echo e($booking->id); ?>" class="tab-pane active"><br>
                        <div class="booking-review">
                            <div class="booking-review-content">
                                <div class="review-section">
                                    <div class="info-form">
                                        <ul>
                                            <li>
                                                <div class="label"><?php echo e(__('Booking Date')); ?></div>
                                                <div class="val"><?php echo e(display_date($booking->created_at)); ?></div>
                                            </li>
                                            <?php if(!empty($booking->gateway)): ?>
                                                <?php $gateway = get_payment_gateway_obj($booking->gateway);?>
                                                <li>
                                                    <div class="label"><?php echo e(__('Payment Method')); ?></div>
                                                    <div class="val"><?php echo e($gateway->name); ?></div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="more-booking-review">
                            <?php echo $__env->make($service->checkout_booking_detail_file ?? '', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div id="booking-customer-<?php echo e($booking->id); ?>" class="tab-pane fade"><br>
                        <?php echo $__env->make($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    
                    <div id="booking-with-<?php echo e($booking->id); ?>" class="tab-pane fade"><br>
                        <div class="col-md-12">
                            <div class="form-group">
                 
                                    <div class="table table-responsive">
                                        <table class="table table-bordered " id="table">
                                            <tr>
                                                <th>№</th>
                                                <th style="width:400px">Нэр</th>
                                                <th style="width:400px">и-мэил</th>
                                                <th style="width:300px">утас</th>
                                                <th style="width:500px"> 
                                                    
                                                </th>
                                            </tr>
                                            <?php echo e(csrf_field()); ?>

                                            <?php
                                                
                                                
                                                // $user = App\User::where($booking->customer_id,1)->get();
                                                // echo $user;
                                                //$users =new App\User;
                                                // $user = new App\User;
                                                // $childrens = $users->children()->get();
                                                // print_r($childrens);
                                                $childrens = DB::table('users')
                                                    ->where('parent_id',$booking->customer_id)
                                                    ->where('deleted_at',null)
                                                    ->get();
                                                //$childrens = $users->children()->get();
                                                $no=1; 
                                            ?>
                                            
                                            
                                                
                                                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                    <tr>
                                                        <td><?php echo e($no++); ?>  </td>
                                                        <td><?php echo e($item->name); ?>  </td>
                                                        <td><?php echo e($item->email); ?></td>
                                                        <td><?php echo e($item->phone); ?>    </td>
                                                        <td> 
                                                            
                                                            
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
            <!-- Modal footer -->
            <div class="modal-footer">
                <span class="btn btn-secondary" data-dismiss="modal"><?php echo e(__("Close")); ?></span>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\travel\modules/Tour/Views/frontend/booking/detail-modal.blade.php ENDPATH**/ ?>