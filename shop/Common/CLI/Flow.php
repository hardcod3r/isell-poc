<?php

namespace Shop\Common\CLI;

use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\Builder\CliMenuBuilder;
use PhpSchool\CliMenu\Action\GoBackAction;
use Shop\Common\CLI\Actions\Product\ListCategories;
use PhpSchool\CliMenu\MenuItem\AsciiArtItem;
use Shop\Common\CLI\Actions\Art\Logo;
use Shop\Common\CLI\Actions\Cart\ShowCart;

/**
 * Flow class to create interactive cli menu
 */
class Flow
{
    /**
     * menu
     *
     * @var mixed
     */
    public $menu;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        $this->menu = ($builder = app()->make(CliMenuBuilder::class))
            ->setTitle('Welcome to ISell CLI')
            ->addAsciiArt(app(Logo::class)->run(), AsciiArtItem::POSITION_CENTER)
            ->addSubMenu('Shopping time!', fn ($builder) => app(ListCategories::class)->run($builder))
            ->addLineBreak('-')
            ->setBorder(0, 1, 'green')
            ->setPadding(2, 4)
            ->setMarginAuto()
            ->setForegroundColour('2')
            ->setBackgroundColour('0')
            ->setWidth($builder->getTerminal()->getWidth())
            ->build();
    }
}
