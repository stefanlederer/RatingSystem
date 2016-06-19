<?php

namespace AppBundle\Entity;

/**
 * Answers
 */
class Answers
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
     * @var string
     */
    private $answerOption;


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
     * @return Answers
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
     * Set answerOption
     *
     * @param string $answerOption
     *
     * @return Answers
     */
    public function setAnswerOption($answerOption)
    {
        $this->answerOption = $answerOption;

        return $this;
    }

    /**
     * Get answerOption
     *
     * @return string
     */
    public function getAnswerOption()
    {
        return $this->answerOption;
    }
}

