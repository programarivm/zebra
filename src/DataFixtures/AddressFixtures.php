<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AddressFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    const N = 50;

    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
        $this->faker->addProvider(new \Faker\Provider\en_US\Address($this->faker));
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::N; $i++) {
            $address = (new Address())->setProps([
                'address' => $this->faker->address,
                'postcode' => $this->faker->postcode,
                'city' => $this->faker->city,
                'user' => $this->getReference('user-'.rand(0,UserFixtures::N-1)),
            ]);
            $manager->persist($address);
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
            UserFixtures::class,
        ];
    }
}
