<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.2
 * Time: 12.57
 */

namespace App\EventListener;


use App\Entity\Job;
use Doctrine\ORM\Event\LifecycleEventArgs;

class JobTokenListener
{

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (! $entity instanceof Job){
            return;
        }

        if (! $entity->getToken()){
            $entity->setToken(\bin2hex(\random_bytes(10)));
        }
    }
}