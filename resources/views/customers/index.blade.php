@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Customer List</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-user-plus"></i> Add New Customer
    </a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tampilan Desktop (Tabel) -->
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td>
                        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tampilan Mobile (List) -->
    <div class="d-md-none">
        @foreach($customers as $customer)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $customer->name }}</h5>
                <p class="card-text">
                    <i class="fas fa-envelope"></i> {{ $customer->email }} <br>
                    <i class="fas fa-phone"></i> {{ $customer->phone_number }}
                </p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
