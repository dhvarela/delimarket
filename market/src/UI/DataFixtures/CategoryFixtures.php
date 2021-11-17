<?php

namespace App\UI\DataFixtures;

use App\Market\Category\Domain\CategoryName;
use App\UI\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getItemsData() as [$name]) {
            $item = Category::create(
                new CategoryName($name)
            );

            $manager->persist($item);
        }

        $manager->flush();
    }

    private function getItemsData(): array
    {
        return [
            // $item = [$name];
            ['animals'],
            ['garden'],
            ['holidays'],
            ['kitchen'],
        ];
    }
}
