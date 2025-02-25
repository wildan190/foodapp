<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\Sales;
use App\Models\SalesDetail;
use App\Repositories\Interface\SalesRepositoryInterface;

class SalesRepository implements SalesRepositoryInterface
{
    public function getAll()
    {
        return Sales::with('customer', 'salesDetails.menu')->get();
    }

    public function getById($id)
    {
        return Sales::with('customer', 'salesDetails.menu')->findOrFail($id);
    }

    public function create(array $data)
    {
        $sales = Sales::create([
            'customer_id' => $data['customer_id'],
            'order_fee' => $data['order_fee'],
            'total_price' => $data['total_price']
        ]);

        foreach ($data['menu_id'] as $index => $menuId) {
            SalesDetail::create([
                'sales_id' => $sales->id,
                'menu_id' => $menuId,
                'quantity' => $data['quantities'][$index],
                'price' => Menu::find($menuId)->price
            ]);
        }

        return $sales;
    }


    public function update($id, array $data)
    {
        $sales = Sales::findOrFail($id);
        $sales->update([
            'customer_id' => $data['customer_id'],
            'order_fee' => $data['order_fee'],
            'total_price' => $data['total_price']
        ]);

        $sales->salesDetails()->delete();

        foreach ($data['menu_id'] as $index => $menuId) {
            SalesDetail::create([
                'sales_id' => $sales->id,
                'menu_id' => $menuId,
                'quantity' => $data['quantities'][$index],
                'price' => $data['prices'][$index]
            ]);
        }

        return $sales;
    }

    public function delete($id)
    {
        $sales = Sales::findOrFail($id);
        $sales->delete();
    }
}
