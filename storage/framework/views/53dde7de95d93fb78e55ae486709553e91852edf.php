
    <script>
        //  Appointment Forms
        window.addEventListener('show-set-appointment-form', event => {
            $('#setAppointmentForm').modal('show');
        });

        window.addEventListener('show-change-appointment-form', event => {
            $('#changeAppointmentForm').modal('show');
        });

        // User Registration Forms
        window.addEventListener('show-edit-user-form', event => {
            $('#editUserForm').modal('show');
        });

        window.addEventListener('show-create-user-form', event => {
            $('#createUserForm').modal('show');
        });

        //Screening Forms
        window.addEventListener('show-edit-screening-form', event => {
            $('#editScreeningForm').modal('show');
        });

        //Hide All Forms Here
        window.addEventListener('hide-form', event => {
            $('#createUserForm').modal('hide');
            $('#editUserForm').modal('hide');
            $('#editScreeningForm').modal('hide');
            $('#setAppointmentForm').modal('hide');
            $('#changeAppointmentForm').modal('hide');

            toastr.success(event.detail.message, 'Success');
        });

        //Screening Delete Prompt
        window.addEventListener('delete-screening-promt', event => {
            
        });

    </script><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/partials/browserEventListeners.blade.php ENDPATH**/ ?>