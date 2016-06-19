<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Survey;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


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

        return new JsonResponse(array('message' => 'erfolgreich geändert'));
    }

    /**
     * @Route("/admin/changeSurvey/delete")
     */
    public function deleteSurveyRowAction() {
        $request = Request::createFromGlobals();
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();

        $survey = $this->getDoctrine()->getRepository('AppBundle:Survey')->find($id);

        $em->remove($survey);
        $em->flush();
        return new JsonResponse(array('message' => 'erfolgreich gelöscht'));
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
        $count = $request->request->get('answerQuantity');

        //answerOptions!!!!!!!!!!!! missing

        if(strlen($question) > 0 && strlen($date_start) > 0 && strlen($date_end) > 0 && strlen($count) > 0) {

            $survey = new Survey();

            $survey->setQuestion($question);
            $survey->setSurveyStart(new \DateTime($date_start));
            $survey->setSurveyEnd(new \DateTime($date_end));
            $survey->setButtonQuantity($count);

            $em = $this->getDoctrine()->getManager();
            $em->persist($survey);
            $em->flush();

        }

        return $this->render('AppBundle:Survey:add_survey.html.twig', array(

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
