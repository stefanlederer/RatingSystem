<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Action;

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
        $buttonID = $request->request->get('button');
        $surveyID = $question["surveyID"];

//        print_r($buttonID);
//        print_r($surveyID);

        $dID = $em->getRepository('AppBundle:Devices')
            ->getDevicesId($conn);
        $devicesID = $dID[0]['id'];
        $aID = $em->getRepository('AppBundle:Answers')
            ->getAnswerId($surveyID, $buttonID);

        if ($aID != null) {

            $answerID = $aID[0]['id'];

            $time = new \DateTime();
            $time->format('Y-m-d \O\n H:i:s');

            $action = new Action();

            $action->setAnswersId($answerID);
            $action->setDevicesId($devicesID);
            $action->setTime($time);

            $em = $this->getDoctrine()->getManager();
            $em->persist($action);
            $em->flush();


//            print_r($buttonID);
//            print_r($surveyID);
//            print_r($devicesID);
//            print_r($answerID);
        }

        return $this->render('AppBundle:Bewertung:bewertung.html.twig', array(
            // the question of the survey
            'survey' => $question,
            'buttonsources' => $buttonsource
        ));

        $response = new Response(json_encode(array(

        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    public function getConn()
    {
//        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
//        print_r($hostname);
//        return $hostname;
        return "erstes Gerät";
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
