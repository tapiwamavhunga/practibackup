<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Vehicle $vehicle)
    {
        // Update $user authorization to view $vehicle here.
        return true;
    }

    public function create(User $user, Vehicle $vehicle)
    {
        // Update $user authorization to create $vehicle here.
        return true;
    }

    public function update(User $user, Vehicle $vehicle)
    {
        // Update $user authorization to update $vehicle here.
        return true;
    }

    public function delete(User $user, Vehicle $vehicle)
    {
        // Update $user authorization to delete $vehicle here.
        return true;
    }
}
