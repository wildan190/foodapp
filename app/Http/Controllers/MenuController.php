<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interface\MenuRepositoryInterface;
use App\Repositories\Interface\SupplierRepositoryInterface;

class MenuController extends Controller
{
    protected $menuRepository;
    protected $supplierRepository;

    public function __construct(MenuRepositoryInterface $menuRepository, SupplierRepositoryInterface $supplierRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->supplierRepository = $supplierRepository;
    }

    public function index()
    {
        $menus = $this->menuRepository->getAll();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $suppliers = $this->supplierRepository->getAll();
        return view('menus.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:menus,code|max:50',
            'menu_name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $this->menuRepository->create($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu added successfully.');
    }

    public function show($id)
    {
        $menu = $this->menuRepository->findById($id);
        if (!$menu) {
            return redirect()->route('menus.index')->with('error', 'Menu not found.');
        }
        return view('menus.show', compact('menu'));
    }

    public function edit($id)
    {
        $menu = $this->menuRepository->findById($id);
        if (!$menu) {
            return redirect()->route('menus.index')->with('error', 'Menu not found.');
        }
        $suppliers = $this->supplierRepository->getAll();
        return view('menus.edit', compact('menu', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:menus,code,' . $id,
            'menu_name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $updated = $this->menuRepository->update($id, $request->all());
        if (!$updated) {
            return redirect()->route('menus.index')->with('error', 'Menu not found.');
        }

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy($id)
    {
        $deleted = $this->menuRepository->delete($id);
        if (!$deleted) {
            return redirect()->route('menus.index')->with('error', 'Menu not found.');
        }
        
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
