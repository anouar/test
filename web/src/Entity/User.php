<?php

namespace App\Entity;

class User
{
    protected $id_user;
    protected $username;
    protected $password;
    protected $last_login;


    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    public function getUsername()
    {
        return $this->username;
    }


    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }


    public function getLastLogin()
    {
        return $this->last_login;
    }


    public function setLastLogin($last_login): void
    {
        $this->last_login = $last_login;
    }
}
