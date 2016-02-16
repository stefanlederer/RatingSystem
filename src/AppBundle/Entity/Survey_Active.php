<?php

namespace AppBundle\Entity;

/**
 * Survey_Active
 */
class Survey_Active
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $surveyId;

    /**
     * @var int
     */
    private $devicesId;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;


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
     * Set surveyId
     *
     * @param integer $surveyId
     *
     * @return Survey_Active
     */
    public function setSurveyId($surveyId)
    {
        $this->surveyId = $surveyId;

        return $this;
    }

    /**
     * Get surveyId
     *
     * @return int
     */
    public function getSurveyId()
    {
        return $this->surveyId;
    }

    /**
     * Set devicesId
     *
     * @param integer $devicesId
     *
     * @return Survey_Active
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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Survey_Active
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Survey_Active
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
}

