<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Product $product)
    {
        return $user->isAdmin();
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Product $product)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Product $product)
    {
        return $user->isAdmin();
    }

    // Kalau perlu, tambahkan restore dan forceDelete sesuai kebutuhan
}

