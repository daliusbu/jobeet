<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.1
 * Time: 23.52
 */

namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{

    private $targetDirectory;

    public function __construct(string $targetDirectory)
    {
        $this->targetDirecotry = $targetDirectory;
    }

    /**
     * @return string
     */
    public function getTargetDirecotry(): string
    {
        return $this->targetDirecotry;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid("", false)) . '.' . $file->guessExtension();
        $file->move($this->targetDirecotry, $fileName);
        return $fileName;
    }
}