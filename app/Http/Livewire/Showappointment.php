<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;



class Showappointment extends Component
{
    use WithPagination;

    public $search;
 
    protected $queryString = ['search'];


    public function render()
    {
        setlocale(LC_ALL,'fr.UTF-8');

        // Filter appointments for today
        $today = now()->format('Y-m-d');


        

        $searchPatient = Patient::where('code', 'like', '%'.$this->search.'%')->get();

        $todayAppointmentsPaginate = Appointment::where('date', '>=', $today)
        ->where('date', '<', Carbon::parse($today)->addDay())
        ->where('status', '!=', 'cloturer')->where('is_deleted', false)->paginate(3);


        return view('livewire.showappointment', [
            'todayAppointmentsPaginate' => $todayAppointmentsPaginate,
            'searchPatient' => $searchPatient
        ]);
    }
}
