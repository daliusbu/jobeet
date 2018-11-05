<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.4
 * Time: 12.22
 */

namespace App\Service;


use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class JobHistoryService
{

    private const MAX = 3;

    private $session;

    private $em;

    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    public function addJob(Job $job)
    {
        $jobs = $this->getJobIds();

        array_unshift($jobs, $job->getId());
        $jobs=array_unique($jobs);
        $jobs=array_slice($jobs, 0, self::MAX);
        $this->session->set('job_history', $jobs);
    }

    public function getJobIds()
    {
        return $this->session->get('job_history', []);
    }

    public function getJobs()
    {

        $jobs = [];
        $jobRepository = $this->em->getRepository(Job::class);

        foreach ($this->getJobIds() as $jobId){
            $jobs[]=$jobRepository->findActiveJob($jobId);
        }
        return $jobs;
    }
}