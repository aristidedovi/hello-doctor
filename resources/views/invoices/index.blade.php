@extends('layouts/main')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
@endpush

@section('title', 'Rendez-vous')


@section('content')


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
        <div class="content-body">

<div class="container">
    <h1>Gestion {{ $type_invoice }}</h1>
    @if( $type_invoice == 'devis')
    <a href="{{ route('invoices.create', ['type' => 'devis']) }}" class="btn btn-primary">Create Devis</a>
    @else
    <a href="{{ route('invoices.create', ['type' => 'facture']) }}" class="btn btn-primary">Create Facture</a>
    @endif

    <table id="myTable" class="">
        <thead>
            <tr>
                <th>Type / Status</th>
                <th>Numéro</th>
                <th>Customer</th>
                <th>Code customer</th>
                <th>Invoice Date</th>
                <!-- <th>Due Date</th> -->
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>
                        {{ $invoice->doc_type }}
                        @if( $type_invoice == 'facture')
                            @if($invoice->is_paid) 
                                <span class="badge bg-danger" style="color: #fff;">Payé</span>
                            @endif
                        @elseif ( $type_invoice == 'devis')
                            @if ($invoice->has_facture)
                            <a href="{{ route('invoices.detail', ['type' => 'facture', 'unique_code' => $invoice->devis_id ]) }}">
                                <span class="badge bg-warning" style="color: #fff;">Facturé</span>
                            </a>
                            @endif
                        @endif
                    </td>
                    <td>{{ $invoice->unique_code }} </td>
                    <td>{{ $invoice->patient->last_name }} {{ $invoice->patient->first_name }}</td>
                    <td>{{ $invoice->patient->code }}</td>
                    <td>{{ $invoice->invoice_date }}</td>
                    <!-- <td>{{ $invoice->due_date }}</td> -->
                    <td>{{ $invoice->total }}</td>
                    <td>
                        <a href="{{ route('invoices.show', ['type' => $invoice->doc_type, 'id' => $invoice->id]) }}" class="btn btn-sm"><i class="fa fa-info-circle"></i></a>
                        <!-- <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm"><i class="fa fa-pencil"></i></a> -->
                        @if( $type_invoice == 'facture' )
                            @if(!$invoice->is_paid) 
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            @endif
                        @endif

                        @if($type_invoice == 'devis'  )
                            @if(!$invoice->has_facture) 
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endpush

@endsection