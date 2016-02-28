<?php

namespace AppBundle\Repository;

/**
 * DevicesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DevicesRepository extends \Doctrine\ORM\EntityRepository
{
    public function getDevicesId($conn) {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select("d.id")
            ->from('AppBundle:Devices', 'd')
            ->where('d.conn = :conn')
            ->setParameter('conn', $conn)
            ->getQuery();

        return $query->getArrayResult();
    }
}
