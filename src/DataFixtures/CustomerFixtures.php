<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomerFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
      $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();

        //normal user
        $customer = new Customer();
        $customer->setEmail("pomme@pommemail.com");
        $customer->setRoles(["ROLE_USER"]);
        $customer->setPassword($this->userPasswordHasher->hashPassword($customer, "123456"));
        $manager->persist($customer);

        //admin user
        $customerAdmin = new Customer();
        $customerAdmin->setEmail("admin@pommemail.com");
        $customerAdmin->setRoles(["ROLE_ADMIN"]);
        $customerAdmin->setPassword($this->userPasswordHasher->hashPassword($customerAdmin,"123456"));
        $manager->persist($customerAdmin);

        $manager->flush();
    }
}
