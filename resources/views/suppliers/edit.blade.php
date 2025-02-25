@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Supplier</h2>
    <div class="card p-4">
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $supplier->email }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $supplier->phone_number }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control">{{ $supplier->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
