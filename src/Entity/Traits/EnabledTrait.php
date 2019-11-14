<?php


namespace App\Entity\Traits;

/**
 * Trait EnabledTrait
 */
trait EnabledTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled = true;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     */
    public function setEnabled(bool $enabled): bool
    {
        $this->enabled = $enabled;

        return $enabled;
    }
}