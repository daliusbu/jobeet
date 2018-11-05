<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.5
 * Time: 19.21
 */

namespace App\DataFixtures;


use App\Entity\Affiliate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AffiliateFixtures extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $affSensioLabs = new Affiliate();
        $affSensioLabs->setUrl('https://www.sensiolabs.com');
        $affSensioLabs->setEmail('contact@sensiolabs.com');
        $affSensioLabs->setActive(true);
        $affSensioLabs->setToken('sensio_labs');
        $affSensioLabs->addCategory($manager->merge($this->getReference('category-programming')));

        $affKNPLabs = new Affiliate();
        $affKNPLabs->setUrl('https://www.knplabs.com');
        $affKNPLabs->setEmail('contact@knplabs.com');
        $affKNPLabs->setActive(true);
        $affKNPLabs->setToken('knp_labs');
        $affKNPLabs->addCategory($manager->merge($this->getReference('category-programming')));
        $affKNPLabs->addCategory($manager->merge($this->getReference('category-design')));

        $manager->persist($affKNPLabs);
        $manager->persist($affSensioLabs);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}