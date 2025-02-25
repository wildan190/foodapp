@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Menu Details</h2>
    <div class="card p-4">
        <table class="table">
            <tr>
                <th>Code:</th>
                <td>{{ $menu->code }}</td>
            </tr>
            <tr>
                <th>Menu Name:</th>
                <td>{{ $menu->menu_name }}</td>
            </tr>
            <tr>
                <th>Stock:</th>
                <td>{{ $menu->stock }}</td>
            </tr>
            <tr>
                <th>Price:</th>
                <td>Rp. {{ number_format($menu->price, 2) }}</td>
            </tr>
            <tr>
                <th>Supplier:</th>
                <td>{{ $menu->supplier->name }}</td>
            </tr>
        </table>
        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>
@endsection
