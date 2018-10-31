<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.10.31
 * Time: 16.20
 */

namespace App\Controller;


use App\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class JobController
 * @package App\Controller
 * @Route("/job")
 */
class JobController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="job.list")
     */
    public function list()
    {
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findAll();
        return $this->render('job/list.html.twig',[
            'jobs'=> $jobs,
        ]);
    }

    /**
     * @param Job $job
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}", name="job.show")
     */
    public function show(Job $job)
    {

        return $this->render('job/show.html.twig', [
            'job'=>$job
        ]);
    }
}