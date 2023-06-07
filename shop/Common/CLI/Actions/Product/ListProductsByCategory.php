<?php

namespace Shop\Common\CLI\Actions\Product;

use PhpSchool\CliMenu\Builder\CliMenuBuilder;
use PhpSchool\CliMenu\Action\GoBackAction;
use Shop\Product\Tasks\ProductListByCategory;

/**
 * ListProductsByCategory returns flow product list by chosen category
 */
class ListProductsByCategory
{

    public $id;

    public function run(CliMenuBuilder $builder, $id)
    {
        //get all products by given id
        $products = app(ProductListByCategory::class)->run($id);
        $menu = $builder->setTitle('Choose product'); //set title
        //loop them and add each one to menu
        foreach ($products as $product) {
            $menu->addSubMenu($product->name,  fn ($b) => app(ProductById::class)->run($b, $product->id));
        }
        return $menu;
    }
}
