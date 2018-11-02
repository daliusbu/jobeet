<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.2
 * Time: 09.48
 */

namespace App\EventListener;


use App\Entity\Job;
use App\Form\JobType;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class JobUploadListener
{

    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
        $this->fileToString($entity);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->stringToFile($entity);
    }

    public function stringToFile($entity)
    {
        if(!$entity instanceof Job){
            return;
        }
        if($fileName= $entity->getLogo()){
            $entity->setLogo(new File($this->uploader->getTargetDirecotry() . '/' . $fileName));
        }
    }

    public function fileToString($entity)
    {
        if (!$entity instanceof Job){
            return;
        }

        $logoFile = $entity->getLogo();
        if ($logoFile instanceof File){
            $entity->setLogo($logoFile->getFilename());
        }
    }



    public function uploadFile($entity)
    {
        if (! $entity instanceof Job){
            return;
        }

        $logoFile = $entity->getLogo();
        if ($logoFile instanceof UploadedFile){
            $fileName = $this->uploader->upload($logoFile);
            $entity->setLogo($fileName);
        }
    }
}