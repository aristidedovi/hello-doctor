@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
        <div class="content-body">

        <div class="container">
            <h1>Formulaire de création de Facture</h1>
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-success">Enregistrer Facture</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="patient_id">Information du patient</label>
                                <select name="patient_id" id="patient_id" class="form-control" required>
                                    <option value="">Select patient</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->code }} ({{ $patient->first_name }} {{ $patient->last_name }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="invoice_date">Date de Facturation</label>
                                <input type="date" name="invoice_date" id="invoice_date" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="due_date">Date d'échéance</label>
                                <input type="date" name="due_date" id="due_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="items">Les élément du devis</label>
                            <table class="table" id="items-table">
                                <!-- <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead> -->
                                <tbody>
                                    <tr>
                                        <!-- <td>
                                            <button type="button" class="btn btn-danger remove-item btn-sm">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </td> -->
                                        <td class="pt-0 pl-0" style="width: 40%;" >
                                            <select name="items[0][item_id]" class="form-control item-select" required>
                                                <option value="">Select élément</option>
                                                @foreach($availableItems as $item)
                                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>   
                                        <!-- <input type="text" name="items[0][description]" class="form-control" required> -->
                                        </td>
                                        <td class="pt-0" style="width: 30%;"><input type="number" name="items[0][quantity]" class="form-control" placeholder="Quantité" required></td>
                                        <td class="pt-0" style="width: 30%;"><input type="number" name="items[0][price]" class="form-control" placeholder="Prix unitaire" required></td>
                                        <td class="pt-0">
                                            <button type="button" class="btn btn-primary btn-sm" id="add-item">
                                            <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <button type="submit" class="btn btn-success">Create Invoice</button> -->
            </form>
        </div>
<!-- <input type="text" name="items[${itemIndex}][description]" class="form-control" required> 
                 <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let itemIndex = 1;

        document.getElementById('add-item').addEventListener('click', function () {
            const tableBody = document.querySelector('#items-table tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td class="pt-0 pl-0" style="width: 40%;">
                    <select name="items[${itemIndex}][item_id]" class="form-control item-select" required>
                        <option value="">Select élément</option>
                        @foreach($availableItems as $item)
                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="pt-0" style="width: 30%;"><input type="number" name="items[${itemIndex}][quantity]" class="form-control" placeholder="Quantité" required></td>
                <td class="pt-0" style="width: 30%;"><input type="number" name="items[${itemIndex}][price]" class="form-control" placeholder="Prix unitaire" required></td>
                <td class="pt-0">
                    <button type="button" class="btn btn-danger btn-sm remove-item">
                        <i class="fa fa-close"></i>
                    </button>
                </td>
            `;

            tableBody.appendChild(newRow);
            //tableBody.insertBefore(newRow, tableBody.firstChild);

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

    // Obtenir la date d'aujourd'hui
    var today = new Date();

    // Formater la date en YYYY-MM-DD
    var year = today.getFullYear();
    var month = (today.getMonth() + 1).toString().padStart(2, '0');
    var day = today.getDate().toString().padStart(2, '0');
    var formattedDate = year + '-' + month + '-' + day;

    // Définir la valeur du champ de date
    document.getElementById('invoice_date').value = formattedDate;
</script>

        </div>
    </div>
</div>
@endsection