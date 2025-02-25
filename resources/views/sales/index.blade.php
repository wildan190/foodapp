@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Sales Transactions</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('sales.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Sale
        </a>
    </div>

    <!-- Tampilan Desktop (Tabel) -->
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Customer</th>
                    <th>Order Fee</th>
                    <th>Total Price</th>
                    <th>Details</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sale->customer->name }}</td>
                    <td>Rp. {{ number_format($sale->order_fee, 2) }}</td>
                    <td>Rp. {{ number_format($sale->total_price, 2) }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $sale->id }}">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this sale?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal untuk Detail Sale -->
                <div class="modal fade" id="detailsModal{{ $sale->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $sale->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel{{ $sale->id }}">Sale Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Customer:</strong> {{ $sale->customer->name }}</p>
                                <p><strong>Order Fee:</strong> Rp. {{ number_format($sale->order_fee, 2) }}</p>
                                <p><strong>Total Price:</strong> Rp. {{ number_format($sale->total_price, 2) }}</p>

                                <h5>Menu Items:</h5>
                                <ul class="list-group">
                                    @foreach($sale->salesDetails as $detail)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $detail->menu->menu_name }} (x{{ $detail->quantity }})
                                        <span>Rp. {{ number_format($detail->price * $detail->quantity, 2) }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tampilan Mobile (List/Card) -->
    <div class="d-md-none">
        @foreach($sales as $sale)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Sale #{{ $loop->iteration }}</h5>
                <p class="card-text">
                    <strong>Customer:</strong> {{ $sale->customer->name }} <br>
                    <strong>Order Fee:</strong> Rp. {{ number_format($sale->order_fee, 2) }} <br>
                    <strong>Total Price:</strong> Rp. {{ number_format($sale->total_price, 2) }}
                </p>

                <h6>Menu Items:</h6>
                <ul class="list-group mb-2">
                    @foreach($sale->salesDetails as $detail)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $detail->menu->menu_name }} (x{{ $detail->quantity }})
                        <span>Rp. {{ number_format($detail->price * $detail->quantity, 2) }}</span>
                    </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="d-inline">
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
