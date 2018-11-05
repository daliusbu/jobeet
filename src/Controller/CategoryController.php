<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use App\Service\JobHistoryService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{slug}/{page}", name="category.show", methods="GET", defaults={"page":1},
     *     requirements={"page"="\d+"})
     * @param Category $category
     * @param int $page
     * @param PaginatorInterface $paginator
     *
     * @return Response
     */
    public function show(Category $category, int $page, PaginatorInterface $paginator , JobHistoryService $jobHistoryService): Response
    {

        $activejobs = $paginator->paginate(
          $this->getDoctrine()->getRepository(Job::class)->getPagnatedActiveJobsByCategoryquery($category),
            $page,
            $this->getParameter('max_jobs_on_category')
        );
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'activeJobs'=>$activejobs,
            'historyJobs'=>$jobHistoryService->getJobs(),
        ]);
    }
}
