<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Repositories\Interface\SupplierRepositoryInterface;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function getAll()
    {
        return Supplier::all();
    }

    public function findById($id)
    {
        return Supplier::find($id);
    }

    public function create(array $data)
    {
        return Supplier::create($data);
    }

    public function update($id, array $data)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->update($data);
            return $supplier;
        }
        return null;
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            return $supplier->delete();
        }
        return false;
    }
}
