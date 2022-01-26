<?php

namespace DOCore\DOQuot\Http\Controllers\Admin;

use DOCore\Organization\Models\Client;
use DOCore\DOQuot\Models\{Quotation, Product};
use DOCore\DOQuot\Http\Requests\{NewQuotationRequest, UpdateQuotationRequest, UpdateStatusRequest};
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class QuotationController extends Controller
{
    protected $total;
    protected $tax = 0.15;

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = $request->get('perPage') ? $request->get('perPage') : 25;

        if (!empty($keyword)) {
            $quotations = Quotation::with(['client', 'products'])
                ->whereHas('client', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })->latest()->paginate($perPage);
        } else {
            $quotations = Quotation::With(['client', 'products'])->latest()->paginate($perPage);
        }
        return view('doquot::admin.quotations.index', compact('quotations'));
    }

    public function create()
    {
        $clients = Client::all();

        $products = Product::all();

        return view('doquot::admin.quotations.create', compact('clients', 'products'));
    }

    public function store(NewQuotationRequest $request)
    {
        $quotation = Quotation::create($request->except(['products', 'total_input']));

        // add products if any
        foreach ($request->products as $product) {
            $quotation->products()->attach(
                $product['product_id'],
                [
                    'quantity' => $product['quantity'],
                    'unit_price' => $product['unit_price'],
                ]
            );
        }

        return redirect()->route('admin.doquot.quotations.index')
            ->with('flash_message', 'Quotation added successfully.');
    }

    public function show(Quotation $quotation)
    {
        return view('doquot::admin.quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        $clients = Client::all();

        $products = Product::all();

        $status = ['New', 'Approved', 'Rejected'];

        return view('doquot::admin.quotations.edit', compact('quotation', 'clients', 'products', 'status'));
    }

    public function update(UpdateQuotationRequest $request, Quotation $quotation)
    {
        $quotation->update($request->except(['products']));

        // remove existing products first
        $quotation->products()->detach();

        // add product
        foreach ($request->products as $product) {
            $quotation->products()->attach(
                $product['product_id'],
                [
                    'quantity' => $product['quantity'],
                    'unit_price' => $product['unit_price'],
                ]
            );
        }

        return redirect()->route('admin.doquot.quotations.index')
            ->with('flash_message', 'Quotation updated successfully.');
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return redirect()->route('admin.doquot.quotations.index')
            ->with('flash_message', 'Quotation deleted successfully.');
    }


    public function printPDF(Quotation $quotation)
    {
        $pdf = PDF::loadView('doquot::admin.quotations.pdf.quotation', compact('quotation'));
        return $pdf->stream();
    }

    public function updateQuotationStatus(UpdateStatusRequest $request, Quotation $quotation)
    {
        if ($request->action === 'approve') {
            $quotation->update(['status' => 'approved']);
            return back();
        }

        if ($request->action === 'reject') {
            $quotation->update([
                'status' => 'rejected',
                'rejection_reason' => $request->rejection_reason,
            ]);
            return back();
        }
    }
}
