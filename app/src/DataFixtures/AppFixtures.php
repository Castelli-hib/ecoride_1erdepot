<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Route;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR'); // Génère des données réalistes françaises

        // 🔹 Création d’utilisateurs
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setUsername("user$i");
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail("user$i@ecoride.fr");
            $user->setPhoneNumber($faker->phoneNumber);
            $user->setCity($faker->city);
            $user->setRoles(['ROLE_USER']);
            $user->setIsVerified(true);

            // 🧩 mot de passe haché
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'password');
            $user->setPassword($hashedPassword);

            $manager->persist($user);
            $users[] = $user;
        }

        // 🔹 Création de trajets liés aux utilisateurs
        for ($i = 1; $i <= 15; $i++) {
            $route = new Route();
            $route->setDepartureTown($faker->city);
            $route->setArrivalTown($faker->city);
            $route->setDepartureDay($faker->dateTimeBetween('now', '+10 days'));
            $route->setDepartureTime($faker->dateTimeBetween('08:00', '20:00'));
            $route->setTravelTime(rand(30, 300)); // Durée du trajet (minutes)
            $route->setCorrespondance($faker->boolean);
            $route->setCorrespondanceDetail($faker->sentence(3));

            // 🧷 Relation : attribuer un user au hasard
            $route->setUser($faker->randomElement($users));

            $manager->persist($route);
        }

        $manager->flush();
    }
}
