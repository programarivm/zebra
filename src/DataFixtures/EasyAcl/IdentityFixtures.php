<?php

namespace App\DataFixtures\EasyAcl;

use App\DataFixtures\UserFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Programarivm\EasyAclBundle\EasyAcl;
use Programarivm\EasyAclBundle\Entity\Identity;

class IdentityFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    private $easyAcl;

    public function __construct(EasyAcl $easyAcl)
    {
        $this->easyAcl = $easyAcl;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < UserFixtures::N; $i++) {
            $index = rand(0, count($this->easyAcl->getPermission())-1);
            $user = $this->getReference("user-$i");
            $role = $this->getReference("role-$index");
            $manager->persist(
                (new Identity())
                    ->setUser($user)
                    ->setRole($role)
            );
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return [
            'zebra',
        ];
    }

    public function getDependencies(): array
    {
        return [
            RoleFixtures::class,
            UserFixtures::class,
        ];
    }
}
