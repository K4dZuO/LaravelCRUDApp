<?php

namespace App\Policies;

use App\Models\Turtle;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TurtlePolicy
{
    /**
     * Проверка, может ли пользователь редактировать карточку.
     */
    public function update(User $user, Turtle $turtle)
    {
        return $user->id === $turtle->user_id || $user->is_admin;
    }

    /**
     * Проверка, может ли пользователь удалять карточку.
     */
    public function delete(User $user, Turtle $turtle)
    {
        return $user->id === $turtle->user_id || $user->is_admin;
    }

    /**
     * Проверка, может ли пользователь восстанавливать карточку.
     */
    public function restore(User $user, Turtle $turtle)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Turtle $turtle): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Turtle $turtle): bool
    {
        return false;
    }
}
