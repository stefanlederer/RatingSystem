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
        $conn = $this->getConn();

        $time = $this->getTime();

        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('AppBundle:Action')
            ->getQuestion($conn, $time);

        return $this->render('AppBundle:Bewertung:bewertung.html.twig', array(
            // the question of the survey
            'question' => $question
        ));
    }

    public function getConn()
    {
        return "10.0.0.12";
    }

    public function getTime()
    {
        $time = new \DateTime();
        return $time;
    }

}
