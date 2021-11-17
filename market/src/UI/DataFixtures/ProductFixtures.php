<?php

namespace App\UI\DataFixtures;

use App\Market\Category\Domain\CategoryRepository;
use App\Market\Product\Domain\Amount;
use App\Market\Product\Domain\Currency;
use App\Market\Product\Domain\ProductDescription;
use App\Market\Product\Domain\ProductName;
use App\UI\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function load(ObjectManager $manager)
    {
        foreach ($this->getItemsData() as [$name, $description, $amount, $currency, $categoryName]) {
            $category = $this->categoryRepository->searchByName($categoryName);
            $item = Product::create(
                new ProductName($name),
                new ProductDescription($description),
                new Amount($amount),
                new Currency($currency),
                $category
            );

            $manager->persist($item);
        }

        $manager->flush();
    }

    private function getItemsData(): array
    {
        return [
            // $item = [$name, $description, $amount, $currency, $category];
            ['dog', 'Dog is the happiest animal', 17990, 'EUR', 'animals'],
            ['cat', 'Cat is a funny animal', 5990, 'EUR', 'animals'],
            ['rabbit', 'Rabbit is a fast animal', 9900, 'EUR', 'animals'],
            ['plantA', 'Lorem ipsum aa', 1000, 'EUR', 'garden'],
            ['plantB', 'Lorem ipsum bb', 1200, 'EUR', 'garden'],
            ['plantC', 'Lorem ipsum cc', 1350, 'EUR', 'garden'],
            ['Vietnam trip', 'Lorem ipsum Vietnam', 135000, 'EUR', 'holidays'],
            ['Stockholm trip', 'Lorem ipsum Stockholm', 95000, 'EUR', 'holidays'],
            ['knife', 'Lorem ipsum knife', 550, 'EUR', 'kitchen'],
            ['fork', 'Lorem ipsum fork', 650, 'EUR', 'kitchen'],
            ['spoon', 'Lorem ipsum spoon', 750, 'EUR', 'kitchen'],
        ];
    }

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
        );
    }
}
