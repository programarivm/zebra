<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Factory::create();
        $this->faker->addProvider(new \Faker\Provider\Internet($this->faker));
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setUsername($this->faker->username)
                ->setEmail($this->faker->email)
                ->setPassword($this->encoder->encodePassword(
                    $user,
                    $this->faker->password
                ));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
