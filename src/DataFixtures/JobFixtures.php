<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.10.31
 * Time: 14.57
 */

namespace App\DataFixtures;


use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class JobFixtures extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $jobSensioLabs = new Job();
        $jobSensioLabs->setCategory($manager->merge($this->getReference('category-programming')));
        $jobSensioLabs->setType('full-time');
        $jobSensioLabs->setCompany('Sensio Labs');
        $jobSensioLabs->setLogo('sensio-labs.gif');
        $jobSensioLabs->setUrl('http://www.sensiolabs.com/');
        $jobSensioLabs->setPosition('Web Developer');
        $jobSensioLabs->setLocation('Paris, France');
        $jobSensioLabs->setDescription('You\'ve already developed websites with symfony and you want to work with Open-Source technologies. You have a minimum of 3 years experience in web development with PHP or Java and you wish to participate to development of Web 2.0 sites using the best frameworks available.');
        $jobSensioLabs->setHowToApply('Send your resume to fabien.potencier@sensio.com');
        $jobSensioLabs->setPublic(true);
        $jobSensioLabs->setActivated(true);
        $jobSensioLabs->setToken('job_sensio_labs');
        $jobSensioLabs->setEmail('job@example.com');
//        $jobSensioLabs->setExpiresAt(new \DateTime('+30 days'));

        $jobExtremeSensio = new Job();
        $jobExtremeSensio->setCategory($manager->merge($this->getReference('category-design')));
        $jobExtremeSensio->setType('part-time');
        $jobExtremeSensio->setCompany('Extreme Sensio');
        $jobExtremeSensio->setLogo('extreme-sensio.gif');
        $jobExtremeSensio->setUrl('http://www.extreme-sensio.com/');
        $jobExtremeSensio->setPosition('Web Designer');
        $jobExtremeSensio->setLocation('Paris, France');
        $jobExtremeSensio->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.');
        $jobExtremeSensio->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $jobExtremeSensio->setPublic(true);
        $jobExtremeSensio->setActivated(true);
        $jobExtremeSensio->setToken('job_extreme_sensio');
        $jobExtremeSensio->setEmail('job@example.com');
//        $jobExtremeSensio->setExpiresAt(new \DateTime('+30 days'));

        $joblrytas = new Job();
        $joblrytas->setCategory($manager->merge($this->getReference('category-manager')));
        $joblrytas->setType('no-time');
        $joblrytas->setCompany('Lietuvos rytas');
        $joblrytas->setLogo('extreme-sensio.gif');
        $joblrytas->setUrl('http://www.lrytas.lt/');
        $joblrytas->setPosition('Real manager');
        $joblrytas->setLocation('Kaunas, Lietuva');
        $joblrytas->setDescription('Eiti ir eiti ir niekur nenueiti sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.');
        $joblrytas->setHowToApply('Siusti zinute ir nieko atgal negauti');
        $joblrytas->setPublic(false);
        $joblrytas->setActivated(true);
        $joblrytas->setToken('jobas_dalbajobas');
        $joblrytas->setEmail('niekogerob@example.com');
//        $jobExtremeSensio->setExpiresAt(new \DateTime('+30 days'));

        $jobExpired = new Job();
        $jobExpired->setCategory($manager->merge($this->getReference('category-programming')));
        $jobExpired->setType('full-time');
        $jobExpired->setCompany('Sensio Labs');
        $jobExpired->setLogo('sensio-labs.gif');
        $jobExpired->setUrl('http://www.sensiolabs.com/');
        $jobExpired->setPosition('Web Developer Expired');
        $jobExpired->setLocation('Paris, France');
        $jobExpired->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit.');
        $jobExpired->setHowToApply('Send your resume to lorem.ipsum [at] dolor.sit');
        $jobExpired->setPublic(true);
        $jobExpired->setActivated(true);
        $jobExpired->setToken('job_expired');
        $jobExpired->setEmail('job@example.com');

        for($i=0; $i<100; $i++){
            $jobBelekur = new Job();
            $jobBelekur->setCategory($manager->merge($this->getReference('category-programming')));
            $jobBelekur->setType('full-time');
            $jobBelekur->setCompany('Imone nr '. $i);
            $jobBelekur->setLogo('sensio-labs.gif');
            $jobBelekur->setUrl('http://www.belekas.com/');
            $jobBelekur->setPosition('Web web_'.$i);
            $jobBelekur->setLocation('Lion, France');
            $jobBelekur->setDescription('Dolor sit amet, consectetur adipisicing elit.');
            $jobBelekur->setHowToApply('Send your resume to lorem.ipsum [at] dolor.sit');
            $jobBelekur->setPublic(true);
            $jobBelekur->setActivated(true);
            $jobBelekur->setToken('job_token_'.$i);
            $jobBelekur->setEmail('job@job.com');
            $manager->persist($jobBelekur);
        }


        $manager->persist($jobSensioLabs);
        $manager->persist($jobExtremeSensio);
        $manager->persist($joblrytas);
        $manager->persist($jobExpired);

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder() : int
    {
        return 2;
    }
}