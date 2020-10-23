<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Borrowing;
use App\Entity\Category;
use App\Entity\Cd;
use App\Entity\Dvd;
use App\Entity\Novel;
use App\Entity\Penalty;
use App\Entity\Plage;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        $faker = Factory::create('fr_FR');


        for ($i = 0; $i < 20; $i++) {
            $author = new Author();

            $author->setBirthDate($faker->dateTimeBetween("-80 years", '-40 years'))
                ->setDeathDate($faker->dateTimeBetween($author->getBirthDate(), 'now'))
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName);

            $manager->persist($author);

            $category = new Category();
            $category->setDescription($faker->realText(200))
                     ->setName($faker->slug(2));

            $manager->persist($category);

            for ($j = 0; $j < 20; $j++) {
                $time = 0;
                $cd = new Cd();

                $cd->setTitle($faker->realText(40))
                    ->setDescription($faker->realText(200))
                    ->setStock(random_int(0, 250))
                    ->setReferenceNumber(uniqid("CD", true))
                    ->setIllustration($faker->imageUrl())
                    ->setPublishedAt($faker->dateTimeBetween())
                    ->setPublisher($faker->name)
                    ->addAuthor($author)
                    ->addCategory($category);

                for ($k = 0; $k < 12; $k++) {
                    $plage = new Plage();
                    $plage->setTitle($faker->realText(20))
                        ->setDuration(random_int(15, 240))
                        ->setCd($cd);
                    $manager->persist($plage);
                    $time += $plage->getDuration();
                }
                $cd->setTotalDuration($time);
                $manager->persist($cd);

                $dvd = new Dvd();

                $dvd->setTitle($faker->realText(40))
                    ->setDescription($faker->realText(200))
                    ->setStock(random_int(0, 250))
                    ->setReferenceNumber(uniqid("DVD", true))
                    ->setIllustration($faker->imageUrl())
                    ->setPublishedAt($faker->dateTimeBetween())
                    ->setPublisher($faker->name)
                    ->addAuthor($author)
                    ->addCategory($category)
                    ->setDuration(random_int(3000, 5400))
                    ->setHasBonus($faker->boolean);

                $manager->persist($dvd);

                $novel = new Novel();

                $novel->setTitle($faker->realText(40))
                    ->setDescription($faker->realText(200))
                    ->setStock(random_int(0, 250))
                    ->setReferenceNumber(uniqid("NOVEL", true))
                    ->setIllustration($faker->imageUrl())
                    ->setPublishedAt($faker->dateTimeBetween())
                    ->setPublisher($faker->name)
                    ->addAuthor($author)
                    ->addCategory($category)
                    ->setIsbn(md5($faker->slug(3)))
                    ->setOriginalLanguage($faker->languageCode)
                    ->setPages(random_int(60, 1200));

                $manager->persist($novel);


                for ($u = 0; $u < 50; $u++) {
                    $userPenalty = 0;
                    $user = new User();

                    $user->setLastname($faker->lastName)
                        ->setFirstname($faker->firstName)
                        ->setPassword('toto')
                        ->setCreatedAt($faker->dateTimeBetween('-2 years', 'now'))
                        ->setEmail($faker->freeEmail)
                        ->setPhoneNumber($faker->phoneNumber);


                    if ($i % 2 === 0) {
                        $user->setStatus('free');
                    } else {
                        $user->setStatus('subscribed')
                            ->setSubscribedAt($faker->dateTimeBetween($user->getCreatedAt(), 'now'))
                            ->setSubscriptionEndDate($faker->dateTimeBetween($user->getSubscribedAt(), '+1 year'));
                        $userPenalty = $user;
                    }
                    $manager->persist($user);


                    for ($l = 0; $l < 5; $l++) {
                        $borrowing = new Borrowing();
                        $borrowing->setUser($user)
                            ->setBorrowedAt($faker->dateTimeBetween($user->getSubscribedAt(), 'now'))
                            ->setExpectedReturnDate($faker->dateTimeBetween($borrowing->getBorrowedAt(), '+1 month'));

                        if ($l === 0 || $l === 1) {
                            $borrowing->setDocument($dvd)
                                ->setActualReturnDate($faker->dateTimeBetween($borrowing->getBorrowedAt(), $borrowing->getExpectedReturnDate()));
                        } elseif ($l === 2) {
                            $borrowing->setDocument($cd)
                                ->setActualReturnDate($faker->dateTimeBetween($borrowing->getExpectedReturnDate(), $faker->dateTimeBetween($borrowing->getExpectedReturnDate(), '+2 months')));
                        }
                        $borrowing->setDocument($novel);
                        $manager->persist($borrowing);
                    }


                    if (random_int(0, 100) <= $i && $userPenalty !== 0) {
                        $penalty = new Penalty();

                        $penalty->setDate($faker->dateTimeBetween($userPenalty->getSubscribedAt(), $user->getSubscriptionEndDate()))
                            ->setAmount($faker->randomFloat(2, 2, 50))
                            ->setUser($userPenalty);

                        $random = random_int(0, 100);
                        switch ($random) {
                            case $random < 25:
                                $penalty->setType('one_day');
                                break;
                            case $random < 50:
                                $penalty->setType('seven_days');
                                break;
                            case $random < 75:
                                $penalty->setType('fourteen_days');
                                break;
                            case $random < 100:
                                $penalty->setType('blacklisted');
                                break;
                        }
                        $manager->persist($penalty);
                    }
                }
            }
        }


        $manager->flush();
    }
}
