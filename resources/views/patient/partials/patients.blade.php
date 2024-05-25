<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Full Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patientPaginate ?? $filteredPatients as $patient)
                <tr>
                    <td>{{ $patient->code }}</td>
                    <td>{{ $patient->first_name }} {{ $patient->last_name }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {!! ($patientPaginate ?? $filteredPatients)->links('partials.pagination') !!}
</div>
