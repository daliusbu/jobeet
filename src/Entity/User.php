<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.5
 * Time: 13.09
 */

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class User
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}