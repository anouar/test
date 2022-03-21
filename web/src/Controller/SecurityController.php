<?php

namespace App\Controller;

use App\Attributes\Route;
use App\Contracts\AbstractController;
use App\Contracts\SecurityInterface;
use App\Service\Auth;
use App\Service\SessionManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class SecurityController extends AbstractController implements SecurityInterface
{
    public function __construct(public Auth $auth, public SessionManager $sessionManager)
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../../templates');
        $this->twig = new Environment($this->loader, [
            'debug' => true
        ]);
    }


    #[Route('/login')]
    public function login()
    {
        if ($this->sessionManager->has('username')) {
            $this->redirectToPath("/main");
        } 
        return $this->twig->render('login.html.twig', ['error' => '']);
    }

    #[Route('/auth', method: 'post')]
    public function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['email']) && !empty($_POST['password'])) {
            $user = $this->auth->checkUserPermission(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
            if (!$user) {
                return $this->twig->render('login.html.twig', ['error' => 'Connexion échouée']);
            } else {
                $this->sessionManager->set('username', $user->getUsername());
                $user->setLastLogin(new \DateTime('now'));
                $this->auth->updateLastLogin($user);
                $this->redirectToPath("/main");
            }
        }
        return $this->twig->render('login.html.twig', ['error' => 'Connexion échouée']);
    }


    #[Route('/logout')]
    public function logout()
    {
        $this->sessionManager->clear();
        $this->redirectToPath("/login");
        return $this->twig->render('logout.html.twig');
    }

    #[Route('/register')]
    public function register()
    {
        return $this->twig->render('login.html.twig');
    }
}
