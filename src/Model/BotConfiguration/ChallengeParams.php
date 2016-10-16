<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 16.10.16
 * Time: 13:37
 */

namespace StasPiv\PlayzoneBot\Model\BotConfiguration;

use JMS\Serializer\Annotation as JMS;

class ChallengeParams
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    private $base = 180000;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    private $increment = 1000;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    private $baseMinutes = 3;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    private $incrementSeconds = 1;

    /**
     * @return int
     */
    public function getBase(): int
    {
        return $this->base;
    }

    /**
     * @param int $base
     * @return ChallengeParams
     */
    public function setBase(int $base): self
    {
        $this->base = $base;

        return $this;
    }

    /**
     * @return int
     */
    public function getIncrement(): int
    {
        return $this->increment;
    }

    /**
     * @param int $increment
     * @return ChallengeParams
     */
    public function setIncrement(int $increment): self
    {
        $this->increment = $increment;

        return $this;
    }

    /**
     * @return int
     */
    public function getBaseMinutes(): int
    {
        return $this->baseMinutes;
    }

    /**
     * @param int $baseMinutes
     * @return ChallengeParams
     */
    public function setBaseMinutes(int $baseMinutes): self
    {
        $this->baseMinutes = $baseMinutes;

        return $this;
    }

    /**
     * @return int
     */
    public function getIncrementSeconds(): int
    {
        return $this->incrementSeconds;
    }

    /**
     * @param int $incrementSeconds
     * @return ChallengeParams
     */
    public function setIncrementSeconds(int $incrementSeconds): self
    {
        $this->incrementSeconds = $incrementSeconds;

        return $this;
    }
}