<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Menu;
use App\Repositories\Interface\SalesRepositoryInterface;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    protected $salesRepository;

    public function __construct(SalesRepositoryInterface $salesRepository)
    {
        $this->salesRepository = $salesRepository;
    }

    public function index()
    {
        $sales = $this->salesRepository->getAll();

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $menus = Menu::all();

        return view('sales.create', compact('customers', 'menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'menu_id' => 'required|array',
            'menu_id.*' => 'exists:menus,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'order_fee' => 'nullable|numeric|min:0',
        ]);

        $data['total_price'] = array_sum(array_map(function ($quantity, $menuId) {
            $menu = Menu::find($menuId);

            return $menu ? $menu->price * $quantity : 0;
        }, $data['quantities'], $data['menu_id'])) + ($data['order_fee'] ?? 0);

        $this->salesRepository->create($data);

        return redirect()->route('sales.index')->with('success', 'Sales record added successfully');
    }

    public function edit($id)
    {
        $sale = $this->salesRepository->getById($id);
        $customers = Customer::all();
        $menus = Menu::all();

        return view('sales.edit', compact('sale', 'customers', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->salesRepository->update($id, $data);

        return redirect()->route('sales.index')->with('success', 'Sales updated successfully');
    }

    public function destroy($id)
    {
        $this->salesRepository->delete($id);

        return redirect()->route('sales.index')->with('success', 'Sales deleted successfully');
    }
}
