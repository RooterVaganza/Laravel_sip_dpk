<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Category $category)
    {
        return $user->isAdmin();
    }
    
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Category $category)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Category $category)
    {
        return $user->isAdmin();
    }

    // Kalau perlu, tambahkan restore dan forceDelete sesuai kebutuhan
}
