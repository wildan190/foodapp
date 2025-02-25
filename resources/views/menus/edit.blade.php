@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Menu</h2>
    <div class="card p-4">
        <form action="{{ route('menus.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Code</label>
                <input type="text" name="code" class="form-control" value="{{ $menu->code }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Menu Name</label>
                <input type="text" name="menu_name" class="form-control" value="{{ $menu->menu_name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $menu->stock }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" name="price" class="form-control" value="{{ $menu->price }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Supplier</label>
                <select name="supplier_id" class="form-control" required>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $menu->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
