@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Customer</h2>
    <div class="card p-4">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $customer->email }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $customer->phone_number }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
