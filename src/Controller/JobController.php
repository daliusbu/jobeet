<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.10.31
 * Time: 16.20
 */

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Job;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class JobController
 * @package App\Controller
 *
 */
class JobController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="job.list")
     */
    public function list(EntityManagerInterface $em)
    {
        $categories = $em->getRepository(Category::class)->findWithActiveJobs();

        return $this->render('job/list.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @param Job $job
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Entity("job", expr="repository.findActiveJob(id)")
     * @Route("job/{id}", name="job.show", requirements={"id"="\d+"}, methods="GET")
     */
    public function show(Job $job)
    {

        return $this->render('job/show.html.twig', [
            'job'=>$job
        ]);
    }
}