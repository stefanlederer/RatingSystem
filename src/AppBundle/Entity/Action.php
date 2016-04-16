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
    private $answersId;

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
     * Set answersId
     *
     * @param integer $answersId
     *
     * @return Action
     */
    public function setAnswersId($answersId)
    {
        $this->answersId = $answersId;

        return $this;
    }

    /**
     * Get answersId
     *
     * @return int
     */
    public function getAnswersId()
    {
        return $this->answersId;
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

