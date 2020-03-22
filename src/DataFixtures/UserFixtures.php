<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    const N = 20;

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
        $alice = new User();
        $alice->setProps([
            'username' => 'alice',
            'email' => $this->faker->email,
            'password' => $this->encoder->encodePassword($alice, 'password'),
        ]);
        $manager->persist($alice);
        $this->addReference("user-0", $alice);

        $bob = new User();
        $bob->setProps([
            'username' => 'bob',
            'email' => $this->faker->email,
            'password' => $this->encoder->encodePassword($bob, 'password'),
        ]);
        $manager->persist($bob);
        $this->addReference("user-1", $bob);

        for ($i = 2; $i < self::N; $i++) {
            $user = new User();
            $user->setProps([
                'username' => $this->faker->username,
                'email' => $this->faker->email,
                'password' => $this->encoder->encodePassword($user, $this->faker->password),
            ]);
            $manager->persist($user);
            $this->addReference("user-$i", $user);
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
