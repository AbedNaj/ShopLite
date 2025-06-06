<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $adminRole = Role::where('name', 'admin')->value('id');
        return $user->role_id === $adminRole;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SubCategory $subCategory): bool
    {
        $adminRole = Role::where('name', 'admin')->value('id');
        return $user->role_id === $adminRole;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $adminRole = Role::where('name', 'admin')->value('id');
        return $user->role_id === $adminRole;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubCategory $subCategory): bool
    {
        $adminRole = Role::where('name', 'admin')->value('id');
        return $user->role_id === $adminRole;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubCategory $subCategory): bool
    {
        $adminRole = Role::where('name', 'admin')->value('id');
        return $user->role_id === $adminRole;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SubCategory $subCategory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SubCategory $subCategory): bool
    {
        return false;
    }
}
