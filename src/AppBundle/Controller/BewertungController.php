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
        $question = $em->getRepository('AppBundle:Survey_Active')
            ->getQuestion($conn, $time);

        print_r($question['buttonQuantity']);

        $buttonsource = $this->images($question['buttonQuantity']);

        return $this->render('AppBundle:Bewertung:bewertung.html.twig', array(
            // the question of the survey
            'survey' => $question,
            'buttonsources' => $buttonsource
        ));
    }

    /**
     * @Route("/", name="abgabeBewertung")
     */
    public function abgabeBewertung()
    {

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

    public function images($quantity)
    {
        $sources = array();
        switch ($quantity) {
            case "2":
                $sources = array("images/sehr-gut.png", "images/schlecht.png");
                break;
            case "3":
                $sources = array("images/sehr-gut.png", "images/befriedigend.png", "images/schlecht.png");
                break;
            case "4":
                $sources = array("images/sehr-gut.png", "images/gut.png", "images/genuegend.png", "images/schlecht.png");
                break;
            case "5":
                $sources = array("images/sehr-gut.png", "images/gut.png", "images/befriedigend.png", "images/genuegend.png", "images/schlecht.png");
        }
        return $sources;
    }

}
