<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        // Get all appointments from the database
        $allAppointments = Appointment::where('status', '!=', 'cloturer')
        ->where('is_deleted', false)
        ->get();

        // Get all patients from the database
        $allpatients = Patient::all();
        
        // Filter appointments for today
        $today = now()->format('Y-m-d');
        
        $todayAppointments = Appointment::where('date', '>=', $today)
        ->where('date', '<', Carbon::parse($today)->addDay())
        ->where('status', '!=', 'cloturer')->where('is_deleted', false);

        $todayAppointmentsPaginate = Appointment::where('date', '>=', $today)
        ->where('date', '<', Carbon::parse($today)->addDay())
        ->where('status', '!=', 'cloturer')->where('is_deleted', false)->paginate(3);

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


        
        //$patients = Patient::all();
        return view('home', compact('allpatients','allAppointments','todayAppointments', 'currentMonthAppointments', 'todayAppointmentsPaginate'));
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
