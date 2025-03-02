<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\Interface\MenuRepositoryInterface;

class MenuRepository implements MenuRepositoryInterface
{
    public function getAll()
    {
        return Menu::with('supplier')->get();
    }

    public function findById($id)
    {
        return Menu::with('supplier')->find($id);
    }

    public function create(array $data)
    {
        return Menu::create($data);
    }

    public function update($id, array $data)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $menu->update($data);

            return $menu;
        }

        return null;
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            return $menu->delete();
        }

        return false;
    }
}
