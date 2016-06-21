<?php

namespace AppBundle\Repository;

/**
 * SurveyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SurveyRepository extends \Doctrine\ORM\EntityRepository
{

    public function getQuestion($conn, $time)
    {
        $status = "Aktiv";
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
            ->select('s')
            ->from('AppBundle:Survey', 's')
            ->leftJoin('AppBundle:Devices', 'd', 'WITH', 's.devicesId = d.id')
            ->where('d.connection = :connection OR s.devicesId = 0')
            ->andWhere('s.surveyStart <= :time')
            ->andWhere('s.surveyEnd > :time')
            ->andWhere('s.status = :status')
            ->setParameter('connection', $conn)
            ->setParameter('time', $time)
            ->setParameter('status', $status)
            ->setMaxResults(1);

        return $query->getQuery()->getArrayResult();
    }
    
    public function changeSurvey($id, $question, $date_start, $date_end, $count, $activity) {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->update('s')
            ->from('AppBundle:Survey','s')
            ->set('s.question', ':question')
            ->set('s.survey_start',':date_start')
            ->set('s.survey_end', ':date_end')
            ->set('s.button_quantity', ':count')
            ->set('s.status', ':status')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->setParameter('question', $question)
            ->setParameter('date_start', $date_start)
            ->setParameter('date_end', $date_end)
            ->setParameter('count', $count)
            ->setParameter('status', $activity);

        $result = $query->getQuery()->execute();
    }

    public function getStatisticFromSurvey() {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select('s, an.buttonId as buttonId, an.answerOption as answerOption')
            ->from('AppBundle:Survey', 's')
            ->leftJoin('AppBundle:Answers', 'an', 'WITH', 'an.surveyId = s.id')
            ->leftJoin('AppBundle:Action', 'ac', 'WITH', 'ac.answersId = an.id');

        $result = $query->getQuery()->getResult();

        return $result;
    }
    
}
