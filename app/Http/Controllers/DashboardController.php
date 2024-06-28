<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        setlocale(LC_ALL,'fr.UTF-8');
        // Get all appointments from the database
        $allAppointments = Appointment::where('status', '!=', 'cloturer')
        ->where('is_deleted', false)
        ->get();

        

        // Get all patients from the database
        $allpatients = Patient::all();
        $patientPaginate = Patient::paginate(5,  ['*'], 'patient_page');

       
        // Filter appointments for today
        $today = now()->format('Y-m-d');
        
        $todayAppointments = Appointment::where('date', '>=', $today)
        ->where('date', '<', Carbon::parse($today)->addDay())
        ->where('status', '!=', 'cloturer')->where('is_deleted', false);

        $todayAppointmentsPaginate = Appointment::where('date', '>=', $today)
        ->where('date', '<', Carbon::parse($today)->addDay())
        ->where('status', '!=', 'cloturer')->where('is_deleted', false)->paginate(3,   ['*'], 'appointment_page');

        $motifs = [];
        foreach ($todayAppointmentsPaginate as $appointment) {
            $motifs[] = $appointment->motifs;
        }
        //dd($motifs);
        // Filter appointments for the current month
        // $month = now()->format('m');
        // $year = now()->format('Y');
        // $currentMonthAppointments = $allAppointments
        // ->whereMonth('date', $month)
        // ->whereYear('date', $year);

        // Filter appointments for the current month
        // $currentMonthAppointments = $allAppointments->filter(function ($appointment) {
        //     return Carbon::parse($appointment->date)->month == now()->month;
        // });

        // Get appointments for the current month
        $currentMonthAppointments = Appointment::whereMonth('date', now()->month)
        ->whereYear('date', now()->year)
        ->where('status', '!=', 'cloturer')
        ->where('is_deleted', false)
        ->get();

        if ($request->ajax()) {
            //dd($request);
            if ($request->has('patient_page')) {
                return view('patient.partials.patients', compact('patientPaginate'))->render();
            } 
            
            if($request->has('appointment_page')) {
                return view('appointment.partials.appointment', compact('todayAppointmentsPaginate'))->render();
            }

            if ($request->has('search_query')) {
                $searchQuery = $request->input('search_query');
                $filteredPatients = Patient::where('first_name', 'like', '%'.$searchQuery.'%')
                    ->orWhere('last_name', 'like', '%'.$searchQuery.'%')
                    ->orWhere('code', 'like', '%'.$searchQuery.'%')
                    ->paginate(5, ['*'], 'patient_page');

                return view('patient.partials.patients', compact('filteredPatients'))->render();
            }

            if ($request->has('search_query_appointment')) {
                $searchQuery = $request->input('search_query_appointment');
                // $filteredAppointment = Appointment::where('first_name', 'like', '%'.$searchQuery.'%')
                //     ->orWhere('last_name', 'like', '%'.$searchQuery.'%')
                //     ->orWhere('code', 'like', '%'.$searchQuery.'%')
                //     ->paginate(5, ['*'], 'patient_page');

                $filteredAppointment = Appointment::where('date', '>=', $today)
                ->where('date', '<', Carbon::parse($today)->addDay())
                ->where('status', '!=', 'cloturer')->where('is_deleted', false)
                ->whereHas('patient', function($query) use ($searchQuery) {
                    $query->where('first_name', 'like', '%'.$searchQuery.'%')
                        ->orWhere('last_name', 'like', '%'.$searchQuery.'%')
                        ->orWhere('code', 'like', '%'.$searchQuery.'%');
                })->paginate(3, ['*'], 'appointment_page');

                // ->whereHas('motifs', function($query) use ($searchQuery) {
                //     $query->where('motif', 'like', '%'.$searchQuery.'%');
                // })

                return view('appointment.partials.appointment', compact('filteredAppointment'))->render();
            }

            if ($request->has('filter')) {

                $filter = $request->input('filter');

                // if ($filter === "all") {
                //     $filteredAppointment = Appointment::where('status', '!=', 'cloturer')
                //     ->where('is_deleted', false)->paginate(3,   ['*'], 'appointment_page');

                //     return view('appointment.partials.appointment', compact('filteredAppointment'))->render();
                // }


                if($filter === "today") {
                    $filteredAppointment = Appointment::where('date', '>=', $today)
                    ->where('date', '<', Carbon::parse($today)->addDay())
                    ->where('status', '!=', 'cloturer')->where('is_deleted', false)->paginate(3,   ['*'], 'appointment_page');

                    return view('appointment.partials.appointment', compact('filteredAppointment'))->render();
                }
                
               
                return $filter;
                //return view('appointment.partials.appointment', compact('allAppointments'))->render();
            }

        }
        


        
        //$patients = Patient::all();
        return view('home', compact('allpatients', 'patientPaginate','allAppointments','todayAppointments', 'currentMonthAppointments', 'todayAppointmentsPaginate'));
    }


    public function calendar() {
       
        // Get all appointments from the database
        // $allAppointments = Appointment::all();

        $allAppointments = Appointment::where('status', '!=', 'cloturer')
        ->where('is_deleted', false)
        ->get();

        return view('calendar', compact('allAppointments'));
    }


}
