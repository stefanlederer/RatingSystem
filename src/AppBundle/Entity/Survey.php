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
     * @var int
     */
    private $buttonType;

    /**
     * @var \DateTime
     */
    private $surveyStart;

    /**
     * @var \DateTime
     */
    private $surveyEnd;

    /**
     * @var int
     */
    private $userId;


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
     * Set buttonType
     *
     * @param integer $buttonType
     *
     * @return Survey
     */
    public function setButtonType($buttonType)
    {
        $this->buttonType = $buttonType;

        return $this;
    }

    /**
     * Get buttonType
     *
     * @return int
     */
    public function getButtonType()
    {
        return $this->buttonType;
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
}

