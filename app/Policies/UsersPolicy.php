<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Users $users)
    {
        // Update $user authorization to view $users here.
        return true;
    }

    public function create(User $user, Users $users)
    {
        // Update $user authorization to create $users here.
        return true;
    }

    public function update(User $user, Users $users)
    {
        // Update $user authorization to update $users here.
        return true;
    }

    public function delete(User $user, Users $users)
    {
        // Update $user authorization to delete $users here.
        return true;
    }
}
