@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Create New Transaction</h2>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="sales_id">Select Sale:</label>
            <select name="sales_id" id="sales_id" class="form-control" required>
                <option value="">-- Choose Sale --</option>
                @foreach($sales as $sale)
                    <option value="{{ $sale->id }}">
                        {{ $sale->customer->name }} - {{ $sale->total_price }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="transaction_date">Transaction Date:</label>
            <input type="date" name="transaction_date" id="transaction_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Transaction</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
