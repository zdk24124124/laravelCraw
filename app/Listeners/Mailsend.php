<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mailsend
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected  $email;

    public function __construct($email)
    {
        $this->email= $email;

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
