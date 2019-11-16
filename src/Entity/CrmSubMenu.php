<?php

namespace App\Entity;

use App\Entity\Traits\EnabledTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CrmSubMenu
 *
 * @ORM\Entity(repositoryClass="App\Repository\CrmSubMenuRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class CrmSubMenu
{

    use TimestampableEntity;
    use SoftDeleteableEntity;
    use EnabledTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank(message="Please set a title!")
     * @Assert\Length(
     *      min = 5,
     *      max = 64,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters"
     * )
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Please set a number!")
     * @\App\Validator\PositionSub()
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var CrmMenu
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CrmMenu", inversedBy="subMenus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return $this
     */
    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     *
     * @return $this
     */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return CrmMenu|null
     */
    public function getMenu(): ?CrmMenu
    {
        return $this->menu;
    }

    /**
     * @param CrmMenu|null $menu
     *
     * @return $this
     */
    public function setMenu(?CrmMenu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
