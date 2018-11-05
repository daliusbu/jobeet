<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.3
 * Time: 21.38
 */

namespace App\Controller\Admin;


use App\Entity\Job;
use App\Form\JobType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{

    /**
     * @Route("/admin/jobs/{page}", name="admin.job.list", defaults={"page":1})
     */
    public function list(EntityManagerInterface $em, PaginatorInterface $paginator, int $page)
    {
        $jobs = $paginator->paginate(
            $em->getRepository(Job::class)->createQueryBuilder('j'),
            $page,
            $this->getParameter('max_per_page'),
            [
                PaginatorInterface::DEFAULT_SORT_FIELD_NAME =>'j.createdAt',
                $paginator::DEFAULT_SORT_DIRECTION => 'DESC',
            ]
        );

        return $this->render('admin/job/list.html.twig', [
            'jobs'=>$jobs,
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     *
     * @Route("/admin/job/create", name="admin.job.create")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('admin.job.list');
        }

        return $this->render('admin/job/create.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Job $job
     *
     * @Route("admin/job/{id}/edit", name="admin.job.edit")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, EntityManagerInterface $em, Job $job)
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('notice', 'The edited job was saved');
           return $this->redirectToRoute('admin.job.list');
        }

       return  $this->render('admin/job/edit.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Job $job
     *
     * @Route("/admin/job/{id}/delete", name="admin.job.delete", methods={"DELETE"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Request $request, EntityManagerInterface $em, Job $job)
    {
        if($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))){
            $em->remove($job);
            $em->flush();
            $this->addFlash('notice', 'Job was deleted');
        }
        return $this->redirectToRoute('admin.job.list');
    }
}