<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.5
 * Time: 21.41
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class AffiliateRepository extends EntityRepository
{

    public function findOneActiveBytoken(string $token)
    {
        return $this->createQueryBuilder('a')
            ->where('a.active = :active')
            ->andWhere('a.token= :token')
            ->setParameter('active', true)
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }
}