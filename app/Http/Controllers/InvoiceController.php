<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Carbon\Carbon;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('patient')->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        return view('invoices.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            //'patient_id' => 'required|exists:patients,id',
            'patient_id' => 'required',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'items.*.description' => 'required',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        //dd($request);

        $invoice = Invoice::create([
            'patient_id' => $request->patient_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'total' => array_reduce($request->items, function ($carry, $item) {
                return $carry + ($item['quantity'] * $item['price']);
            }, 0),
        ]);

        //dd($invoice);

        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$invoice->load('patient', 'items');
        $invoice = Invoice::with('patient', 'items')->findOrFail($id);
        $invoice->invoice_date = Carbon::parse($invoice->invoice_date);
        $invoice->due_date = Carbon::parse($invoice->due_date);


        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$patients = Patient::all();
        //$invoice->load('items');

        $invoice = Invoice::with('items')->findOrFail($id);
        $invoice->invoice_date = Carbon::parse($invoice->invoice_date);
        $invoice->due_date = Carbon::parse($invoice->due_date);
        $patients = Patient::all();

        return view('invoices.edit', compact('invoice', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'items.*.description' => 'required',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'patient_id' => $request->patient_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'total' => array_reduce($request->items, function ($carry, $item) {
                return $carry + ($item['quantity'] * $item['price']);
            }, 0),
        ]);

        $invoice->items()->delete();

        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
