<script>
    var calendar;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar-<?php echo e($id); ?>')
        calendar = new FullCalendar.Calendar(calendarEl,
            <?php echo $options; ?>,
        );
        calendar.render();
    });
</script>
<?php /**PATH C:\xampp\htdocs\Visitcallender\vendor\acaronlex\laravel-calendar\src/views//script.blade.php ENDPATH**/ ?>