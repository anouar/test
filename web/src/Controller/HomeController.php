<?php

namespace App\Controller;

use App\Attributes\Route;
use App\Contracts\AbstractController;
use App\Service\SessionManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController extends AbstractController
{
    public function __construct(public SessionManager $sessionManager)
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../../templates');
        $this->twig = new Environment($this->loader, [
            'debug' => true
        ]);
    }

    #[Route('/')]
    public function home()
    {
        return $this->twig->render('home.html.twig');
    }

    #[Route('/main')]
    public function main()
    {
        if ($this->sessionManager->has('username')) {
            return $this->twig->render('main.html.twig');
        } else {
            $this->redirectToPath("/login");
        }
    }
}
