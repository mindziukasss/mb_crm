<?php


namespace App\Entity\Traits;

/**
 * Trait EnabledTrait
 */
trait EnabledTrait
{
    /** @var bool */
    private $enabled;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}