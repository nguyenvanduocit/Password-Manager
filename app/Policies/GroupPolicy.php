<?php

namespace App\Policies;

use App\Group;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Group $group)
    {
        return $group->owners->contains($user);
    }

    public function show(User $user, Group $group)
    {
        return $group->members->contains($user) || $group->owners->contains($user);
    }

    public function destroy(User $user, Group $group)
    {
        return $group->owners->contains($user);
    }
}
