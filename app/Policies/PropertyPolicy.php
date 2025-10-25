<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
class PropertyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Property $property): bool
    {
        if (!$user->role) return false;
        $role = $user->role->name;
        if ($role === 'manager') return true;
        if ($role === 'agent') return true;
        if ($role === 'bailleur') return $property->owner_id === $user->id;
        if ($role === 'client') return $property->is_published;
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array(optional($user->role)->name, ['manager','agent','bailleur']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Property $property): bool
    {
        $role = optional($user->role)->name;
        if ($role === 'manager') return true;
        if ($role === 'agent') return true; // agent can edit any property per spec
        if ($role === 'bailleur') return $property->user_id === $user->id;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Property $property): bool
    {
         return $this->update($user, $property);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Property $property): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Property $property): bool
    {
        return false;
    }
}