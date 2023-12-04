<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class PatientController extends Controller
{
    public function index()
    {
    //     //return view('games.index', ['games' => $games]);
        $patients = Patient::all();
        return view('patient.list', compact('patients'));
    }

    public function create()
    {
        return view('patient.add');
    }

    public function store(Request $request) {

        //dd($request);

        $validatedDate = $request->validate([
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'age' => 'required|numeric|min:0',
            'sex' => 'required|in:male,female',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
        ]);
        //dd($validatedDate);

        //dd($validatedDate);

        Patient::create($validatedDate);

        return redirect()->route('patient.index')->with('success', 'Rendez-vous créé avec succès!');
    }

    public function detail(Patient $patient)
    {
        Carbon::setLocale('fr');
        $appointments = $patient->appointments;
        //dd($appointments);
        return view('patient.detail', compact('patient', 'appointments'));
    }


}
