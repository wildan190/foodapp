<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interface\SupplierRepositoryInterface;

class SupplierController extends Controller
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function index()
    {
        $suppliers = $this->supplierRepository->getAll();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:suppliers,email',
            'phone_number' => 'required|string|unique:suppliers,phone_number',
            'address' => 'nullable|string',
        ]);

        $this->supplierRepository->create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully.');
    }

    public function show($id)
    {
        $supplier = $this->supplierRepository->findById($id);
        if (!$supplier) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier not found.');
        }
        return view('suppliers.show', compact('supplier'));
    }

    public function edit($id)
    {
        $supplier = $this->supplierRepository->findById($id);
        if (!$supplier) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier not found.');
        }
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:suppliers,email,' . $id,
            'phone_number' => 'required|string|unique:suppliers,phone_number,' . $id,
            'address' => 'nullable|string',
        ]);

        $updated = $this->supplierRepository->update($id, $request->all());
        if (!$updated) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier not found.');
        }

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy($id)
    {
        $deleted = $this->supplierRepository->delete($id);
        if (!$deleted) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier not found.');
        }
        
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
