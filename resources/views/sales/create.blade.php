@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Create New Sale</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="customer_id">Select Customer</label>
            <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                <option value="">-- Select Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Select Menus</label>
            <div id="menu-container">
                <div class="menu-row d-flex align-items-center mb-2">
                    <select name="menu_id[]" class="form-control menu-select @error('menu_id.*') is-invalid @enderror" required>
                        <option value="">-- Choose Menu --</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">
                                {{ $menu->menu_name }} - Rp. {{ $menu->price }}
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="quantities[]" class="form-control ml-2 quantity-input @error('quantities.*') is-invalid @enderror" 
                           placeholder="Qty" min="1" required>
                    <button type="button" class="btn btn-danger ml-2 remove-menu">X</button>
                </div>
                @error('menu_id.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('quantities.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="button" id="add-menu" class="btn btn-primary mt-2">+ Add Menu</button>
        </div>

        <div class="form-group">
            <label for="order_fee">Order Fee</label>
            <input type="number" name="order_fee" class="form-control @error('order_fee') is-invalid @enderror" step="0.01" min="0" value="{{ old('order_fee', 0) }}">
            @error('order_fee')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <h4>Total Price: Rp. <span id="total-price">0.00</span></h4>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function updateTotalPrice() {
            let total = 0;
            document.querySelectorAll('.menu-row').forEach(row => {
                let price = row.querySelector('.menu-select').selectedOptions[0].dataset.price || 0;
                let quantity = row.querySelector('.quantity-input').value || 1;
                total += parseFloat(price) * parseInt(quantity);
            });
            document.getElementById('total-price').innerText = total.toFixed(2);
        }

        document.getElementById('add-menu').addEventListener('click', function () {
            let menuContainer = document.getElementById('menu-container');
            let newRow = document.createElement('div');
            newRow.classList.add('menu-row', 'd-flex', 'align-items-center', 'mb-2');

            newRow.innerHTML = `
                <select name="menu_id[]" class="form-control menu-select @error('menu_id.*') is-invalid @enderror" required>
                    <option value="">-- Choose Menu --</option>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">
                            {{ $menu->menu_name }} - ${{ $menu->price }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantities[]" class="form-control ml-2 quantity-input @error('quantities.*') is-invalid @enderror" 
                       placeholder="Qty" min="1" required>
                <button type="button" class="btn btn-danger ml-2 remove-menu">X</button>
            `;
            menuContainer.appendChild(newRow);
            updateTotalPrice();
        });

        document.getElementById('menu-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-menu')) {
                e.target.parentElement.remove();
                updateTotalPrice();
            }
        });

        document.getElementById('menu-container').addEventListener('change', function (e) {
            if (e.target.classList.contains('menu-select') || e.target.classList.contains('quantity-input')) {
                updateTotalPrice();
            }
        });

        updateTotalPrice();
    });
</script>
@endsection
