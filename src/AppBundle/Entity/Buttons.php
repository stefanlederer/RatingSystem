<?php

namespace AppBundle\Entity;

/**
 * Buttons
 */
class Buttons
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $buttons;


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
     * Set buttons
     *
     * @param string $buttons
     *
     * @return Buttons
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * Get buttons
     *
     * @return string
     */
    public function getButtons()
    {
        return $this->buttons;
    }
}

