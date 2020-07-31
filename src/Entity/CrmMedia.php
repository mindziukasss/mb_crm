<?php

namespace App\Entity;

use App\Entity\Traits\EnabledTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * Class CrmMedia
 *
 * @ORM\Entity(repositoryClass="App\Repository\CrmMediaRepository")
 */
class CrmMedia
{
    use TimestampableEntity;
    use SoftDeleteableEntity;
    use EnabledTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("main")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups("main")
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups("main")
     */
    private $originalFileName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups("main")
     */
    private $mimeType;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("main")
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("main")
     */
    private $attributeAlt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CrmGallery", inversedBy="media")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $gallery;

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
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     *
     * @return $this
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOriginalFileName(): ?string
    {
        return $this->originalFileName;
    }

    /**
     * @param string $originalFileName
     *
     * @return $this
     */
    public function setOriginalFileName(string $originalFileName): self
    {
        $this->originalFileName = $originalFileName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     *
     * @return $this
     */
    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     *
     * @return $this
     */
    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAttributeAlt(): ?string
    {
        return $this->attributeAlt;
    }

    /**
     * @param string|null $attributeAlt
     *
     * @return $this
     */
    public function setAttributeAlt(?string $attributeAlt): self
    {
        $this->attributeAlt = $attributeAlt;

        return $this;
    }

    /**
     * @return CrmGallery|null
     */
    public function getGallery(): ?CrmGallery
    {
        return $this->gallery;
    }

    /**
     * @param CrmGallery|null $gallery
     *
     * @return $this
     */
    public function setGallery(?CrmGallery $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }

    public function getImagePath()
    {
        //twig extension
//        return UploaderHelper::GALLERIES.'/'. $this->getImageFilename();

        return 'uploads/galleries/'.$this->getFileName();
    }
}
