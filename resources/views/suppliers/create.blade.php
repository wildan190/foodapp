@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Supplier</h2>
    <div class="card p-4">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
