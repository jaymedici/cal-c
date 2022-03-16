<div>
    <form action="">

    <div class="row">
    <div class="form-group">
        <div class="custom-control custom-radio">
            <input wire:model="visitStatus" class="custom-control-input custom-control-success" type="radio" value="Completed" name="visitAction" id="customRadio">
            <label for="customRadio" class="custom-control-label">Mark Visit as Completed</label>
        </div>

        <div class="custom-control custom-radio">
            <input wire:model="visitStatus" class="custom-control-input custom-control-input-danger" type="radio" value="Missed" name="visitAction" id="customRadio2">
            <label for="customRadio2" class="custom-control-label">Mark Visit as Missed</label>
        </div>
    </div>
    <br>
    </div>

    <?php if($visitStatus == "Completed"): ?>
    <div class="row form-group">
        <label for="completed_date">Completed Date</label>
        <input type="date" name="completed_date" class="form-control" id="completed_date">
    </div>
    <?php endif; ?>

    <div class="row">
        <button class="btn btn-success" type="submit">Save Visit</button>
    </div>
    </form>

</div>
<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/appointments/visit-actions.blade.php ENDPATH**/ ?>