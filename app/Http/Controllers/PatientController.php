<?php

namespace App\Http\Controllers;

use App\Models\Motifs;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class PatientController extends Controller
{
    public function index()
    {
    //     //return view('games.index', ['games' => $games]);
        // $patients = Patient::all();
        $patients = Patient::orderBy('id', 'desc')->get();
        return view('patient.list', compact('patients'));
    }

    public function create()
    {
        return view('patient.add');
    }

    public function store(Request $request) {

        // dd($request);

        $validatedDate = $request->validate([
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'age' => 'required|numeric|min:0',
            'genre' => 'required|in:Homme,Femme',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
        ]);
        //dd($validatedDate);

        // dd($validatedDate);

        $patient = Patient::create($validatedDate);

        // Check if schedule_appointment is true
        if ($request->has('schedule_appointment') && $request->input('schedule_appointment')) {
            // Create an appointment 10 days from now
            $appointmentDate = $this->calculateBusinessDays(now(), 10);;

            // Assuming you have an 'appointments' relationship method on your Patient model
            $appointment = $patient->appointments()->create([
                'date' => $appointmentDate,
                'status' => 'reprogrammer',
                // Add any other appointment fields as needed
            ]);
            
            // Attach motifs to the appointment
            $motifModel = Motifs::firstOrCreate([
                'appointment_id'=> $appointment->id,
                'date' => now(),
                'motif' => 'Premier RDV',
            ]);
            // $motifIds = $request->input('motif_ids', []);
            //$appointment->motifs()->attach($motifModel->id);
            //dd($motifModel);
            
        }

        // return redirect()->route('patient.index')->with('success', 'Nouveau patient créé avec succès!');

        return redirect()->route('appointment.index')->with('toast', [
            'type'=> 'success',
            'message'=> 'Nouveau patient créé avec succès!']);
    }

    public function detail(Patient $patient)
    {
        setlocale(LC_ALL,'fr.UTF-8');
        // $appointment = $patient->appointments()->with(['motifs' => function ($query) {
        //     $query->orderBy('date', 'desc'); // Order by motif date
        // }])
        // ->get();

        $appointment = $patient->appointments()
        ->where('is_deleted', false) // Filter appointments where is_delete is false
        ->where('status', '!=', 'cloturer') // Filter appointments where status is not 'cloture'
        ->with(['motifs' => function ($query) {
            $query->orderBy('date', 'desc'); // Order by motif date
        }])
        ->first();

        //dd($appointment);

        //$motifs = $appointment->motifs();

        // dd($motifs);
        return view('patient.detail', compact('patient', 'appointment'));
    }

    /**
     * Calculate business days (excluding weekends) from a given date.
     *
     * @param \Carbon\Carbon $startDate
     * @param int $businessDays
     * @return \Carbon\Carbon
     */
    private function calculateBusinessDays(Carbon $startDate, $businessDays)
    {
        $currentDate = $startDate->copy();

        while ($businessDays > 0) {
            $currentDate->addDay();

            // Check if the current day is not a weekend (Saturday or Sunday)
            if ($currentDate->dayOfWeek !== Carbon::SATURDAY && $currentDate->dayOfWeek !== Carbon::SUNDAY) {
                $businessDays--;
            }
        }

        return $currentDate;
    }

    public function delete(Patient $patient){

        //dd($patient);
        $searchPatient = Patient::find($patient->id);

        if ($searchPatient) {

            // Loop through each appointment of the patient
            foreach ($searchPatient->appointments as $appointment) {
                // Delete related motifs for each appointment
                $appointment->motifs()->delete();
            }

            // Delete related appointments
            $searchPatient->appointments()->delete();

            // Now delete the patient itself
            $searchPatient->delete();
        }

        return redirect()->route('patient.index')->with('toast', [
            'type'=> 'success',
            'message'=> 'Patient supprimé avec succès!']);

    }


}
