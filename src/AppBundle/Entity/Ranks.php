<?php

namespace AppBundle\Entity;

/**
 * Ranks
 */
class Ranks
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $rank;


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
     * Set rank
     *
     * @param string $rank
     *
     * @return Ranks
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return string
     */
    public function getRank()
    {
        return $this->rank;
    }
}

