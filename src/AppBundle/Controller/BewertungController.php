<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BewertungController extends Controller
{
    /**
     * @Route("/", name="bewertungAction")
     */
    public function bewertungAction()
    {
        //get Question
        $conn = $this->getConn();

        $time = $this->getTime();

        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('AppBundle:Survey_Active')
            ->getQuestion($conn, $time)
            ->setMaxResults(1)
            ->getOneOrNullResult();

        $buttonsource = $this->nameToSource($question['buttonQuantity']);


        //insert Question
        $request = Request::createFromGlobals();
        $buttonsrc = $request->request->get('button');
        $questionID = $question["surveyID"];
        $dID = $em->getRepository('AppBundle:Devices')
            ->getDevicesId($conn);
        $devicesID = $dID[0]['id'];


//        print_r($buttonsrc);
//        print_r($questionID);
//        print_r($devicesID);

        return $this->render('AppBundle:Bewertung:bewertung.html.twig', array(
            // the question of the survey
            'survey' => $question,
            'buttonsources' => $buttonsource
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

    public function nameToSource($quantity)
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
