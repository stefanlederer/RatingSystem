<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function loginAction()
    {
        return $this->render('AppBundle:Login:login.html.twig', array(
            // ...
        ));
    }

    /**
     * is only used by the security System
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction() {
        // this controller will not be executed,
        // as the route is handled by the Security system
        throw new \Exception('This should never be reached!');
    }

    /**
     * is only used by the security System
     * @Route("/logout", name="logout_route")
     */
    public function logoutAction() {
        // this controller will not be executed,
        // as the route is handled by the Security system
        throw new \Exception('This should never be reached!');
    }

}
