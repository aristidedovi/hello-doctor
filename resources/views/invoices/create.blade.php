@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
        <div class="content-body">

        <div class="container p-5" style="background-color: #fff;">
            <h1>## {{ $type_invoice}}</h1>
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-success">Enregistrer Document</button>
                    </div>
                </div>
                <div class="row"  style="height: 100px;">
                    <div class="col-6">
                        <div class="form-group col-md-6">
                            <!-- <label for="doc_type">Type de documents</label> -->
                            <select name="doc_type" id="doc_type" class="form-control" required hidden>
                                <!-- <option value="">Select type</option> -->
                                <option value="devis" {{ $type_invoice == 'devis' ? 'selected' : '' }}>Devis</option>
                                <option value="facture" {{ $type_invoice == 'facture' ? 'selected' : '' }}>Facture</option>
                                <!-- <option value="devis" selected>Devis</option> -->
                                <!-- <option value="facture">Facture</option> -->
                            </select>
                            <p class="mt-2 mb-0">NOM DU CABINET</p>
                            <p class="mb-0">Address</p>
                            <p>numéro de téléphone</p>
                        </div>
                        
                    </div>
                    <div class="col-6">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-10">
                                <label for="patient_id">Information du patient</label>
                                <input id="patient-select"  name="patient_id" required>
                            </div>
                        </div>
                        <div class="row" style="height: 100px;">
                            <div class="col-6">
                                <!-- Fields to display patient information -->
                                <div id="patient-details" style="display: none;">
                                    <p class="mt-2 mb-0"><span id="patient-last-name"></span> <span id="patient-first-name"></span></p>
                                    <p class="mb-0"><span id="patient-address"></span></p>
                                    <p><span id="patient-phone"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group row col-md-12">
                            <label class="col-4 col-form-label" for="invoice_date">Date de Facturation</label>
                            <div class="col-6">
                                <input type="date" name="invoice_date" id="invoice_date" class="form-control" required>
                            </div>
                            <label class="col-4 col-form-label" for="due_date">Date d'échéance</label>
                            <div class="col-6">
                                <input type="date" name="due_date" id="due_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <h3 class="text-center" for="items">Les soins</h3>
                            <table class="table" id="items-table">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Qnt</th>
                                        <th>P.U</th>
                                        <th>P.T</th>
                                        <th></th>
                                    </tr>
                                </thead>
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
                                        <td class="pt-0" style="width: 20%;"><input type="number" name="items[0][quantity]" class="form-control quantity" placeholder="Quantité" required></td>
                                        <td class="pt-0" style="width: 20%;"><input type="number" name="items[0][price]" class="form-control  unit-price" placeholder="Prix unitaire" required></td>
                                        <td class="pt-0" style="width: 20%;"><input type="number" name="items[0][total_price]" class="form-control total-price" placeholder="Prix total" required readonly></td>
                                        <td class="pt-0">
                                            <button type="button" class="btn btn-primary btn-sm" id="add-item">
                                            <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right">Total:</td>
                                        <td><input type="number" id="grand-total" class="form-control" readonly></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <!-- <div class="form-group col-md-6">
                                <label for="patient_id">Information du patient</label> -->
                                <!-- <select name="patient_id" id="patient_id" class="form-control" required>
                                    <option value="">Select patient</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->code }} ({{ $patient->first_name }} {{ $patient->last_name }})</option>
                                    @endforeach
                                </select> -->
                                <!-- <input id="patient-select"  name="patient_id" required> -->
                                    <!-- <option value="">Select patient</option> -->
                                <!-- Options will be loaded via AJAX -->
                                <!-- </select> -->
                            <!-- </div> -->
                        </div>
                        <div class="form-row">
                            <!-- <div class="form-group col-md-4">
                                <label for="patient_id">Information du patient</label>
                                <select name="patient_id" id="patient_id" class="form-control" required>
                                    <option value="">Select patient</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->code }} ({{ $patient->first_name }} {{ $patient->last_name }})</option>
                                    @endforeach
                                </select>
                            </div> -->
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        
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
                <td class="pt-0" style="width: 20%;"><input type="number" name="items[${itemIndex}][quantity]" class="form-control quantity" placeholder="Quantité" required></td>
                <td class="pt-0" style="width: 20%;"><input type="number" name="items[${itemIndex}][price]" class="form-control unit-price" placeholder="Prix unitaire" required></td>
                <td class="pt-0" style="width: 20%;"><input type="number" name="items[${itemIndex}][total_price]" class="form-control total-price" placeholder="Prix total" required readonly></td>

                <td class="pt-0">
                    <button type="button" class="btn btn-danger btn-sm remove-item">
                        <i class="fa fa-close"></i>
                    </button>
                </td>
            `;

            tableBody.appendChild(newRow);
            //tableBody.insertBefore(newRow, tableBody.firstChild);

            // Add event listeners for calculation
            newRow.querySelector('.quantity').addEventListener('change', calculateTotal);
            newRow.querySelector('.unit-price').addEventListener('change', calculateTotal);

            itemIndex++;
        });

        document.getElementById('items-table').addEventListener('change', function (e) {
            if (e.target.classList.contains('item-select')) {
                const selectedOption = e.target.options[e.target.selectedIndex];
                const priceInput = e.target.closest('tr').querySelector('input[name$="[price]"]');
                priceInput.value = selectedOption.getAttribute('data-price');
                calculateTotal.call(priceInput);
            }
        });


        document.getElementById('items-table').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('tr').remove();
                calculateGrandTotal();
            }
        });

        function calculateTotal() {
            const row = this.closest('tr');
                const quantity = row.querySelector('.quantity').value;
                const unitPrice = row.querySelector('.unit-price').value;
                const totalPriceInput = row.querySelector('.total-price');

                if (quantity && unitPrice) {
                    const totalPrice = quantity * unitPrice;
                    totalPriceInput.value = totalPrice.toFixed(2); // Adjust decimals as needed
                } else {
                    totalPriceInput.value = ''; // Reset if either quantity or price is empty
                }

                calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let grandTotal = 0;
            document.querySelectorAll('.total-price').forEach(function (totalPriceInput) {
                const totalPrice = parseFloat(totalPriceInput.value);
                if (!isNaN(totalPrice)) {
                    grandTotal += totalPrice;
                }
            });
            document.getElementById('grand-total').value = grandTotal.toFixed(2);
        }

        // Add event listeners for the initial row
        const initialQuantity = document.querySelector('input[name="items[0][quantity]"]');
        const initialUnitPrice = document.querySelector('input[name="items[0][price]"]');
        initialQuantity.addEventListener('change', calculateTotal);
        initialUnitPrice.addEventListener('change', calculateTotal);

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

    document.addEventListener('DOMContentLoaded', function() {
        const patientSelect = new TomSelect("#patient-select", {
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            load: function(query, callback) {
                var url = '{{ route("patients.search") }}?q=' + encodeURIComponent(query);
                fetch(url)
                    .then(response => response.json())
                    .then(json => {
                        callback(json);
                    }).catch(() => {
                        callback();
                    });
            },
            placeholder: 'Recheher un patient',
            maxItems: 1,
            maxOptions: 10,
            createOnBlur: true,
	        create: false
        });

        patientSelect.on('change', function(value) {
            if (value) {
                fetchPatientDetails(value);
            } else {
                document.getElementById('patient-details').style.display = 'none';
            }
        });

        function fetchPatientDetails(patientId) {
            fetch('{{ url("/patient/invoice") }}/' + patientId)
                .then(response => response.json())
                .then(patient => {
                    document.getElementById('patient-last-name').innerText = patient.last_name;
                    document.getElementById('patient-first-name').innerText = patient.first_name;
                    document.getElementById('patient-address').innerText = patient.address;
                    document.getElementById('patient-phone').innerText = patient.phone;
                    document.getElementById('patient-details').style.display = 'block';
                });
        }
    });
</script>

        </div>
    </div>
</div>
@endsection