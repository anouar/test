<?php

namespace App\Contracts;

abstract class AbstractController
{
    public function redirectToPath($path)
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $path);
    }

    public function is_granted(): bool
    {
        var_dump(session_status());
        var_dump($_SESSION['id']);
        die;
        if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['logged'] === 'OK') {
            return true;
        }
        return false;
    }
}
