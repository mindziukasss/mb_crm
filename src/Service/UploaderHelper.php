<?php


namespace App\Service;


use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Psr\Log\LoggerInterface;
use Symfony\Component\Asset\Context\RequestStackContext;

/**
 * Class UploaderHelper
 */
class UploaderHelper
{
    const GALLERIES = 'galleries';

    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $publicAssetBaseUrl;

    /**
     * @var RequestStackContext
     */
    private $requestStackContext;


    /**
     * UploaderHelper constructor.
     *
     * @param FilesystemInterface $publicUploadFilesystem
     * @param RequestStackContext $requestStackContext
     * @param LoggerInterface     $logger
     * @param string              $uploadedAssetsBaseUrl
     */
    public function __construct(
        FilesystemInterface $publicUploadFilesystem,
        RequestStackContext $requestStackContext,
        LoggerInterface $logger,
        string $uploadedAssetsBaseUrl
    )
    {
        $this->filesystem = $publicUploadFilesystem;
        $this->requestStackContext = $requestStackContext;
        $this->logger = $logger;
        $this->publicAssetBaseUrl = $uploadedAssetsBaseUrl;

    }

    /**
     * @param File        $file
     * @param string|null $existingFilename
     *
     * @return string
     * @throws \League\Flysystem\FileExistsException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function uploadGalleryImage(File $file, ?string $existingFilename): string
    {
        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }
        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();


        $stream = fopen($file->getPathname(), 'r');
        $result = $this->filesystem->writeStream(
            self::GALLERIES.'/'.$newFilename,
            $stream
        );

        if ($result === false) {
            throw new \Exception(sprintf('Could not write uploaded file "%s"', $newFilename));
        }


        if (is_resource($stream)) {
            fclose($stream);
        }

        if ($existingFilename) {
            try {
                $result = $this->filesystem->delete(self::GALLERIES.'/'.$existingFilename);
                if ($result === false) {
                    throw new \Exception(sprintf('Could not delete old uploaded file "%s"', $existingFilename));
                }
            } catch (FileNotFoundException $e) {
                $this->logger->alert(sprintf('Old uploaded file "%s" was missing when trying to delete', $existingFilename));
            }
        }

        return $newFilename;
    }


    /**
     * @param string $path
     *
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function deleteFile(string $path)
    {
        $result = $this->filesystem->delete($path);
        if ($result === false) {
            throw new \Exception(sprintf('Error deleting "%s"', $path));
        }
    }

    /**
     * @param string $path
     *
     * @return string
     */
    public function getPublicPath(string $path): string
    {
//      fix url
//        return 'uploads/'.$path;
        return $this->requestStackContext
                ->getBasePath().$this->publicAssetBaseUrl.'/'.$path;
    }
}