@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Sale Details</h2>
    
    <table class="table">
        <tr>
            <th>Customer:</th>
            <td>{{ $sale->customer->name }}</td>
        </tr>
        <tr>
            <th>Menu:</th>
            <td>{{ $sale->menu->menu_name }}</td>
        </tr>
        <tr>
            <th>Quantity:</th>
            <td>{{ $sale->quantity }}</td>
        </tr>
        <tr>
            <th>Total Price:</th>
            <td>${{ number_format($sale->total_price, 2) }}</td>
        </tr>
        <tr>
            <th>Order Fee:</th>
            <td>${{ number_format($sale->order_fee, 2) }}</td>
        </tr>
    </table>

    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
