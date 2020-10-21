<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Cd;
use App\Entity\Dvd;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


            $faker = Factory::create();
//


            $author = new Author();
            $author->setBirthDate(new \DateTime());
            $author->setDeathDate(new \DateTime());
            $author->setFirstname($faker->firstName);
            $author->setLastname($faker->lastName);

            $manager->persist($author);

            $dvd = new Dvd();
            $dvd->setHasBonus(false)
                ->setDuration(12)
                ->setPublisher('myself')
                ->setPublishedAt(new \DateTime())
                ->setDescription($faker->text)
                ->setIllustration($faker->text)
                ->setReferenceNumber("ezaOIDOIJ34")
                ->setStock(random_int(3, 50))
                ->setTitle($faker->slug);
            $dvd->addAuthor($author);

            $manager->persist($dvd);

            $manager->flush();

        }
}
