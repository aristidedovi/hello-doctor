<form method="post" action="{{ route('appointment.cloturer', ['id' => $appointment->id]) }}">
    @csrf
    <div class="modal-header" style="display: block;">
        <h5 class="modal-title" id="exampleModalLabel">Cloturer le rendez-vous</</h5>
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
            
            
            
            <!-- <div class="form-group">
                <label>Rendez vous dans (select one)*:</label>
                <select name="appointmentReprogram" class="form-control" id="sel1" required>
                    <option value="15">15 jours</option>
                    <option value="20">20 jours</option>
                    <option value="30">30 jours</option>
                </select>
                <p style="color: red;" id="estimatedDate">Estimation de la date: </p>
            </div> -->
            <div class="form-group">
                <label for="message-text" class="col-form-label">Motif *:</label>
                <textarea class="form-control" name="appointmentNewMotif" id="message-text" required></textarea>
            </div>
        </div>                                                 
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-success">Cloturer</button>
    </div>
</form>