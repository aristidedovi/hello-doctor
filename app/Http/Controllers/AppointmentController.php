<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use App\Notifications\PatientNotification;
use App\Notifications\PatientSms;
use App\Notifications\WhatsAppNotification;



class AppointmentController extends Controller
{
    public function index()
    {
    //     //return view('games.index', ['games' => $games]);
        // $appointments = Appointment::all();

        //setlocale(LC_TIME, 'French');
        // Carbon::setLocale('fr');
        setlocale(LC_ALL,'fr.UTF-8');
        $appointments = Appointment::where('status', '!=', 'cloturer')
        ->where('is_deleted', false)
        ->orderBy('date', 'asc')
        ->get();

        
        return view('appointment.list', compact('appointments'));
    }

    public function archive()
    {
    //     //return view('games.index', ['games' => $games]);
        // $appointments = Appointment::all();

        //setlocale(LC_TIME, 'French');
        // Carbon::setLocale('fr');
        setlocale(LC_ALL,'fr.UTF-8');
        $appointments = Appointment::where('status', '=', 'cloturer')
        ->orWhere('is_deleted', true)
        ->orderBy('date', 'asc')
        ->get();

        
        return view('appointment.list', compact('appointments'));
    }

    public function create()
    {
        //$patients = Patient::all();
        // Use $patientsWithoutAppointments as needed
        $patients = Patient::whereDoesntHave('appointments', function ($query) {
            $query->where('status','!=', 'cloturer'); // Adjust 'cloturer' to your specific status value
        })->get();

        return view('appointment.add', compact('patients'));
    }

    public function store(Request $request) {

        $patient = Patient::all();

        $patient = Patient::where('code', $request->patient_id)->first();
        //dd($patient);

        if (!$patient) {
            // Manually create a MessageBag instance with an error message
            $errors = new MessageBag(['custom_error' => ['This is a custom error.']]);

            // Assign the created MessageBag to the $errors variable
            view()->share('errors', $errors);

            return  back()->withErrors('Patient code is not valid!')->withInput();
            //abort(404); // Patient not found
        }

        $existingAppointment = $patient->appointments()
        ->where('is_deleted', false) // Filter appointments where is_delete is false
        ->where('status', '!=', 'cloturer') // Filter appointments where status is not 'cloture'
        ->first();

        if ($existingAppointment) {

            return redirect()->route('patient.detail', ['patient' => $patient])->with('toast', [
                'type'=> 'success',
                'message'=> 'Le patient a un RDV non cloturer !']);
        }

        // Parse the input string using Carbon
        $carbonDate = Carbon::createFromFormat('l j F Y - H:i', $request->date);

        // Get the default Laravel datetime format
        $laravelDatetime = $carbonDate->toDateTimeString();
        $request->merge([
            'date' => $laravelDatetime,
            'patient_id'=> $patient->id,
        ]);
    

        // Input request validation
        $validatedData = $request->validate([
            'patient_id'=>'required',
            'date' => 'required|date',
            'motif'=>'required',
            'status' => 'nullable|in:en cours,reprogrammer,cloturer'
        ]);

        // Insert new appointment on database
        $appointment  = Appointment::create($validatedData);

        // Add logic to associate a motif with the appointment
        $motifData = [
            'appointment_id' => $appointment->id,
            'motif' => $request->input('motif'), 
            'date' => $appointment->date // Assuming you have a 'motif_description' field in your request
        ];

        // You can also associate the motif directly if you have a relationship set up
        $appointment->motifs()->create($motifData);

        // Send email notification
        //$patient->notify(new PatientSms($appointment));
        //dd($patient->notify(new WhatsAppNotification($appointment)));



        // Redirect to appointment list page
        return redirect()->route('patient.detail', ['patient' => $patient])
        ->with('toast', [
            'type'=> 'success',
            'message'=> 'Rendez-vous créé avec succès!']);
    }

    public function show(Appointment $appointment)
    {
        
        return view('appointment.show', compact('appointment'));
    }

    public function updateState(Request $request, Appointment $appointment) {

        // Validate the incoming request if necessary
        $request->validate([
            'new_state' => 'require|in:pending,confirmed,canceled',
        ]);

        // Update the state of the appointment
        $appointment->update(['state' => $request->input('new_state')]);

        // Redirect back or wherever appropriate
        return redirect()->route('appointments.index')->with('toast', [
            'type'=> 'success',
            'message'=> 'Appointment state updated successfully!']);

    } 


    public function delete(Appointment $appointment){
        //dd($appointment);
        $searchAppointment = Appointment::findOrFail($appointment->id);
        // dd($appointment);
        // Delete associated motifs

        if ($searchAppointment) {
            $appointment->motifs()->delete();

            // Delete the appointment
            $appointment->delete();

            return redirect()->route('appointment.index')->with('toast', [
                'type'=> 'success',
                'message'=> 'Appointment deleted successfully']);
        } else {

            return redirect()->route('appointment.index')->with('toast', [
                'type'=> 'error',
                'message'=> 'Appointment not existed']);
        }
        
    }

    public function detail(Appointment $patient)
    {
        Carbon::setLocale('fr');
        $appointments = $patient->appointments;
        //dd($appointments);
        return view('appointment.detail', compact('patient', 'appointments'));
    }

    public function getAppointmentData($id)
    {
        setlocale(LC_ALL,'fr.UTF-8');
        $appointment = Appointment::findOrFail($id);

        return view('appointment.modal-content', compact('appointment'));
    }


    public function getAppointmentDataCloturer($id)
    {
        setlocale(LC_ALL,'fr.UTF-8');
        $appointment = Appointment::findOrFail($id);

        return view('appointment.modal-cloturer', compact('appointment'));
    }

    public function appointmentCloturer(Request $request, $id){
        $appointmentStatus = 'cloturer';

        // Retrieve the appointment by ID
        $appointment = Appointment::find($id);
        $patient = $appointment->patient;

        if (!$appointment) {
            return redirect()->route('patient.detail', ['patient' => $patient])->with('toast', [
                'type'=> 'error',
                'message'=> 'Appointment not found!']);
        }

        // Update the appointment with the new status
        $appointment->status = $appointmentStatus;
        $appointment->save();

        // Add logic to associate a motif with the appointment
        $motifData = [
            'appointment_id' => $appointment->id,
            'motif' => $request->input('appointmentNewMotif'), 
            'date' => $appointment->date // Assuming you have a 'motif_description' field in your request
        ];

        // You can also associate the motif directly if you have a relationship set up
        $appointment->motifs()->create($motifData);


        return redirect()->route('patient.detail', ['patient' => $patient])->with('toast', [
            'type'=> 'success',
            'message'=> 'Rendez-vous cloturer avec succès!']);
    }


    public function appointmentReprogram(Request $request, $id)
    {
        setlocale(LC_ALL,'fr.UTF-8');
        $appointmentStatus = 'reprogrammer';
        // $appointment = Appointment::findOrFail($id);

        // Retrieve the appointment by ID
        //$appointment = Appointment::find($id);

        

        // Retrieve the appointment by ID
        $appointment = Appointment::find($id);
        // $nbrDeJour = 15;
        $patient = $appointment->patient;

        //dd($request);

        if (!$appointment) {
            return redirect()->route('patient.detail', ['patient' => $patient])->with('toast', [
                'type'=> 'error',
                'message'=> 'Appointment not found!']);
        }

        

        // Reprogram the appointment (similar to the previous example)
        $newDate = $this->reprogramAppointment($appointment, $request->appointmentReprogram);

        // Update the appointment with the new date
        $appointment->date = $newDate;
        $appointment->status = $appointmentStatus;
        $appointment->save();


        // Add logic to associate a motif with the appointment
        $motifData = [
            'appointment_id' => $appointment->id,
            'motif' => $request->input('appointmentNewMotif'), 
            'date' => $appointment->date // Assuming you have a 'motif_description' field in your request
        ];

        // You can also associate the motif directly if you have a relationship set up
        $appointment->motifs()->create($motifData);

        // Redirect to the appointments index page with a success message
        // return view('appointment.modal-content', compact('appointment'));
        return redirect()->route('patient.detail', ['patient' => $patient])->with('toast', [
            'type'=> 'success',
            'message'=> 'Rendez-vous reprogrammer avec succès!']);


    }


    private function reprogramAppointment(Appointment $appointment, $nbrDeJour)
    {
        // Clone the original date to avoid modifying the original object
        $newDate = clone $appointment->date;

        // Add 15 days and skip Sundays
        //$daysToAdd = 15;
        while ($nbrDeJour > 0) {
            $newDate->modify('+1 day');
            if ($newDate->format('N') !== '7') {
                // Not Sunday, so decrement the remaining days
                $nbrDeJour--;
            }
        }

        return $newDate;
    }
}
