<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Answers;
use AppBundle\Entity\Devices;
use AppBundle\Entity\Survey;
use AppBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\LazyProxy\Instantiator\RealServiceInstantiator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SurveyController extends Controller {
    /**
     * @Route("/admin/allSurvey", name="allSurvey")
     */
    public function allSurveyAction() {
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
    public function changeSurveyAction() {
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

        $em = $this->getDoctrine()->getManager();

        $survey = $this->getDoctrine()->getRepository('AppBundle:Survey')->find($id);

        $survey->setQuestion($question);
        $survey->setSurveyStart(new \DateTime($date_start));
        $survey->setSurveyEnd(new \DateTime($date_end));
        $survey->setButtonQuantity($count);
        $survey->setStatus($activity);

        $em->persist($survey);
        $em->flush();


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
     * @Route("/admin/changeDevice", name="changeDevice")
     */
    public function changeDeviceAction() {
        $em = $this->getDoctrine()->getManager();
        $allDevices = $em
            ->getRepository('AppBundle:Devices')
            ->findBy(array(), array('id' => 'ASC'));

        return $this->render('AppBundle:Survey:change_device.html.twig', array(
            'allDevices' => $allDevices
        ));
    }

    /**
     * @Route("/admin/changeDevice/change")
     */
    public function changeDeviceRowAction() {
        $request = Request::createFromGlobals();
        $id = $request->request->get('id');
        $connection = $request->request->get('device');

        $em = $this->getDoctrine()->getManager();

        $device = $this->getDoctrine()->getRepository('AppBundle:Devices')->find($id);

        $device->setConnection($connection);

        $em->persist($device);
        $em->flush();


        return new JsonResponse(array('message' => 'erfolgreich geändert'));
    }

    /**
     * @Route("/admin/changeDevice/delete")
     */
    public function deleteDeviceRowAction() {
        $request = Request::createFromGlobals();
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();

        $devices = $this->getDoctrine()->getRepository('AppBundle:Devices')->find($id);

        $em->remove($devices);
        $em->flush();
        return new JsonResponse(array('message' => 'erfolgreich gelöscht'));
    }

    /**
     * @Route("/admin/changeUser", name="changeUser")
     */
    public function changeUserAction() {
        $em = $this->getDoctrine()->getManager();
        $allUsers = $em
            ->getRepository('AppBundle:Users')
            ->findBy(array(), array('id' => 'ASC'));

        return $this->render('AppBundle:Survey:change_user.html.twig', array(
            'allUsers' => $allUsers
        ));
    }

    /**
     * @Route("/admin/changeUser/change")
     */
    public function changeUserRowAction() {
        $request = Request::createFromGlobals();
        $id = $request->request->get('id');
        $username = $request->request->get('username');
        $role = $request->request->get('role');

        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getRepository('AppBundle:Users')->find($id);

        $user->setUsername($username);
        $user->setRoles(array($role));

        $em->persist($user);
        $em->flush();


        return new JsonResponse(array('message' => 'erfolgreich geändert'));
    }

    /**
     * @Route("/admin/changeUser/delete")
     */
    public function deleteUserRowAction() {
        $request = Request::createFromGlobals();
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();

        $users = $this->getDoctrine()->getRepository('AppBundle:Users')->find($id);

        $em->remove($users);
        $em->flush();
        return new JsonResponse(array('message' => 'erfolgreich gelöscht'));
    }

    /**
     * @Route("/admin/addSurvey", name="addSurvey")
     */
    public function addSurveyAction() {

        $request = Request::createFromGlobals();
        //add survey
        $question = $request->request->get('question');
        $date_start = $request->request->get('startDate');
        $date_end = $request->request->get('endDate');
        $time_start = $request->request->get('startTime');
        $time_end = $request->request->get('endTime');
        $status = $request->request->get('status');
        $device = $request->request->get('device');
        $count = $request->request->get('answerQuantity');
        $answerOptions[] = $request->request->get('answerOptions');

        //proof if strlen answeroptions are true
        $answerOptionTrue = true;
        for($i = 0; $i < count($answerOptions[0]); $i++) {
            if( strlen($answerOptions[0][$i]) <= 0) {
                $answerOptionTrue = false;
            }
        }

        //add devices
        $newDevice = $request->request->get('newdevice');

        //add user
        $newUsername = $request->request->get('newUser');
        $newUserPW = $request->request->get('userPW');
        $newUserRole = $request->request->get('newUserRole');


        if (strlen($question) > 0 && strlen($date_start) > 0 && strlen($date_end) > 0 && strlen($time_start) > 0 &&
            strlen($time_end) > 0 && strlen($status) > 0 && strlen($device) > 0 && strlen($count) > 0 &&
            $answerOptionTrue == true) {

            $em = $this->getDoctrine()->getManager();

            $userId = $this->getUser()->getId();

            $survey = new Survey();

            $survey->setQuestion($question);
            $survey->setSurveyStart(new \DateTime($date_start));
            $survey->setSurveyEnd(new \DateTime($date_end));
            $survey->setTimeStart(new \DateTime($time_start));
            $survey->setTimeEnd(new \DateTime($time_end));
            $survey->setButtonQuantity($count);
            $survey->setUserId($userId);
            $survey->setStatus($status);
            $survey->setDevicesId($device);


            $em->persist($survey);
            $em->flush();

            $survey_id = $survey->getId();
            $buttonQuantity = count($answerOptions[0]);


            for ($i = 0; $i < $buttonQuantity; $i++) {
                $answer = new Answers();
                $answer->setSurveyId($survey_id);
                $answer->setAnswerOption($answerOptions[0][$i]);
                $em->persist($answer);
                $em->flush();
            }


        }

        if(strlen($newDevice) > 0) {
            $addNewDevice = new Devices();

            $addNewDevice->setConnection($newDevice);

            $em = $this->getDoctrine()->getManager();
            $em->persist($addNewDevice);
            $em->flush();

        }

        if(strlen($newUsername) > 0 && strlen($newUserPW) > 0 && strlen($newUserRole) > 0) {
            $user = new Users();

            if($newUserRole == "Benutzer") {
                $newUserRole = "ROLE_USER";
            }
            if($newUserRole == "Administrator") {
                $newUserRole = "ROLE_ADMIN";
            }

            $options = array('cost' => 12);
            $newpw = password_hash($newUserPW, PASSWORD_BCRYPT, $options);
            
            $user->setUsername($newUsername);
            $user->setPassword($newpw);
            $user->setRoles(array($newUserRole));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

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
        $em = $this->getDoctrine()->getManager();
        $allSurvey = $em
            ->getRepository('AppBundle:Survey')
            ->findBy(array(), array('id' => 'DESC'));
        $countSurvey = [];
        $i = 0;
        foreach ($allSurvey as $value) {
            $allAnswersOnThisSurvey = $em->getRepository('AppBundle:Answers')->findBySurveyId($value->getId());
            $countSurvey[$i]['surveyId'] = $value->getId();
            $countSurvey[$i]['count'] = 0;
            foreach ($allAnswersOnThisSurvey as $answer) {
                $countSurvey[$i]['count'] += intval($em->getRepository('AppBundle:Action')->countActionBySurveyId($answer->getId())[0][1]);
            }
            $i++;
        }

        $dateDiff = [];
        foreach ($allSurvey as $value) {
            $dateDiff[] = date_diff($value->getSurveyEnd(), $value->getSurveyStart());
        }
        return $this->render('AppBundle:Survey:statistic_selection.html.twig', array(
            'allSurvey' => $allSurvey,
            'countSurvey' => $countSurvey,
            'dateDiff' => $dateDiff
        ));
    }

    /**
     * @Route("/admin/survey/getAnswers/{id}")
     */
    public function getAnswers($id) {
        $survey = $this->getDoctrine()->getRepository('AppBundle:Survey')->find($id);
        $answers = $this->getDoctrine()->getRepository('AppBundle:Answers')->getStatisticsInformations($survey->getId());
        return new JsonResponse(array('content' => $answers));
    }

    /**
     * @Route("/admin/statistic/chart")
     */
    public function statisticChartAction() {

        return $this->render('AppBundle:Survey:statisticChart.html.twig', array());

    }

    /**
     * @Route("/admin/statistic/csv/{id}")
     */
    public function csvAction($id) {
        $survey = $this->getDoctrine()->getRepository('AppBundle:Survey')->find($id);
        $answers = $this->getDoctrine()->getRepository('AppBundle:Answers')->getStatisticsInformations($survey->getId());
        $answerOption = [];
        $countAnswer = [];

        foreach ($answers as $value) {
            $answerOption[] = $value['answerOption'];
            $countAnswer[] = $value[1];
        }
        $list = [$answerOption, $countAnswer];

        $filename = 'csv/' . $survey->getId() . '.csv';

        $fp = fopen($filename, 'wr');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }

        return new JsonResponse(array('path' => $filename));
    }
    /**
     * generates a random string
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = null) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
