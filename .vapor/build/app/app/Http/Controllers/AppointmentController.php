<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
    //     //return view('games.index', ['games' => $games]);
        $appointments = Appointment::all();
        return view('appointment.list', compact('appointments'));
    }

    public function create()
    {
        return view('appointment.add');
    }

    public function store(Request $request) {

        

        $validatedDate = $request->validate([
            'lastName' => 'required|max:255',
            'firstName' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'date' => 'required|date',
            'status' => 'nullable|in:pending,confirmed,canceled'
        ]);
        //dd($validatedDate);

        //dd($validatedDate);

        Appointment::create($validatedDate);

        return redirect()->route('appointment.index')->with('success', 'Rendez-vous créé avec succès!');
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
        return redirect()->route('appointments.index')->with('success', 'Appointment state updated successfully!');

    } 
}
