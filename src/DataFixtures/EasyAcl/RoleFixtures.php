<?php

namespace App\DataFixtures\EasyAcl;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Programarivm\EasyAclBundle\EasyAcl;
use Programarivm\EasyAclBundle\Entity\Role;

class RoleFixtures extends Fixture implements FixtureGroupInterface
{
    private $easyAcl;

    public function __construct(EasyAcl $easyAcl)
    {
        $this->easyAcl = $easyAcl;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->easyAcl->getPermission() as $key => $access) {
            $role = (new Role())->setName($access['role']);
            $manager->persist($role);
            $this->addReference("role-$key", $role);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return [
            'zebra',
        ];
    }
}
