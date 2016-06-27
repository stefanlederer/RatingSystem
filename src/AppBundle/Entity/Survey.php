<?php

namespace AppBundle\Entity;

/**
 * Survey
 */
class Survey
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $question;

    /**
     * @var int
     */
    private $buttonQuantity;

    /**
     * @var \DateTime
     */
    private $surveyStart;

    /**
     * @var \DateTime
     */
    private $surveyEnd;

    /**
     * @var \DateTime
     */
    private $timeStart;

    /**
     * @var \DateTime
     */
    private $timeEnd;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $status;

    /**
     * @var int
     */
    private $devicesId;


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
     * Set question
     *
     * @param string $question
     *
     * @return Survey
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set buttonQuantity
     *
     * @param integer $buttonQuantity
     *
     * @return Survey
     */
    public function setButtonQuantity($buttonQuantity)
    {
        $this->buttonQuantity = $buttonQuantity;

        return $this;
    }

    /**
     * Get buttonQuantity
     *
     * @return int
     */
    public function getButtonQuantity()
    {
        return $this->buttonQuantity;
    }

    /**
     * Set surveyStart
     *
     * @param \DateTime $surveyStart
     *
     * @return Survey
     */
    public function setSurveyStart($surveyStart)
    {
        $this->surveyStart = $surveyStart;

        return $this;
    }

    /**
     * Get surveyStart
     *
     * @return \DateTime
     */
    public function getSurveyStart()
    {
        return $this->surveyStart;
    }

    /**
     * Set surveyEnd
     *
     * @param \DateTime $surveyEnd
     *
     * @return Survey
     */
    public function setSurveyEnd($surveyEnd)
    {
        $this->surveyEnd = $surveyEnd;

        return $this;
    }

    /**
     * Get surveyEnd
     *
     * @return \DateTime
     */
    public function getSurveyEnd()
    {
        return $this->surveyEnd;
    }

    /**
     * Set timeStart
     *
     * @param \DateTime $timeStart
     *
     * @return Survey
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    /**
     * Get timeStart
     *
     * @return \DateTime
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set timeEnd
     *
     * @param \DateTime $timeEnd
     *
     * @return Survey
     */
    public function setTimeEnd($timeEnd)
    {
        $this->timeEnd = $timeEnd;

        return $this;
    }

    /**
     * Get timeEnd
     *
     * @return \DateTime
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Survey
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Survey
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set devicesId
     *
     * @param integer $devicesId
     *
     * @return Survey
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
}

