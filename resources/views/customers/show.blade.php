@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Customer Details</h2>
    <div class="card p-4">
        <table class="table">
            <tr>
                <th>Name:</th>
                <td>{{ $customer->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $customer->email }}</td>
            </tr>
            <tr>
                <th>Phone:</th>
                <td>{{ $customer->phone_number }}</td>
            </tr>
            <tr>
                <th>Address:</th>
                <td>{{ $customer->address }}</td>
            </tr>
        </table>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>
@endsection
