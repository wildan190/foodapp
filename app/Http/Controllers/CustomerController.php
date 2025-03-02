<?php

namespace App\Http\Controllers;

use App\Repositories\Interface\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    // Get all customers
    public function index()
    {
        $customers = $this->customerRepository->getAll();

        return view('customers.index', compact('customers'));
    }

    // Get customer by ID
    public function show($id)
    {
        $customer = $this->customerRepository->findById($id);
        if (! $customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        return view('customers.show', compact('customer'));
    }

    // Show form to create new customer
    public function create()
    {
        return view('customers.create');
    }

    // Store new customer
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'phone_number' => 'required|string|unique:customers,phone_number',
            'address' => 'nullable|string',
        ]);

        $this->customerRepository->create($validatedData);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

    // Show form to edit customer
    public function edit($id)
    {
        $customer = $this->customerRepository->findById($id);
        if (! $customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        return view('customers.edit', compact('customer'));
    }

    // Update customer
    public function update(Request $request, $id)
    {
        $customer = $this->customerRepository->findById($id);
        if (! $customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,'.$id,
            'phone_number' => 'sometimes|required|string|unique:customers,phone_number,'.$id,
            'address' => 'nullable|string',
        ]);

        $this->customerRepository->update($id, $validatedData);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    // Delete customer
    public function destroy($id)
    {
        $customer = $this->customerRepository->findById($id);
        if (! $customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        $this->customerRepository->delete($id);

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
