<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.5
 * Time: 20.08
 */

namespace App\Controller\API;


use App\Entity\Affiliate;
use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Response;

class JobController extends FOSRestController
{

    /**
     * @param Affiliate $affiliate
     * @param EntityManagerInterface $em
     *
     * @Entity("affiliate", expr="repository.findOneActiveByToken(token)")
     *
     * @Rest\Get("/{token}/jobs", name="api.job.list")
     * @return Response
     */
    public function getJobsAction(Affiliate $affiliate, EntityManagerInterface $em)
    {
        $jobs = $em->getRepository(Job::class)->findActiveJobsForAffiliate($affiliate);

        return $this->handleView($this->view($jobs, Response::HTTP_OK));
    }
}