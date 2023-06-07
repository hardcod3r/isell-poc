<?php

namespace Shop\Common\CLI\Actions\Product;

use PhpSchool\CliMenu\Builder\CliMenuBuilder;
use PhpSchool\CliMenu\CliMenu;
use Shop\Product\Tasks\GetProductById;
use PhpSchool\CliMenu\Builder\SplitItemBuilder;
use Shop\Cart\Tasks\AddToCart;
use Shop\Cart\Tasks\GetCart;
use PhpSchool\CliMenu\MenuItem\StaticItem;
use PhpSchool\CliMenu\Action\GoBackAction;
use PhpSchool\CliMenu\MenuItem\LineBreakItem;
use PhpSchool\CliMenu\MenuItem\SplitItem;
use PhpSchool\CliMenu\MenuItem\SelectableItem;
use Shop\Common\CLI\Actions\Cart\SetPaymentDetails;
use PhpSchool\CliMenu\MenuItem\MenuMenuItem;
use PhpSchool\CliMenu\MenuItem\RadioItem;
use Illuminate\Support\Str;
use Shop\Cart\FlowStore;
use Shop\Billing\Tasks\CreateOrder;

/**
 * ProductById returns flow product details by chosen id and returns order popup
 */
class ProductById
{

    public $id;

    public function run(CliMenuBuilder $builder, $id)
    {
        $product = app(GetProductById::class)->run($id);
        $current_price = $product->active_price();

        $menu = $builder->setTitle($product->name); //set title the name of product
        $menu->disableDefaultItems();
        $menu->addStaticItem('Price: ' . $current_price->formatted_price); //get latest active (current) price
        $menu->addLineBreak('-'); // give some space
        $menu->addStaticItem($product->description); // show description of the product
        // build popup to get quantity
        $quantity_popup = function (CliMenu $menu) use ($product, $current_price) {
            $result = $menu->askNumber()
                ->setPromptText('Enter desired quantity')
                ->setPlaceholderText(1)
                ->setValidationFailedText('Invalid quantity, try again')
                ->ask();
            $quantity = intval($result->fetch());
            app(AddToCart::class)->run(['product_id' => $product->id, 'product_price_id' => $current_price->id, 'quantity' => $quantity, 'price' => $current_price->price]);
            $cart = app(GetCart::class)->run();
            $flash = $menu->flash($quantity . ' items added to your cart!');
            $flash->getStyle()->setBg('green');
            $flash->display();
            $menu->addItem(new StaticItem('You have ' . $cart->sum('quantity') . ' items  in your cart'));
        };
        // build popup for cart

        $cart_popup = function (CliMenu $menu) use ($builder) {
            foreach ($menu->getItems() as $item) {
                $menu->removeItem($item);
            }
            $menu->setTitle('Your Cart');
            $carts = app(GetCart::class)->run();
            if ($carts->count()) {
                foreach ($carts as $cart) {
                    $menu->addItem(new StaticItem($cart->quantity . ' x ' . $cart->product->name . ' ' . $cart->formatted_total));
                }
            } else {
                $menu->addItem(new StaticItem('No items in your cart'));
            }
            $menu->addItem(new LineBreakItem('-'));

            $callable = function (CliMenu $menu) {
                $method = trim(Str::beforeLast($menu->getSelectedItem()->getText(), 'Checkout'));
                app(FlowStore::class)->set('payment_method', $method);
                $order = app(CreateOrder::class)->run();
                $flash = $menu->flash("Your order with id " . $order->id . ' has created. Thank you for your order.');
                $flash->getStyle()->setBg('green');
                $flash->display();
            };
            if ($carts->count()) {
                $full_name = app(FlowStore::class)->get('full_name');
                $CustomerMenu = ($full_name) ?? new MenuMenuItem('Customer', app(SetPaymentDetails::class)->run($builder));
                $menu->addItem(new StaticItem('Total: ' . env('CASHIER_CURRENCY_SIGN') . number_format($carts->sum('total'))));
                $menu->addItem(new LineBreakItem('*'));
                $menu->addItem(new SplitItem([
                    $CustomerMenu,
                    new SelectableItem('Keep Shopping', new GoBackAction),
                    new RadioItem('Paypal Checkout', $callable),
                    new RadioItem('Credit Checkout', $callable),
                ]));
            } else {
                $menu->addItem(new SplitItem([
                    new SelectableItem('Keep Shopping', new GoBackAction),
                ]));
            }
            $menu->redraw();
        };

        // cart space . split cli to show horizontally some items


        $menu->addSplitItem(function (SplitItemBuilder $b) use ($quantity_popup, $cart_popup) {
            $b->setGutter(3)
                ->addItem('Add to Cart', $quantity_popup)
                ->addItem('Show Cart', $cart_popup)
                ->addItem('Return to product list', new GoBackAction);
        });

        return $menu;
    }
}
