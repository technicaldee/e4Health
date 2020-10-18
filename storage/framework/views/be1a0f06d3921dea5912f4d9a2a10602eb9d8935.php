<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <h1>Hello,<?php if(Auth::user()->role == 'Doctor'): ?> Dr. <?php endif; ?> <?php echo e(Auth::user()->name); ?></h1>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form action="<?php echo e(route('add')); ?>" method="POST">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tell us why you want to see the Doctor.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?php echo e(@csrf_field()); ?>

                        <textarea class="form-control" name="description"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                </form>
                  </div>
            </div>

            <?php if(Auth::user()->role == 'Doctor'): ?>
                <div class="card">
                    <div class="card-header"><?php echo e(__('NOTE!!!')); ?></div>

                    <div class="card-body">
                        Hi, you are logged in as a doctor... On normal grounds, you would've waited for an admin to confirm your data and approve it... However, this is a demo.
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <canvas id="myChart" width="400" height="400"></canvas>
                    <hr>
                    Unattended to: <?php echo e($u); ?>

                    <hr>
                    Attended to: <?php echo e($a); ?>

                <script>
                var ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Unattended', 'Attended to'],
                        datasets: [{
                            label: 'Complete vs Incomplete',
                            data: [<?php echo e($u); ?>, <?php echo e($a); ?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                });
                </script>
                </div>
                <div class="col-md-6">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Description</th>
                          <th scope="col">Status</th>
                          <th scope="col">Time Ago</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <th scope="row"><?php echo e($app->id); ?></th>
                          <td><?php echo e($app->description); ?></td>
                          <td><?php echo e($app->status); ?></td>
                          <td><?php echo e($app->updated_at); ?></td>

                          <td>
                            <center>
                                <?php if($app->status == 'Complete'): ?>
                                    Done
                                <?php else: ?>
                            <form action="<?php echo e(route('mark')); ?>" method="POST"><?php echo e(@csrf_field()); ?><button type="submit" name="btn" value="<?php echo e($app->id); ?>" class="btn btn-warning">Mark Complete</button></form>
                        <?php endif; ?>
                    </center></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                </div>
            </div>
                <?php else: ?>

        <?php if($c != 0): ?>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Description</th>
                  <th scope="col">Status</th>
                  <th scope="col">Time Ago</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th scope="row"><?php echo e($app->id); ?></th>
                  <td><?php echo e($app->description); ?></td>
                  <td><?php echo e($app->status); ?></td>
                  <td><?php echo e($app->updated_at); ?></td>

                  <td><form action="<?php echo e(route('del')); ?>" method="POST"><?php echo e(@csrf_field()); ?><center><button type="submit" name="btn" value="<?php echo e($app->id); ?>" class="btn btn-danger">Cancel</button></center></form></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php else: ?>
            <hr>
                <center><h4> No Appointments made yet. Use the 'Make Apointment' button </h4>
                <a data-toggle="modal" data-target="#appointmentModal" class="btn btn-success"><?php echo e(__('Make Appointment')); ?></a>
            </center>
            <?php endif; ?>

            <?php endif; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\uddy\e4health\resources\views/home.blade.php ENDPATH**/ ?>