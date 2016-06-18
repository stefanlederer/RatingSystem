<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
        return $this->render('AppBundle:Survey:change_survey.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/admin/addSurvey", name="addSurvey")
     */
    public function addSurveyAction()
    {
        return $this->render('AppBundle:Survey:add_survey.html.twig', array(
            // ...
        ));
    }

}
