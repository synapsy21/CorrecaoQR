<?php

namespace App\Policies;

use App\Models\Prova;
use App\Models\User;

class ProvaPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return $user->isProfessor();
    }

    public function view(User $user, Prova $prova): bool
    {
        return $user->isProfessor();
    }

    public function create(User $user): bool
    {
        return $user->isProfessor();
    }

    public function update(User $user, Prova $prova): bool
    {
        return $user->isProfessor();
    }

    public function delete(User $user, Prova $prova): bool
    {
        return false;
    }
}
