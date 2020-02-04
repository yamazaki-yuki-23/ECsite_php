<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Buy extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cartitems)
    {
        $this->cartitems = $cartitems;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cartitems = $this->cartitems;
        return $this->view('buy.mail')->with(['cartitems' => $cartitems]);
    }
}
