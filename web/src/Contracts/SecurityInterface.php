<?php

namespace App\Contracts;

interface SecurityInterface
{
    public function login();
    public function logout();
    public function auth();
    public function register();
}
