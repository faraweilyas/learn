<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AwardAchievements
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ProductPurchased $event
     * @return void
     */
    public function handle(ProductPurchased $event)
    {
        $message = "Award achievements for paying: ".$event->amount;
        dump($message);
    }
}
