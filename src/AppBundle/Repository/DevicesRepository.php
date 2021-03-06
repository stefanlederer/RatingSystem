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
            ->select('d.id')
            ->from('AppBundle:Devices', 'd')
            ->where('d.connection = :connection')
            ->setParameter('connection', $conn)
            ->getQuery();

        return $query->getArrayResult();
    }

    public function getDevices($actDevice) {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select('d')
            ->from('AppBundle:Devices', 'd')
            ->orderBy('d.id', $actDevice)
            ->getQuery();

        return $query->getArrayResult();
    }
}
