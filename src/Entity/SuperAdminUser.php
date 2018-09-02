<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\MappedSuperclass()
 *
 * @ORM\Entity(repositoryClass="SuperAdminUserRepository")
 */
class SuperAdminUser extends User
{
    public function __construct()
    {
        $this->roles = [ self::ROLE_SUPER_ADMIN ];
    }

    public function getType()
    {
        return 'super_admin';
    }
}