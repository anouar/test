<?php

namespace App\Contracts;

use App\Entity\User;

abstract class AbstractAuth
{
    abstract public function checkUserPermission($user, $password);
    abstract public function updateLastLogin(User $user);
}
