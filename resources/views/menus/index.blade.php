@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Menu List</h2>
    <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add New Menu
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
                    <th>Code</th>
                    <th>Menu Name</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Supplier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->code }}</td>
                    <td>{{ $menu->menu_name }}</td>
                    <td>{{ $menu->stock }}</td>
                    <td>Rp. {{ number_format($menu->price, 2) }}</td>
                    <td>{{ $menu->supplier->name }}</td>
                    <td>
                        <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
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
        @foreach($menus as $menu)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $menu->menu_name }}</h5>
                <p class="card-text">
                    <strong>Code:</strong> {{ $menu->code }} <br>
                    <strong>Stock:</strong> {{ $menu->stock }} <br>
                    <strong>Price:</strong> Rp. {{ number_format($menu->price, 2) }} <br>
                    <strong>Supplier:</strong> {{ $menu->supplier->name }}
                </p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
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
