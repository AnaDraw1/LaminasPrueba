<?php

namespace Usuarios\Controller;

use Laminas\Session;

class UserController extends AbstractController
{
    public function indexAction() {
        $userSession = new Session\Container('user');
        
        return [
            'user' => $userSession->details
        ];
    }
}
?>