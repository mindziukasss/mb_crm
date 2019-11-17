<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Entity\Traits\EnabledTrait;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CrmMenu
 *
 * @ORM\Entity(repositoryClass="App\Repository\CrmMenuRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 *
 */
class CrmMenu
{
    use TimestampableEntity;
    use SoftDeleteableEntity;
    use EnabledTrait;

    /**
     *
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
     * @\App\Validator\Position()
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var CrmSubMenu
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CrmSubMenu", mappedBy="menu", orphanRemoval=true)
     */
    private $subMenus;

    /**
     * CrmMenu constructor.
     */
    public function __construct()
    {
        $this->subMenus = new ArrayCollection();
    }

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
     * @return Collection|CrmSubMenu[]
     */
    public function getSubMenus(): Collection
    {
        return $this->subMenus;
    }

    /**
     * @param CrmSubMenu $subMenu
     *
     * @return $this
     */
    public function addSubMenu(CrmSubMenu $subMenu): self
    {
        if (!$this->subMenus->contains($subMenu)) {
            $this->subMenus[] = $subMenu;
            $subMenu->setMenu($this);
        }

        return $this;
    }

    /**
     * @param CrmSubMenu $subMenu
     *
     * @return $this
     */
    public function removeSubMenu(CrmSubMenu $subMenu): self
    {
        if ($this->subMenus->contains($subMenu)) {
            $this->subMenus->removeElement($subMenu);
            // set the owning side to null (unless already changed)
            if ($subMenu->getMenu() === $this) {
                $subMenu->setMenu(null);
            }
        }

        return $this;
    }
}
