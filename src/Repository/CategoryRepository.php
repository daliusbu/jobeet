<?php

namespace App\Repository;

use App\Entity\job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CategoryRepository
 * @package App\Repository
 */
class CategoryRepository extends EntityRepository
{

    public function findWithActiveJobs()
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->innerJoin('c.jobs', 'j')
            ->where('j.expiresAt > :date' )
            ->andWhere('j.activated = :activated')
            ->setParameter('date', new \DateTime())
            ->setParameter('activated', true)
            ->getQuery()
            ->getResult();
    }


}
