<?php

namespace App\Entity;

use App\Entity\Traits\EnabledTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class CrmPage
 *
 * @ORM\Entity(repositoryClass="App\Repository\CrmPageRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 *
 */
class CrmPage
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 5,
     *      max = 64,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *      min = 64,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     * )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank(message="Please choose a type")
     */
    private $type;

    /**
     * @var CrmMenu
     *
     * @ORM\OneToOne(targetEntity="App\Entity\CrmMenu", cascade={"persist", "remove"})
     */
    private $menu;

    /**
     * @var CrmSubMenu
     *
     * @ORM\OneToOne(targetEntity="App\Entity\CrmSubMenu", cascade={"persist", "remove"})
     */
    private $subMenu;

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
     * @param string|null $title
     *
     * @return $this
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return CrmMenu|null
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param CrmMenu|null $menu
     *
     * @return $this
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * @return CrmSubMenu|null
     */
    public function getSubMenu()
    {
        return $this->subMenu;
    }

    /**
     * @param CrmSubMenu|null $subMenu
     *
     * @return $this
     */
    public function setSubMenu($subMenu)
    {
        $this->subMenu = $subMenu;

        return $this;
    }
}
