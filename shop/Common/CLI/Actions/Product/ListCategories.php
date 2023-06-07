<?php

namespace Shop\Common\CLI\Actions\Product;

use PhpSchool\CliMenu\Builder\CliMenuBuilder;
use Shop\Product\Tasks\CategoryList;
use Shop\Common\CLI\Actions\Product\ListProductsByCategory;

/**
 * ListCategories returns flow list categories
 */
class ListCategories
{


    public function run(CliMenuBuilder $builder)
    {
        //get list of categories
        $categories = app(CategoryList::class)->run();
        $menu = $builder->setTitle('Choose category'); // show title
        //loop them and add each one of them to menu
        foreach ($categories as $cat) {
            $menu->addSubMenu($cat->title,  fn ($builder) => app(ListProductsByCategory::class)->run($builder, $cat->id));
        }
        return $menu;
    }
}
