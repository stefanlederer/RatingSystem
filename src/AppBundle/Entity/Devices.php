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
    private $conn;


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
     * Set conn
     *
     * @param string $conn
     *
     * @return Devices
     */
    public function setConn($conn)
    {
        $this->conn = $conn;

        return $this;
    }

    /**
     * Get conn
     *
     * @return string
     */
    public function getConn()
    {
        return $this->conn;
    }
}

