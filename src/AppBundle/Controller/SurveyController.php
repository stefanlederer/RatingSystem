<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Answers;
use AppBundle\Entity\Survey;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SurveyController extends Controller
{
    /**
     * @Route("/admin/allSurvey", name="allSurvey")
     */
    public function allSurveyAction()
    {
        $em = $this->getDoctrine()->getManager();
        $allSurvey = $em
            ->getRepository('AppBundle:Survey')
            ->findBy(array(), array('id' => 'DESC'));
        
        return $this->render('AppBundle:Survey:all_survey.html.twig', array(
            'allSurvey' => $allSurvey
        ));
    }

    /**
     * @Route("/admin/changeSurvey", name="changeSurvey")
     */
    public function changeSurveyAction()
    {
        $em = $this->getDoctrine()->getManager();
        $allSurvey = $em
            ->getRepository('AppBundle:Survey')
            ->findBy(array(), array('id' => 'DESC'));



        return $this->render('AppBundle:Survey:change_survey.html.twig', array(
            'allSurvey' => $allSurvey
        ));
    }
    /**
     * @Route("/admin/changeSurvey/change")
     */
    public function changeSurveyRowAction() {

        $request = Request::createFromGlobals();
        $id = $request->request->get('id');
        $question = $request->request->get('question');
        $date_start = $request->request->get('date_start');
        $date_end = $request->request->get('date_end');
        $count = $request->request->get('count');
        $activity = $request->request->get('activity');

        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Survey')
            ->changeSurvey($id, $question, $date_start, $date_end, $count, $activity);

        $response = new Response(json_encode(array()));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/admin/changeSurvey/delete")
     */
    public function deleteSurveyRowAction() {
        
        $request = Request::createFromGlobals();
        $id = $request->request->get('id');
        
        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Survey')
            ->deleteSurvey($id);
        
    }

    /**
     * @Route("/admin/addSurvey", name="addSurvey")
     */
    public function addSurveyAction()
    {

        $request = Request::createFromGlobals();
        $question = $request->request->get('question');
        $date_start = $request->request->get('startDate');
        $date_end = $request->request->get('endDate');
        $status = $request->request->get('status');
        $device = $request->request->get('device');
        $count = $request->request->get('answerQuantity');
        $answerOptions[] = $request->request->get('answerOptions');


        if(strlen($question) > 0 && strlen($date_start) > 0 && strlen($date_end) > 0 && strlen($status) > 0 &&
            strlen($device) > 0 && strlen($count) > 0) {

            $userId = $this->getUser()->getId();

            $survey = new Survey();

            $survey->setQuestion($question);
            $survey->setSurveyStart(new \DateTime($date_start));
            $survey->setSurveyEnd(new \DateTime($date_end));
            $survey->setButtonQuantity($count);
            $survey->setUserId($userId);
            $survey->setStatus($status);

            $em = $this->getDoctrine()->getManager();
            $em->persist($survey);
            $em->flush();

            $survey_id = $survey->getId();
            $buttonQuantity = count($answerOptions[0]);


            for($i = 0; $i < $buttonQuantity; $i++) {
                $answer = new Answers();
                $answer->setSurveyId($survey_id);
                $answer->setAnswerOption($answerOptions[0][$i]);
                $em->persist($answer);
                $em->flush();
            }



        }


        $em = $this->getDoctrine()->getManager();
        $allDevices = $em
            ->getRepository('AppBundle:Devices')
            ->findBy(array(), array('id' => 'ASC'));

        return $this->render('AppBundle:Survey:add_survey.html.twig', array(
            'allDevices' => $allDevices
        ));
    }
    
    /**
     * @Route("/admin/statistic", name="statisticSelection")
     */
    public function statisticSelectionAction() {

//        $em = $this->getDoctrine()->getManager();
//        $allSurvey = $em
//            ->getRepository('AppBundle:Survey')
//            ->getStatisticFromSurvey();

        $em = $this->getDoctrine()->getManager();
        $allSurvey = $em
            ->getRepository('AppBundle:Survey')
            ->findBy(array(), array('id' => 'DESC'));

        return $this->render('AppBundle:Survey:statistic_selection.html.twig', array(
            'allSurvey' => $allSurvey
        ));
    }
    
    /**
     * @Route("/admin/statistic/chart")
     */
    public function statisticChartAction() {

        return $this->render('AppBundle:Survey:statisticChart.html.twig', array(
            
        ));
        
    }

}
