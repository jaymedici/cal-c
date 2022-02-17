
<?php $__env->startSection('css'); ?>
<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/jquery-3.3.1.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/buttons.flash.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/buttons.print.min.js')); ?>"></script>

<script>
    $(window).on('load', function() {
        const columns = <?php echo json_encode($columns); ?>;
        let str = '';
        var i = 1;
        var columnObject = {data: "window_end_date_25", name: "window_end_date_25"};
        var cArray = [];
        var obj = {name: "participant_id", data: "participant_id"};

        for (const value of columns)
        {
           //console.log(value);
           //console.log('{ data: ' + value.data + ',  name: ' + value.name + '},');
           str += "{ data: '" + value.data + "', name: '" + value.name + "'}, ";
           columnObject = Object.assign({value}, columnObject);
        }

        for (let i=1; i <= columns.length; i++)
        {
            //console.log(columns[i].name);
            //cArray.push(columns[i]);
            obj = Object.assign(obj, columns[i]);
        }

        //data = JSON.parse(columns);
    
        console.log(columns);
        
    });

    $(function() {
        var url = '<?php echo e(url('participantVisits/projectVisitsIndexDT')); ?>';   
        var project = <?php echo json_encode($project); ?>;
        var projectId = project.id;
        var cArray = [];
        // Get Columns
        const columns = <?php echo json_encode($columns); ?>;
        let strColumns = '';
        for (const value of columns)
        {
           //console.log(value);
           //console.log('{ data: ' + value.data + ',  name: ' + value.name + '},');
           strColumns += "{ data: '" + value.data + "', name: '" + value.name + "'}, ";
        }


        $('#table').DataTable({
            processing: true,
            serverSide: true,
            "scrollX": true,
            dom: 'Blfrtip',
            buttons: ['copy','excel','csv','pdf'],
            ajax: url + '/' + projectId,
            columns: columns
        });

        

        
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="card card-primary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Participant Visit Schedule for <?php echo e($project->name); ?></h4>
        </div>

        <div class="card-body">
            <div class="table-responsive table-bordered">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Participant ID</th>
                            <?php $__currentLoopData = $project->visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up"): ?>
                                <th colspan="4"><?php echo e($visit->visit_name); ?></th>
                                <?php else: ?>
                                <th><?php echo e($visit->visit_name); ?></th>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>

                        <tr>
                            <th></th>
                            <?php $__currentLoopData = $project->visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up"): ?>
                                <th>Window Min</th>
                                <th>Calculated</th>
                                <th>Actual</th>
                                <th>Window Max</th>
                                <?php else: ?>
                                <th>Date</th>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                </table>
                
            </div>
        </div>
    </div>
</div>  

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/participantVisits/projectVisitsIndexDT.blade.php ENDPATH**/ ?>