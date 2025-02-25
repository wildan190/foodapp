@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Sale</h2>
    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="customer_id">Select Customer</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $customer->id == $sale->customer_id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Select Menus</label>
            <div id="menu-container">
                @foreach($sale->salesDetails as $detail)
                    <div class="menu-row d-flex align-items-center mb-2">
                        <select name="menu_id[]" class="form-control menu-select" required>
                            <option value="">-- Choose Menu --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" 
                                    data-price="{{ $menu->price }}"
                                    {{ $menu->id == $detail->menu_id ? 'selected' : '' }}>
                                    {{ $menu->menu_name }} - Rp. {{ $menu->price }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="quantities[]" class="form-control ml-2 quantity-input" 
                               placeholder="Qty" min="1" value="{{ $detail->quantity }}" required>
                        <button type="button" class="btn btn-danger ml-2 remove-menu">X</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-menu" class="btn btn-primary mt-2">+ Add Menu</button>
        </div>

        <div class="form-group">
            <label for="order_fee">Order Fee</label>
            <input type="number" name="order_fee" class="form-control" step="0.01" min="0" value="{{ $sale->order_fee }}">
        </div>

        <h4>Total Price: Rp. <span id="total-price">0.00</span></h4>

        <button type="submit" class="btn btn-success">Update</button>
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
                <select name="menu_id[]" class="form-control menu-select" required>
                    <option value="">-- Choose Menu --</option>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">
                            {{ $menu->menu_name }} - ${{ $menu->price }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantities[]" class="form-control ml-2 quantity-input" 
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
