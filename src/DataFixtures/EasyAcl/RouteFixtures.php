<?php

namespace App\DataFixtures\EasyAcl;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Programarivm\EasyAclBundle\EasyAcl;
use Programarivm\EasyAclBundle\Entity\Route;
use Symfony\Component\Yaml\Yaml;

class RouteFixtures extends Fixture implements FixtureGroupInterface
{
    private $routes;

    public function __construct(string $projectDir, EasyAcl $easyAcl)
    {
        $this->routes = Yaml::parseFile("{$projectDir}/config/routes.yaml");
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->routes as $name => $item) {
            $manager->persist(
                (new Route())
                    ->setName($name)
                    ->setMethods($item['methods'])
                    ->setPath($item['path'])
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
}
