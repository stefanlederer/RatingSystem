<?php

namespace AppBundle\Repository;

/**
 * AnswersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnswersRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAnswerId($surveyID, $answerOption) {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select('a.id')
            ->from('AppBundle:Answers', 'a')
            ->where('a.surveyId = :surveyID')
            ->andWhere('a.answerOption = :answerOption')
            ->setParameter('answerOption', $answerOption)
            ->setParameter('surveyID', $surveyID);

        return $query->getQuery()->getArrayResult();
    }

    public function getAnswerOption($surveyID) {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select('a.answerOption')
            ->from('AppBundle:Answers', 'a')
            ->where('a.surveyId = :surveyID')
            ->setParameter('surveyID', $surveyID)
            ->orderBy('a.id', 'ASC');

        return $query->getQuery()->getArrayResult();

    }

    public function getStatisticsInformations($id) {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select('a.answerOption as answerOption, COUNT(ac.id)')
            ->from('AppBundle:Answers', 'a')
            ->leftJoin('AppBundle:Action', 'ac', 'WITH', 'ac.answersId = a.id')
            ->where('a.surveyId = :surveyId')
            ->setParameter('surveyId', $id)
            ->groupBy('a.id');

        return $query->getQuery()->getResult();
    }
}
