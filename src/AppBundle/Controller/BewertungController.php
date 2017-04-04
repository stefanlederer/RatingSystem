<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
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

        $detailerror = "";

        try {
            $em = $this->getDoctrine()->getManager();
            $question = $em->getRepository('AppBundle:Survey')
                ->getQuestion($conn, $time);

            if (strlen(@$question[0]['id']) > 0) {


                //get buttonnames (answerOptions)
                $buttonname = $em->getRepository('AppBundle:Answers')
                    ->getAnswerOption($question[0]["id"]);


                $buttonsource = $this->nameToSource($question[0]['buttonQuantity']);

                //get buttonsources and answerOptions
                $buttons = array();
                for ($i = 0; $i < count($buttonname); $i++) {
                    $buttons[$i]['source'] = $buttonsource[$i];
                    $buttons[$i]['answerOption'] = $buttonname[$i]['answerOption'];
                }

                //insert Question
                $request = Request::createFromGlobals();
                $answerOption = $request->request->get('button');
                $surveyID = $question[0]["id"];

                if(strlen(@$answerOption) > 0) {
                    $dID = $em->getRepository('AppBundle:Devices')
                        ->getDevicesId($conn);
                    $devicesID = $dID[0]['id'];
                    $aID = $em->getRepository('AppBundle:Answers')
                        ->getAnswerId($surveyID, $answerOption);

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

                    }
                }

                return $this->render('AppBundle:Bewertung:bewertung.html.twig', array(
                    // the question of the survey
                    'survey' => $question,
                    'buttons' => $buttons,
                    'buttonnames' => $buttonname
                ));
            } else {
                $errormessage = "Derzeit steht keine Umfrage zur Verfügung!";
                $detailerror = "No survey";
                return $this->render('AppBundle:Bewertung:error.html.twig', array(
                    "errormessage" => $errormessage,
                    "detailerror" => $detailerror
                ));
            }
        }
        catch(\Doctrine\ORM\ORMException $e) {
            $this->get('session')->getFlashBag()->add('error', 'Your custom message');
            $this->get('logger')->error($e->getMessage());
            return $this->redirect($this->getRequest()->headers->get('referer'));
        }
        catch(\Exception $e) {
            $detailerror = $e->getMessage();
            $errormessage = "Derzeit steht keine Umfrage zur Verfügung!";
            return $this->render('AppBundle:Bewertung:error.html.twig', array(
                "errormessage" => $errormessage,
                "detailerror" => $detailerror
            ));
        }

            $response = new Response(json_encode(array()));
            $response->headers->set('Content-Type', 'application/json');
            return $response;


    }


    public function getConn()
    {
//        $hostname = php_uname('n');
        $hostname = gethostname();
        return $hostname;
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
