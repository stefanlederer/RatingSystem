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

//        $em = $this->getDoctrine()->getManager();
//        $question = $em->getRepository('AppBundle:Survey_Active')
//            ->getQuestion($conn, $time);
        $question = "fjklsf";

        $buttonsource = "5"; //$this->images($question['buttonQuantity']);

        return $this->render('AppBundle:Bewertung:bewertung.html.twig', array(
            // the question of the survey
            'question' => $question,
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
                $sources = array("../Images/sehr-gut.png", "../Images/schlecht.png");
                break;
            case "3":
                $sources = array("../Images/sehr-gut.png", "../Images/befriedigend.png", "../Images/schlecht.png");
                break;
            case "4":
                $sources = array("../Images/sehr-gut.png", "../Images/gut.png", "../Images/genuegend.png", "../Images/schlecht.png");
                break;
            case "5":
                $sources = array("../Images/sehr-gut.png", "../Images/gut.png", "../Images/befriedigend.png", "../Images/genuegend.png", "../Images/schlecht.png");
        }
        return $sources;
    }

}
