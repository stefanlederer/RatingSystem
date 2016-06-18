<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller
{
    /**
     * @Route("/admin", name="login_route")
     */
    public function loginAction()
    {
        $helper = $this->get('security.authentication_utils');
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AppBundle:Login:login.html.twig', array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error'         => $error
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
