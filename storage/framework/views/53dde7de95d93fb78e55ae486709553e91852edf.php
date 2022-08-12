
    <script>
        //  Appointment Forms
        window.addEventListener('show-set-appointment-form', event => {
            $('#setAppointmentForm').modal('show');
        });

        window.addEventListener('show-change-appointment-form', event => {
            $('#changeAppointmentForm').modal('show');
        });

        window.addEventListener('show-create-appointment-form', event => {
            $('#createAppointmentForm').modal('show');
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

        //Participant Visit Forms
        window.addEventListener('show-edit-participant-visit-form', event => {
            $('#editParticipantVisitForm').modal('show');
        });

        //Enrolled Participant Forms
        window.addEventListener('show-change-study-arm-form', event => {
            $('#changeStudyArmForm').modal('show');
        });

        //Hide All Forms Here
        window.addEventListener('hide-form', event => {
            $('#createUserForm').modal('hide');
            $('#editUserForm').modal('hide');
            $('#editScreeningForm').modal('hide');
            $('#setAppointmentForm').modal('hide');
            $('#changeAppointmentForm').modal('hide');
            $('#createAppointmentForm').modal('hide');
            $('#changeStudyArmForm').modal('hide');
            $('#editParticipantVisitForm').modal('hide');

            toastr.success(event.detail.message, 'Success');
        });

        //Screening Delete Prompt
        window.addEventListener('delete-screening-promt', event => {
            
        });

    </script><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/partials/browserEventListeners.blade.php ENDPATH**/ ?>