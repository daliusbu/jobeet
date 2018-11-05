<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.5
 * Time: 19.33
 */

namespace App\EventListener;


use App\Entity\Affiliate;
use Doctrine\ORM\Event\LifecycleEventArgs;

class AffiliateTokenListener
{

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if(!$entity instanceof Affiliate){
            return;
        }

        if(!$entity->getToken()){
            $entity->setToken(\bin2hex(\random_bytes(10)));
        }
    }

}