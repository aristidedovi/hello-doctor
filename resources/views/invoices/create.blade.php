@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
        <div class="content-body">

        <div class="container">
    <h1>Create Invoice</h1>
    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="patient_id">patient</label>
            <select name="patient_id" id="patient_id" class="form-control" required>
                <option value="">Select patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->code }} ({{ $patient->first_name }} {{ $patient->last_name }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="invoice_date">Invoice Date</label>
            <input type="date" name="invoice_date" id="invoice_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="items">Items</label>
            <table class="table" id="items-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="items[0][item_id]" class="form-control item-select" required>
                                <option value="">Select item</option>
                                @foreach($availableItems as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                                @endforeach
                            </select>   
                        <!-- <input type="text" name="items[0][description]" class="form-control" required> -->
                        </td>
                        <td><input type="number" name="items[0][quantity]" class="form-control" required></td>
                        <td><input type="number" name="items[0][price]" class="form-control" required></td>
                        <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" id="add-item">Add Item</button>
        </div>
        <button type="submit" class="btn btn-success">Create Invoice</button>
    </form>
</div>
<!-- <input type="text" name="items[${itemIndex}][description]" class="form-control" required> -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let itemIndex = 1;

        document.getElementById('add-item').addEventListener('click', function () {
            const tableBody = document.querySelector('#items-table tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>
                    <select name="items[${itemIndex}][item_id]" class="form-control item-select" required>
                        <option value="">Select item</option>
                        @foreach($availableItems as $item)
                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="items[${itemIndex}][quantity]" class="form-control" required></td>
                <td><input type="number" name="items[${itemIndex}][price]" class="form-control" required></td>
                <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
            `;

            tableBody.appendChild(newRow);
            itemIndex++;
        });

        document.getElementById('items-table').addEventListener('change', function (e) {
            if (e.target.classList.contains('item-select')) {
                const selectedOption = e.target.options[e.target.selectedIndex];
                const priceInput = e.target.closest('tr').querySelector('input[name$="[price]"]');
                priceInput.value = selectedOption.getAttribute('data-price');
            }
        });


        document.getElementById('items-table').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('tr').remove();
            }
        });
    });
</script>

        </div>
    </div>
</div>
@endsection