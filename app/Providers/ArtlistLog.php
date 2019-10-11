<?php

namespace App\Providers;

use App\Jobs\LogSomething;
use App\Providers\ListArt;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;


class ArtlistLog implements   ShouldQueue
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
        Log::info("ArtlistLog记录".$event->artId);
        dispatch(new LogSomething('传递的参数id为'.$event->artId));


    }
}
