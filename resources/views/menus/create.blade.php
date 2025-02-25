@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Menu</h2>
    <div class="card p-4">
        <form action="{{ route('menus.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Code</label>
                <input type="text" name="code" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Menu Name</label>
                <input type="text" name="menu_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Supplier</label>
                <select name="supplier_id" class="form-control" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
