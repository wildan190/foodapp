@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Transaction List</h2>

    <a href="{{ route('transactions.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Add New Transaction
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tampilan Desktop (Tabel) -->
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Transaction Number</th>
                    <th>Invoice Number</th>
                    <th>Transaction Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->transaction_number }}</td>
                    <td>{{ $transaction->invoice_number }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>
                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('transactions.printInvoice', $transaction->id) }}" class="btn btn-primary btn-sm" target="_blank">
                            <i class="fas fa-print"></i> Print Invoice
                        </a>
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tampilan Mobile (List/Card) -->
    <div class="d-md-none">
        @foreach($transactions as $transaction)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Transaction #{{ $transaction->transaction_number }}</h5>
                <p class="card-text">
                    <strong>Invoice:</strong> {{ $transaction->invoice_number }} <br>
                    <strong>Date:</strong> {{ $transaction->transaction_date }}
                </p>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="{{ route('transactions.printInvoice', $transaction->id) }}" class="btn btn-primary btn-sm" target="_blank">
                        <i class="fas fa-print"></i> Print
                    </a>
                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
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
