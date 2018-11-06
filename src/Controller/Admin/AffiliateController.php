<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.6
 * Time: 10.07
 */

namespace App\Controller\Admin;


use App\Entity\Affiliate;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AffiliateController extends AbstractController
{

    /**
     * @param EntityManagerInterface $em
     * @param PaginatorInterface $paginator
     * @param int $page
     *
     * @Route("/admin/affiliate/list/{page}", name="admin.affiliate.list", defaults={"page":1})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(EntityManagerInterface $em, PaginatorInterface $paginator, int $page)
    {
        $affiliates = $paginator->paginate(
          $em->getRepository(Affiliate::class)->createQueryBuilder('a'),
            $page,
            $this->getParameter('max_per_page'),
            [
                PaginatorInterface::DEFAULT_SORT_FIELD_NAME=>'a.active',
                PaginatorInterface::DEFAULT_SORT_DIRECTION => "ASC",
            ]
        );

        return $this->render('admin/affiliate/list.html.twig', [
            'affiliates' =>$affiliates,
        ]);
    }

    /**
     * @param EntityManagerInterface $em
     * @param Affiliate $affiliate
     *
     * @Route("/admin/affiliate/{id}/activate", name="admin.affiliate.activate", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activate(EntityManagerInterface $em, Affiliate $affiliate)
    {
        $affiliate->setActive(true);
        $em->flush();

        return $this->redirectToRoute('admin.affiliate.list');
    }

    /**
     * @param EntityManagerInterface $em
     * @param Affiliate $affiliate
     *
     * @Route("/admin/affiliate/{id}/deactivate", name="admin.affiliate.deactivate", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deactivate(EntityManagerInterface $em, Affiliate $affiliate)
    {
        $affiliate->setActive(false);
        $em->flush();

        return $this->redirectToRoute('admin.affiliate.list');
    }
}