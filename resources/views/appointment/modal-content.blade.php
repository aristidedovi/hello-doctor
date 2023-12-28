
<form method="post" action="{{ route('appointment.reprogram', ['id' => $appointment->id]) }}">
    @csrf
    <div class="modal-header" style="display: block;">
        <h5 class="modal-title" id="exampleModalLabel">Reprogrammer le rendez-vous</</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div>
            <p>Mr. 
                <b>
                    {{ $appointment->patient->last_name }} 
                    {{ $appointment->patient->first_name }}
                </b>
            </p>
            <p>
                Date ancienne RDV : 
                <b>
                    {{ ucfirst($appointment->date->formatLocalized('%A %e %B %Y')). ' '.  $appointment->date->format('H:i') }}
                </b>
            </p>
            <!-- <p>Appointment ID: {{ $appointment->id }}</p>
            <p>Date: {{ $appointment->date }}</p> -->
            <!-- Add other appointment details as needed -->
            <input type="hidden" name="appointmentID" value="{{ $appointment->id }}">
            
            
            
            <div class="form-group">
                <label>Rendez vous dans (select one)*:</label>
                <select name="appointmentReprogram" class="form-control" id="sel1" required>
                    <option value="15">15 jours</option>
                    <option value="20">20 jours</option>
                    <option value="30">30 jours</option>
                </select>
                <!-- Display the estimated date here -->
                <p style="color: red;" id="estimatedDate">Estimation de la date: </p>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Motif *:</label>
                <textarea class="form-control" name="appointmentNewMotif" id="message-text" required></textarea>
            </div>
        </div>                                                 
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-success">Reprogrammer</button>
    </div>
</form>

<script>

    // Get the initial appointment date from PHP (replace this with your PHP code)
    var initialAppointmentDate = new Date("<?php echo $appointment->date; ?>");

    // Function to update the estimated date based on the selected number of days
    function updateEstimatedDate() {
        // Get the selected number of days
        var selectedDays = document.getElementById('sel1').value;

        // Calculate the estimated date
        var currentDate = new Date(initialAppointmentDate);
        // currentDate.setDate(currentDate.getDate() + parseInt(selectedDays));

        // Calculate the estimated date
        for (var i = 0; i < parseInt(selectedDays); i++) {
            // Increment the date by one day
            currentDate.setDate(currentDate.getDate() + 1);

            // Skip Sundays
            while (currentDate.getDay() === 0) {
                currentDate.setDate(currentDate.getDate() + 1);
            }
        }

        // // Check if the current day is Sunday
        // if (currentDate.getDay() === 0) {
        //     // If Sunday, add an extra day
        //     currentDate.setDate(currentDate.getDate() + 1);
        // }

        // Format the date and time
        var formattedDate = currentDate.toLocaleDateString('fr-FR', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        var formattedTime = currentDate.toLocaleTimeString('fr-FR', {
            hour: 'numeric',
            minute: 'numeric'
        });
        //var formattedDate = currentDate.toDateString();

        // Display the estimated date
        document.getElementById('estimatedDate').textContent = 'Estimation de la date: ' + formattedDate + ' ' + formattedTime;
    }

    // Attach the function to the change event of the select element
    document.getElementById('sel1').addEventListener('change', updateEstimatedDate);

    // Call the function initially to show the default estimation
    updateEstimatedDate();
</script>



