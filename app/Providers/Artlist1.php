<?php

namespace App\Providers;

use App\Providers\ListArt;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class Artlist1
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
     * @param  ListArt  $event
     * @return void
     */
    public function handle(ListArt $event)
    {
        Log::info("Artlist1记录".$event->artId);
    }
}
