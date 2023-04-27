<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use App\Entity\Product;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $datetime = DateTime::createFromFormat('j-M-Y', '1-oct-2019');

        for ($i=0; $i < 100; $i++){
            $manufacturer = new Manufacturer();
            $manufacturer->setName('Manufacturer ' . $i);
            $manufacturer->setDescription('Description '. $i);
            $manufacturer->setCountryCode(rand(100, 999));
            $manufacturer->setListedDate($datetime);
            $manager->persist($manufacturer);

            $product = new Product();
            $product->setName('Product ' . $i);
            $product->setDescription('Description ' . $i);
            $product->setIssueDate($datetime);
            $product->setManufacturer($manufacturer);


            $manager->persist($product);
        }

        $manager->flush();
    }
}
