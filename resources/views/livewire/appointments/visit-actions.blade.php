<div>
    <form wire:submit.prevent="saveVisitAction({{$appointment}})" action="">

    <div class="row">
    <div class="form-group ">
        <div class="custom-control custom-radio">
            <input wire:model="form_state.visit_status" class="custom-control-input custom-control-success @error('visit_status') is-invalid @enderror" type="radio" value="Completed" name="visitAction" id="customRadio">
            <label for="customRadio" class="custom-control-label">Mark Visit as Completed</label>
        </div>

        <div class="custom-control custom-radio">
            <input wire:model="form_state.visit_status" class="custom-control-input custom-control-input-danger @error('visit_status') is-invalid @enderror" type="radio" value="Missed" name="visitAction" id="customRadio2">
            <label for="customRadio2" class="custom-control-label">Mark Visit as Missed</label>
            @error('visit_status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
    </div>
    <br>
    </div>

    @if(isset($form_state['visit_status']) && $form_state['visit_status'] == "Completed")
    <div class="row form-group">
        <label for="actual_visit_date">Completed Date</label>
        <input wire:model="form_state.actual_visit_date" type="date" name="actual_visit_date" class="form-control @error('actual_visit_date') is-invalid @enderror" id="actual_visit_date">
        @error('actual_visit_date')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @endif

    <div class="row">
        <button class="btn btn-success" type="submit">Save Visit</button>
    </div>
    </form>

</div>
