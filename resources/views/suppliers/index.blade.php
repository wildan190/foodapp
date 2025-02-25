@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Supplier List</h2>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add New Supplier
    </a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Tampilan Desktop (Tabel) -->
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email ?? '-' }}</td>
                    <td>{{ $supplier->phone_number }}</td>
                    <td>{{ $supplier->address ?? '-' }}</td>
                    <td>
                        <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
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

    <!-- Tampilan Mobile (List/Card) -->
    <div class="d-md-none">
        @foreach($suppliers as $supplier)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $supplier->name }}</h5>
                <p class="card-text">
                    <strong>Email:</strong> {{ $supplier->email ?? '-' }} <br>
                    <strong>Phone:</strong> {{ $supplier->phone_number }} <br>
                    <strong>Address:</strong> {{ $supplier->address ?? '-' }}
                </p>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
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
