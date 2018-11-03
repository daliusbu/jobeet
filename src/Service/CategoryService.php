<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.3
 * Time: 03.57
 */

namespace App\Service;


use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(string $name)
    {
        $category = new Category();
        $category->setName($name);

        $this->em->persist($category);
        $this->em->flush();

        return $category;

    }
}