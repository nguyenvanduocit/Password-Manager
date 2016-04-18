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
        return $this->isOwner($user, $group);
    }
    public function show(User $user, Group $group)
    {
        return $this->isOwner($user, $group);
    }
    public function destroy(User $user, Group $group)
    {
        return $this->isOwner($user, $group);
    }
    protected function isOwner(User $user, Group $group)
    {
        return $user->id === $group->user_id;
    }
}
