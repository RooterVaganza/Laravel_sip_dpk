<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
   public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Transaction $transaction)
    {
        return $user->isAdmin();
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Transaction $transaction)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Transaction $transaction)
    {
        return $user->isAdmin();
    }

    // Kalau perlu, tambahkan restore dan forceDelete sesuai kebutuhan
}
