<?php

namespace App\Service;

use App\Contracts\AbstractAuth;
use App\Dao;
use App\Entity\User;

class Auth extends AbstractAuth
{
    protected Dao $db;

    public function __construct()
    {
        $this->db = new Dao();
    }

    public function checkUserPermission($user, $password): bool|User
    {
        $sth = $this->db->fetchAll(
            'SELECT *
             FROM user
             WHERE username = :username AND password = :password',
            ['username' => $user, 'password' => $password]
        );
        if (count($sth) === 1) {
            return $this->cast($sth, User::class); // return User
        }
        return false;
    }

    public function updateLastLogin($user): void
    {
        try{
            $this->db->update('UPDATE user SET last_login = :last_login WHERE id_user = :id', ['last_login' => $user->getLastLogin()->format('Y-m-d H:i:s'), 'id' => $user->getIdUser()]);
        } catch (\Exception $exception){
            throw $exception;
        }
    }

    protected function cast($instance, $className)
    {
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            \strlen($className),
            $className,
            strstr(strstr(serialize($instance), '"'), ':')
        ));
    }
}
