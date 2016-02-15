<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BewertungController extends Controller
{
    /**
     * @Route("/", name="bewertungAction")
     */
    public function bewertungAction()
    {

        $question = "";

        return $this->render('AppBundle:Bewertung:bewertung.html.twig', array(
            // the question of the survey
            'question' => $question
        ));
    }

}
