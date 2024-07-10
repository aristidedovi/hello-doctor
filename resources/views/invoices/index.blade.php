@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
        <div class="content-body">

<div class="container">
    <h1>Invoices</h1>
    <a href="{{ route('invoices.create') }}" class="btn btn-primary">Create Invoice</a>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Type</th>
                <th>Numéro</th>
                <th>Customer</th>
                <th>Invoice Date</th>
                <th>Due Date</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->doc_type }}</td>
                    <td>{{ $invoice->unique_code }}</td>
                    <td>{{ $invoice->patient->last_name }} {{ $invoice->patient->first_name }}</td>
                    <td>{{ $invoice->invoice_date }}</td>
                    <td>{{ $invoice->due_date }}</td>
                    <td>{{ $invoice->total }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

        </div>
    </div>
</div>
@endsection