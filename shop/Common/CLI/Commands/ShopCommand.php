<?php

namespace Shop\Common\CLI\Commands;

use Illuminate\Console\Command;

use Shop\Common\CLI\Flow;
use Shop\Cart\FlowStore;

class ShopCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:shop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run shop interactive menu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //in cli session. We need an identifier for some functionalities such as cart
        app(FlowStore::class)->create();
        $this->notify('Hi!', 'ISell shop just started'); //Works only in linux environments
        $flow = new Flow;
        $flow->menu->open();
    }
}
