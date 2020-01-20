<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AddressFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
        $this->faker->addProvider(new \Faker\Provider\en_US\Address($this->faker));
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $address = (new Address())
                        ->setAddress($this->faker->address)
                        ->setPostcode($this->faker->postcode)
                        ->setCity($this->faker->city);
            $manager->persist($address);
        }

        $manager->flush();
    }
}
