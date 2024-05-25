<div id="activity">
<input wire:model="search" type="search" placeholder="Search posts by title...">
<ul>
        @foreach($searchPatient as $patient)
            <li>{{ $patient->code }}</li>
        @endforeach
    </ul>
                                    @if($todayAppointmentsPaginate->count() > 0)
                                        @foreach ($todayAppointmentsPaginate as $appointment)
                                            <div class="media border-bottom-1 pt-3 pb-3">
                                                <img width="35" src="./images/avatar/patient.png" class="mr-3 rounded-circle">
                                                <div class="media-body">
                                                    <h5>{{ $appointment->patient->code }}</h5>
                                                    <p class="mb-0">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>
                                                    <p class="mb-0"> <i class="fa fa-calendar"></i> {{ $appointment->date->locale('fr')->formatLocalized('%A %e %B %Y') }}</p>
                                                    <p class="mb-0"><i class="fa fa-commenting-o"></i>
                                                        @if (!empty($appointment->motifs))
                                                            @foreach ($appointment->motifs as $key => $motif)
                                                                @if ($loop->last)
                                                                    {{ $motif->motif }}
                                                                @endif
                                                             @endforeach
                                                        @endif
                                                    </p>
                                                    <span class="badge
                                                        @if($appointment->status === 'confirmed')
                                                            badge-success px-2
                                                        @elseif($appointment->status === 'pending')
                                                            badge-primary px-2
                                                        @else
                                                            badge-danger px-2
                                                        @endif">
                                                        {{ $appointment->status }}
                                                    </span>
                                                </div>
                                                <!-- <span class="text-muted ">{{ $appointment->date->locale('fr')->formatLocalized('%A %e %B %Y') }}</span> -->
                                                <p>
                                                    <a href="{{ route('patient.detail', $appointment->patient) }}" data-toggle="tooltip" data-placement="top" title="Detail">
                                                        <i class="fa fa-eye color-muted m-r-5"></i>
                                                    </a>
                                                </p>
                                                
                                            </div>
                                            @php
                                                if($loop->iteration >= 3) {
                                                    break;
                                                }
                                            @endphp
                                        @endforeach
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Afficher la pagination -->
                                                {{ $todayAppointmentsPaginate->links('partials.pagination') }}
                                            </div>
                                        </div>
                                        @else
                                            {{-- Display content if there are no appointments for the current month --}}
                                            <p>No appointments found for the current day.</p>
                                        @endif
                                </div>