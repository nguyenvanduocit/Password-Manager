<?php

namespace App\Policies;

use App\Password;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PasswordPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Password $password)
    {
        return $this->isOwner($user, $password);
    }

    public function show(User $user, Password $password)
    {
        return $password->groups->intersect($user->groups)->count()>0;
    }

    public function destroy(User $user, Password $password){
        return $this->isOwner($user, $password);
    }
    
    protected function isOwner(User $user, Password $password){
        return $user->id === $password->user_id;
    }

}
