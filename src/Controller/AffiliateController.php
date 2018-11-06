<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.6
 * Time: 08.43
 */

namespace App\Controller;


use App\Entity\Affiliate;
use App\Form\AffiliateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffiliateController extends AbstractController
{

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     *
     * @Route("/affiliate/create", name="affiliate.create", methods={"GET", "POST"})
     * @return mixed
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $affiliate = new Affiliate();
        $form = $this->createForm(AffiliateType::class, $affiliate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $affiliate->setActive(false);
            $em->persist($affiliate);
            $em->flush();

            return $this->redirectToRoute('affiliate.wait');
        }

        return $this->render('affiliate/create.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/affiliate/wait", name="affiliate.wait", methods={"GET"})
     * @return Response
     */
    public function wait()
    {
        return $this->render('affiliate/wait.html.twig');
    }
}