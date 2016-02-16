<?php

namespace AppBundle\Entity;

/**
 * Action
 */
class Action
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $answerId;

    /**
     * @var int
     */
    private $devicesId;

    /**
     * @var \DateTime
     */
    private $time;


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
     * Set answerId
     *
     * @param integer $answerId
     *
     * @return Action
     */
    public function setAnswerId($answerId)
    {
        $this->answerId = $answerId;

        return $this;
    }

    /**
     * Get answerId
     *
     * @return int
     */
    public function getAnswerId()
    {
        return $this->answerId;
    }

    /**
     * Set devicesId
     *
     * @param integer $devicesId
     *
     * @return Action
     */
    public function setDevicesId($devicesId)
    {
        $this->devicesId = $devicesId;

        return $this;
    }

    /**
     * Get devicesId
     *
     * @return int
     */
    public function getDevicesId()
    {
        return $this->devicesId;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Action
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }
}

