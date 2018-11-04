<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.3
 * Time: 09.53
 */

namespace App\Controller\Admin;


use App\Entity\Category;
use App\Form\Admin\CategoryType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("/admin/categories", name="admin.category.list")
     */
    public function list(EntityManagerInterface $em)
    {
        $categories = $em->getRepository(Category::class)->findAll();
        return $this->render('admin/category/list.html.twig', [
            'categories'=>$categories,
        ]);
    }

    /**
     * @Route("/admin/category/create", name="admin.category.create", methods="GET|POST")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
//
//        if($form->isSubmitted()){
//            exit("Form was submtted");
//        }

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin.category.list');
        }

        return $this->render('admin/category/create.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/amdin/category/{id}/edit", name="admin.category.edit", methods="POST|GET")
     */
    public function edit(Request $request, EntityManagerInterface $em, Category $category)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirectToRoute('admin.category.list');
        }

        return $this->render('admin/category/edit.html.twig', [
            'form'=>$form->createView(),
            'category'=>$category,
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Category $category
     *
     * @Route("/admin/category/{id}/delete", name="admin.category.delete", methods={"DELETE"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Request $request, EntityManagerInterface $em, Category $category)
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {

            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('admin.category.list');
    }
}