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
                        
                        
                        // $user = App\User::where($user->id,'parent_id')->get();
                        // echo $user;
                        //$childrens = App\User::children()->get();
                        $user = new App\User;
                        $childrens = $user->children()->get();
                        print_r($childrens);
                        $no=1; 
                    ?>
                    
                    
                        
                            <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <tr>
                                <td><?php echo e($no++); ?>  </td>
                                <td><?php echo e($item->name); ?>  </td>
                                <td><?php echo e($item->email); ?></td>
                                <td><?php echo e($item->phone); ?>    </td>
                                <td> 
                                    
                                    <a type="button" value=<?php echo e($item->id); ?> class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg"
                                        data-id="<?php echo e($item->id); ?>">
                                        <i class="fa fa-pencil"></i><?php echo e($item->id); ?>

                                    </a>
                                    <a href="#" class="delete-modal btn btn-danger" style="width: 30%">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    
                </table>
            </div>
        
    </div>
</div><?php /**PATH C:\xampp\htdocs\travel\modules/Booking/Views/frontend/booking/withTriper.blade.php ENDPATH**/ ?>