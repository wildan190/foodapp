@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Supplier Details</h2>
    <div class="card p-4">
        <table class="table">
            <tr>
                <th>Name:</th>
                <td>{{ $supplier->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $supplier->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>Phone:</th>
                <td>{{ $supplier->phone_number }}</td>
            </tr>
            <tr>
                <th>Address:</th>
                <td>{{ $supplier->address ?? '-' }}</td>
            </tr>
        </table>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>
@endsection
