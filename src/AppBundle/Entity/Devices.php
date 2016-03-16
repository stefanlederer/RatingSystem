<?php

namespace AppBundle\Entity;

/**
 * Devices
 */
class Devices
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $connection;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set connection
     *
     * @param string $connection
     *
     * @return Devices
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Get connection
     *
     * @return string
     */
    public function getConnection()
    {
        return $this->connection;
    }
}

