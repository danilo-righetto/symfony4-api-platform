<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Movie;
use App\Entity\Category;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $categories = [
            "Terror", "Comedy", "Romance", "Action"
        ];

        foreach ($categories as $key => $item) {
            $category = new Category();
            $category->setName($item);
            $manager->persist($category);
        }

        $manager->flush();

        // Trabalhando com Movie
        for ($i=1; $i < 2001; $i++) {
            $categories = $manager->getRepository(Category::class)->findAll(); 
            $category = array_rand($categories);

            $movie = new Movie();
            $movie->setTitle('Title of movie ' . $i);
            $movie->setDescription('Description ' . $i * 3.1416);
            $movie->setReleaseDate((new \DateTime())->modify("+ $i days"));
            $movie->setCategory($categories[$category]);
            $manager->persist($movie);
        }

        $manager->flush();
    }
}
